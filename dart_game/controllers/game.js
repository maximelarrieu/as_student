// const createError = require('http-errors')

// Récupération du model Game en base de données
const Game = require("../models/game")

// Fonction de récupéraiton de la liste de toutes les Games
const getGames = async(req, res) => {
    // Stocke la liste de Games récupéré grâce à la fonction Mongoose find()
    const games = await Game.find({})
    // Retourne la vue dans laquelle s'afficheront les valeurs récupérées
    res.render('games/index.pug', {
        // Valeurs à envoyer à la vue
        title: "Liste des parties",
        games: games
    })
}

// Fonction de récupération d'une Game selon l'id passé en paramètre d'url
const getGame = async(req, res) => {
    // Stocke la Game récupérée grâce à la fonction Mongoose findById()
    const game = await Game.findById({_id: req.params.id}).populate({
        // Récupèration des valeurs du model GamePlayer associé
        path: 'gameplayers',
        model: 'GamePlayer',
        // Récupération des valeurs du model Player associé à chaque GamePlayer trouvé dans la Game
        populate: {
            path: 'playerId',
            model: 'Player'
        }
    }).populate({
        // Récupération des valeurs du model Player associé au currentPlayerId
        path: 'currentPlayerId',
        model: 'Player',
    })
    // if (!game) {
    //     throw createError(404, `NOT_FOUND`)
    // }

    // Retourne la vue dans laquelle s'afficheront les valeurs récupérées
    res.render('games/details.pug', {
        // Valeurs à envoyer à la vue
        game: game,
        gameplayers: game.gameplayers
    })
}

// Fonction de création d'une nouvelle Game
const addGame = async (req, res) => {
    // Stocke la nouvelle Game créée grâce à l'initialisation de sa classe (new)
    // et des valeurs renvoyées par le formulaire (req.body)
    const game = new Game(req.body)
    try {
        // Initialisation du status de la Game
        game.status = "draft"
        // Initialisation d'un tableau vide qui recevra les GamePlayers ajoutés à la Game
        game.gameplayers = []
        // Enregistrement de la Game en base de données
        await game.save()
        // Redirection vers la page détail de la Game créée
        res.redirect(`/games/${game._id}`)
    } catch(err) {
        // Sinon error 500
        res.status(500).send(err)
    }
}

// Fonction qui affiche le formulaire de modification d'une Game
const toEditGame = async (req, res) => {
    // Stocke la Game trouvée grâce à l'id passé dans l'url
    const game = await Game.findById({_id: req.params.id})
    // Retourne la vue du formulaire avec les données de la Game trouvée pré-remplies
    res.render('games/edit.pug', {
        // Valeurs à envoyer à la vue
        game: game
    })
}

// Fonction de modification d'une Game
const editGame = async (req, res) => {
    // Stocke la Game trouvée et prépare les modifications à apporter en base
    const game = await Game.findByIdAndUpdate(req.params.id, req.body)
    try {
        // Enregistre les nouvelles valeurs en base de données
        await game.save()
        // Redirection vers la page détail de la Game
        res.redirect(`/games/${game._id}`)
    } catch(err) {
        // Sinon error 500
        res.status(500).send(err)
    }
}

// Fonction de suppression d'une Game
const deleteGame = async (req, res) => {
    // Trouve une Game grâce à un id et la supprime
    const game = await Game.findByIdAndDelete(req.params.id)
    // Si la Game n'est pas trouvée
    if (!game) {
        // Renvoie une error 404
        res.status(404).send("Aucun partie trouvée.")
    }
    // Redirection vers la liste des Games (restantes)
    res.redirect(`/games`)
    res.status(200).send()
}

// Exportation de toutes les fonctions
exports.getGames = getGames
exports.getGame = getGame
exports.addGame = addGame
exports.toEditGame = toEditGame
exports.editGame = editGame
exports.deleteGame = deleteGame