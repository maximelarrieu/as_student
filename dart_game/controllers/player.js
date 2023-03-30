// Récupération du model Player en base de données
const Player = require("../models/player")

// Fonction de récupération de la liste de tous les Players
const getPlayers = async(req, res) => {
    // Stocke la liste de Players récupéré grâce à la fonction Mongoose find()
    const players = await Player.find({})
    // Retourne la vue dans laquelle s'afficheront les valeurs récupérées
    res.render('players/index.pug', {
        // Valeurs à envoyer à la vue
        title: 'Liste des joueurs',
        players: players
    })
}

// Fonction de récupération d'un Player selon l'id passé en paramètre d'url 
const getPlayer = async(req, res) => {
    // Stocke le Player récupéré grâce à la fonction Mongoose findById
    const player = await Player.findById({_id: req.params.id})
    // Retourne la vue dans laquelle s'afficheront les valeurs récupérées
    res.render('players/details.pug', {
        // Valeurs à envoyer à la vue 
        player: player
    })
}

// Fonction de création d'un nouveau Player
const addPlayer = async(req, res) => {
    // Stocke le nouveau Player créé grâce à l'initialisation de sa classe (new)
    // et des valeurs renvoyées par le formulaire (req.body)
    const player = new Player(req.body)
    try {
        // Enregistrement du Player en base de donnée
        await player.save()
        // Redirection vers la page détail du Player créé
        res.redirect(`/players/${player._id}`)
    } catch(err) {
        // Sinon error 500
        res.status(500).send(err)
    }
}

// Fonction qui affiche le formulaire de modification d'un Player
const toEditPlayer = async(req, res) => {
    // Stocke le Player trouvé grâce à l'id passé dans l'url
    const player = await Player.findById({_id: req.params.id})
    // Retourne la vue du formulaire avec les données du Player trouvé pré-remplies
    res.render('players/edit.pug', {
        // Valeurs à envoyer à la vue
        player: player
    })
}

// Fonction de modification d'un Player
const editPlayer = async(req, res) =>  {
    // Stocke le Player trouvé et prépare les modifications à apporter en base
    const player = await Player.findByIdAndUpdate(req.params.id, req.body)
    try {
        // Enregistre les nouvelles valeurs en base de données
        await player.save()
        // Redirection vers la page détail du Player
        res.redirect(`/players/${player._id}`)
    } catch(err) {
        // Sinon error 500
        res.status(500).send(err)
    }
}

// Fonction de suppression d'un Player
const deletePlayer = async(req, res) => {
    // Trouve un Player grâce à un id et le supprime 
    const player = await Player.findByIdAndDelete(req.params.id)
    // Si le Player n'est pas trouvé
    if (!player) {
        // Renvoie une error 404
        res.status(404).send("Aucun  joueur trouvé.")
    }
    // Redirection vers la liste des Players (restants)
    res.redirect(`/players/`)
    res.status(200).send()
}

// Exportation de toutes les fonctions
exports.getPlayer = getPlayer
exports.getPlayers = getPlayers
exports.addPlayer = addPlayer
exports.toEditPlayer = toEditPlayer
exports.editPlayer = editPlayer
exports.deletePlayer = deletePlayer