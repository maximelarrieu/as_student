const express = require('express')
const app = express();
const methodOverride = require('method-override');
const port = 3001
const bodyParser = require('body-parser');
const mongoose = require('mongoose')

require("./routers/game")(app);
require("./routers/player")(app);
require("./routers/gameplayers")(app);
require("./routers/gameshot")(app);

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended: true}))
app.use(methodOverride('X-HTTP-Method-Override'))
app.use(methodOverride('_method'))

mongoose.connect("mongodb+srv://root:root@cluster0.rkruo.mongodb.net/node_dart_game?retryWrites=true&w=majority", {
    useNewUrlParser: true,
    useUnifiedTopology: true,
    useFindAndModify: false
})

app.get('/', (req, res) => {
    try {
        res.redirect(303, "/games")
    } catch(err) {
        res.status(406).send("API_NOT_AVAILABLE")
    }
})

app.listen(port, () => console.log(`Port sur écoute : ${port}`));