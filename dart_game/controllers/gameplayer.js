// Récupération du model GamePlayer en base de données
const GamePlayer = require("../models/gameplayer")
// Récupération du model Player en base de données
const Player = require("../models/player")
// Récupération du model Game en base de données
const Game = require("../models/game")

// Récupération de la classe du mode 301
const troiscentun = require('../engine/gamemodes/301')
// Récupération de la classe du mode Around the world
const around_the_world = require('../engine/gamemodes/around-the-world')
// Récupération de la classe gamemode dans l'engine
const GameMode = require('../engine/gamemode')
// Initialisation de la classe pour récupérer les données et les fonctions
const gamemode = new GameMode()

// Fonction de récupération des Player inscrits
const getAllPlayers = async(req, res) => {
    // Récupération de la Game de ses objets enfants
    const game = await Game.findOne({_id:req.params.id}).populate({
        // Récupèration des valeurs du model GamePlayer associé
        path:'gameplayers',
        model: 'GamePlayer',
        // Récupération des valeurs du model Player associé à chaque GamePlayer trouvé dans la Game
        populate: {
            path: 'playerId',
            model: 'Player'
        }
    })
    // Récupération des Player inscris
    const allPlayers = await Player.find({}).populate({
        // Récupèration des valeurs du model GamePlayer associé
        path: 'gameplayers',
        model: 'GamePlayer'
    })
    console.log(allPlayers);
    // Retourne la vue dans laquelle s'afficheront les données
    res.render('games/players.pug', {
        // Valeurs à envoyer à la vue
        players: allPlayers,
        gameplayers: game.gameplayers,
        game: game
    })
}

// Fonction d'ajout d'un Player à une Game, il devient alors un GamePlayer
const addGamePlayers = async(req, res) => {
    // Récupération du Player selectionné dans la vue
    const select = req.body
    // Création d'un nouveau GamePlayer
    const gameplayer = new GamePlayer(select)
    // Récupération du Player associé au GamePlayer créée
    await Player.findOneAndUpdate({_id: gameplayer.playerId}, {$set: {gameplayers: gameplayer}}, {new: true})
    // Initialisation de la gameId du nouveau GamePlayer
    gameplayer.gameId = req.params.id
    // Récupération de la Game
    const current_game = await Game.findById({_id: req.params.id})
    // Si le mode de jeu est 301
    if(current_game.mode === '301') {
        // Initialisation du score du GamePlayer (301)
        gameplayer.score = troiscentun.score
    // Si le mode de jeu est Around the world
    } else if (current_game.mode === 'around-the-world') {
        // Initialisation du score du GamePlayer (0)
        gameplayer.score = around_the_world.score
    }
    // Initialisation du nombre de tirs du GamePlayer
    gameplayer.remainingShots = gamemode.nbDarts
    // Initialisation du statut inGame du GamePlayer
    gameplayer.inGame = true
    // Enregistrement en base de données
    await gameplayer.save()
    // Récupération de tous les GamePlayer de la Game
    const gameplayers = await GamePlayer.find({gameId: req.params.id})
    // Lance la fonction startGame() qui définira un currentPlayerId au hasard parmi les GamePlayers
    gamemode.startGame(gameplayers).then(async(response) => {
        // Modification du currentPlayerId par l'id retourné dans la response
        const game = await Game.findByIdAndUpdate({_id: req.params.id}, {$set: {currentPlayerId: response}}, {new: true})
        // Ajout de tous les GamePlayer dans le Game.gameplayers
        game.gameplayers.push(gameplayer._id)
        // Enregistrement en base de données
        await game.save()
        // Redirection vers la vue associée
        res.redirect(`/games/${game._id}/players`)
    })
}

// Fonction de suppression d'un Player d'une Game, il n'est plus un GamePlayer
const deleteGamePlayers = async(req, res) => {
    // Suppression du GamePlayer selectionné dans la vue
    const gameplayer = await GamePlayer.findOneAndRemove({playerId: req.body.playerId})
    // Récupération de la Game 
    const game = await Game.findById({_id: req.params.id}).populate({
        // Récupèration des valeurs du model GamePlayer associé
        path: 'gameplayers',
        model: 'GamePlayer',
        // Récupération des valeurs du model Player associé à chaque GamePlayer trouvé dans la Game
        populate: {
            path: 'playerId',
            model: 'Player'
        }
    })
    // Récupération de l'index où le GamePlayer se situe dans le tableau gameplayers de Game
    let index = game.gameplayers.indexOf(gameplayer._id)
    // Suppression de cet index et donc sa valeur
    game.gameplayers.splice(index, 1)
    // Enregistrement en base de données
    await game.save()
    // Lance la fonction startGame() qui définira un currentPlayerId au hasard parmi les GamePlayers
    gamemode.startGame(game.gameplayers).then(async(response) => {
        // Modification du currentPlayerId de la Game
        const game = await Game.findByIdAndUpdate({_id: req.params.id}, {$set: {currentPlayerId: response}}, {new: true})
        // Enregistrement en base de données
        await game.save()
    })

    if (!gameplayer) {
        res.status(404).send("Aucun gameplayer trouvé.")
    }

    res.redirect(`/games/${req.params.id}/players`)
}

// Exportation de toutes les fonctions
exports.getAllPlayers = getAllPlayers
exports.addGamePlayers = addGamePlayers
exports.deleteGamePlayers = deleteGamePlayers