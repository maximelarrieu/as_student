//const cors = require('cors')
const playercontroller = require("../controllers/player")
const bodyParser = require('body-parser')

var jsonParser = bodyParser.json()
var urlencodedParser = bodyParser.urlencoded({ extended: false })

module.exports = app => {
    let router = require('express').Router();

    router.use(function(req, res, next) {
        if(req.query._method == "DELETE") {
            req.method = "DELETE";
            req.url = req.path
        } else if (req.query._method == "PATCH") {
            req.method = "PATCH"
            req.url = req.path
        }
        next();
    })

    // Page qui liste les joueurs créées en base de données
    router.get("/players", playercontroller.getPlayers)

    // Route qui crée un joueur et l'enregistre en base de données
    router.post("/players", jsonParser, urlencodedParser, playercontroller.addPlayer)

    // Page du formulaire de création de joueur
    router.get("/players/new", function(req, res) {
        res.render('players/new.pug')
    });

    // Page de détails d'un joueur
    router.get("/players/:id", playercontroller.getPlayer)

    // Page du formulaire d'édition d'un joueur
    router.get("/players/:id/edit", playercontroller.toEditPlayer);

    // Route qui modifie et PATCH un joueur en base de données
    router.patch("/players/:id", jsonParser, urlencodedParser, playercontroller.editPlayer);

    // Route qui supprime un joueur en base de données
    router.delete("/players/:id", playercontroller.deletePlayer);

    app.use('/', router)
}