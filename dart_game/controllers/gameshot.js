// Récupération du client Redis
const redisClient = require('../redis-client')
const _ = require('lodash')
// Récupération du model GameShot en base de données
const GameShot = require('../models/gameshot')
// Récupération du model Game en base de données
const Game = require('../models/game')
// Récupération du model GamePlayer en base de données
const GamePlayer = require('../models/gameplayer')

// Récupération de la classe troiscentun dans l'engine
const troiscentun = require('../engine/gamemodes/301')
// Récupération de la classe around_the_world dans l'engine
const around_the_world = require('../engine/gamemodes/around-the-world')

// Récupération de la classe gamemode dans l'engine
const GameMode = require('../engine/gamemode')
// Initialisation de la classe pour récupérer les données et les fonctions
const gamemode = new GameMode()

// Fonction de création d'un nouveau GameShot
const addGameShot = async(req, res) => {
    // Stocke le nouveau GameShot créé grâce à l'initialisation de sa classe (new)
    // et des valeurs renvoyées par le formulaire (req.body)
    const gameshot = new GameShot(req.body)
    try {
        // Stocke la Game récupérée grâce à la fonction Mongoose findById()
        const game = await Game.findById({_id: req.params.id}).populate({
            // Récupération des valeurs du model Player associé au currentPlayerId
            path: 'currentPlayerId',
            model: 'Player',
            populate: {
                // Récupération des valeurs du model GamePlayer associé au Player
                path: 'gameplayers',
                model: 'GamePlayer'
            }
        })
        // Initialisation du gameId du GameShot créé avec l'id de la Game récupérée
        gameshot.gameId = game._id
        // Initialisation du playerId du GameShot crée avec l'id du currentPlayerId de la Game récupérée
        gameshot.playerId = game.currentPlayerId._id
        // Enregistrement du GameShot en base de données
        await gameshot.save()
        // Déclaration du Player actuel
        const current_gameplayer = game.currentPlayerId.gameplayers
        // Déclaration du score du GamePlayer récupéré
        const gameplayer_score = game.currentPlayerId.gameplayers.score
        // Déclaration du nombre de flêchette restantes du GamePlayer récupéré
        const gameplayer_remainingShots = game.currentPlayerId.gameplayers.remainingShots
        // Lance la fonction shot() du mode troiscentun à laquelle on passe le secteur et le mulitplicateur touché
        // ainsi que le gameplayer ayant tiré
        gamemode.shot(game.mode, req.body.sector, req.body.multiplicator, current_gameplayer).then(async(response) => {
            // Stocke le GamePlayer trouvé et prépare les modification à apporter en base de données
            const gameplayer = await GamePlayer.findById(current_gameplayer._id, {gameId: game._id}).populate({
                path: 'playerId',
                model: 'Player'
            })
            // Mis à jour du score du joueur par le nouveau score récupéré dans la response
            gameplayer.score = response.new_score
            // Mis à jour du nombre de tirs du joueur par le nouveau nombre de tirs récupéré dans la response
            gameplayer.remainingShots = response.new_shots
            // Redis
            redisClient.zadd(`score_${game.name}`, gameplayer.score, gameplayer.playerId.name)
            redisClient.zrange(`score_${game.name}`, 0, -1, 'withscores', function(err, members) {
                let chunks = _.chunk(members, 2)
                console.log(chunks)
            })
            // Enregistrement en base de données
            gameplayer.save()
            // Lance la fonction checkDarts() pour vérifier si le joueur continue de joueur on si le prochain joue
            checkDarts(gameplayer)
            // Lance la fonction checkScore()
            gamemode.checkScore(game.mode, gameplayer.score, req.body.multiplicator).then(async(resp) => {
                // Si la réponse est true (Si le joueur à 0 ou 301 points)
                if (resp === true) {
                    // Récupération du GamePlayer
                    const finisher = await GamePlayer.findById(gameplayer._id).populate({
                        path: 'playerId',
                        model: 'Player'
                    })
                    //
                    checkDarts(gameplayer)
                    // Récupération des scores de tous les GamePlayer de la partie
                    const gameplayers_scores = await GamePlayer.find({gameId: gameplayer.gameId})
                    // Lance la fonction isFinished() pour savoir si tous les score sont à 0 ou 301 points
                    gamemode.isFinished(game.mode, gameplayers_scores).then((response) => {
                        // Si la response est true
                        if (response === true) {
                            // Mise à jour du status de la partie
                            // Elle est terminée
                            game.status = 'ended'
                            // Enregistrement en base de données
                            game.save()
                        // Si la response est false
                        } else {
                            // La partie reste à "started"
                            game.status = 'started'
                            //
                            game.save()
                        }
                    })
                    // Récupération de tous les GamePlayer qui joue encore
                    const gameplayers = await GamePlayer.find({gameId: gameplayer.gameId, inGame: true})
                    // Lance la fonction setOrder() qui définira un nouveau GamePlayer parmis ceux trouvé
                    gamemode.setOrder(gameplayers, JSON.stringify(gameplayer.playerId._id)).then(async(response) => {
                        // Initialisation du nouveau GamePlayer renvoyé dans la response
                        const new_player = JSON.parse(response)
                        // Mise à jour du currentPlayerId de la partie en cours par celui renvoyé par la response
                        const game = await Game.findByIdAndUpdate(gameplayer.gameId, {currentPlayerId: new_player})
                        // Enregistrement en base de donneés
                        game.save()
                        // Mise à jour du GamePlayer qui vient de finir sa partie
                        finisher.inGame = false
                        // Enregistrement en base de données
                        finisher.save()
                    })
                // Si le score du GamePlayer n'est pas celui attendu pour une fin de partie alors son score ne bouge pas
                } else if (resp === "mistake") {
                    // Modification du score qui restera celui avant le tir
                    gameplayer.score = gameplayer_score
                }
            })
            // Redirection vers la page de la partie
            res.redirect(`/games/${req.params.id}`)
        })
    } catch(err) {
        res.status(500).send(err)
    }
}

// Fonction qui vérifie si le joueur continue à jouer
const checkDarts = async (gameplayer) => {
    // Si le nombre de tirs restants est à 0
    if((gameplayer.remainingShots) === 0) {
        // On récupère le gameplayer envoyé en paramètre
        const reseted_gameplayer = await GamePlayer.findByIdAndUpdate({_id: gameplayer._id})
        // Mise à jour de son nombre de tirs (qui revient à 3)
        reseted_gameplayer.remainingShots = gamemode.nbDarts
        // Enregistrement en base de données
        reseted_gameplayer.save()
        // Récupération de la liste de GamePlayer en train de jouer
        const gameplayers = await GamePlayer.find({gameId: gameplayer.gameId, inGame: true})
        // Lance la fonction setOrder() qui définira un nouveau GamePlayer
        gamemode.setOrder(gameplayers, JSON.stringify(reseted_gameplayer.playerId._id)).then(async(response) => {
            // Initialisation du nouveau Player récupéré par la response
            const new_player = JSON.parse(response)
            // Mise à jour du currentPlayerId de la partie en cours
            const game = await Game.findByIdAndUpdate(gameplayer.gameId, {currentPlayerId: new_player})
            // Enregistrement en base de données
            game.save()
        })
    }
} 

// Exportation de la fonction
exports.addGameShot = addGameShot