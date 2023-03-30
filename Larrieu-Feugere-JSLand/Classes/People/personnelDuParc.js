"use strict"

let Personnes = require('../Personnes');

class personnelDuParc extends Personnes {
    constructor(nom, prenom) {
        super(nom, prenom);
    }
}

module.exports = personnelDuParc;
