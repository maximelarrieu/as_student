const gamecontroller = require('../controllers/game')

const bodyParser = require('body-parser')
const methodOverride = require('method-override')

var test = methodOverride('_method')
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

    // Route qui liste toutes les parties créées
    router.get("/games", gamecontroller.getGames);

    // Page de formulaire de création d'une partie
    router.get("/games/new", function(req, res) {
        res.render('games/new.pug')
    });

    // Route qui crée la partie et l'enregistre en base de données
    router.post('/games', jsonParser, urlencodedParser, gamecontroller.addGame)

    // Page du détail d'une partie
    router.get("/games/:id", gamecontroller.getGame)

    // Page du formulaire d'édition d'une partie
    router.get("/games/:id/edit", gamecontroller.toEditGame);

    // Route qui modifie et PATCH en base de données
    router.patch("/games/:id", jsonParser, urlencodedParser, gamecontroller.editGame)

    // Route qui supprime la partie en base de données
    router.delete("/games/:id", jsonParser, urlencodedParser, gamecontroller.deleteGame)

    //ROUTE FACULTATIVE
    // router.delete("/games/:id/shots/previous", function () {

    // })

    app.use('/', router)
}