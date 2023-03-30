"use strict"

let Batiments = require('./Batiments');

class Attraction extends Batiments {
    constructor(nom, employee, nbPlace, price) {
        super(nom, employee);
        this.nbPlace = nbPlace;
        this.price = price;
    }
}

module.exports = Attraction;
