const gameshotcontroller = require('../controllers/gameshot')

const bodyParser = require('body-parser')
const methodOverride = require('method-override')

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

    router.post('/games/:id/shots', jsonParser, urlencodedParser, gameshotcontroller.addGameShot)

    app.use('/', router)
}