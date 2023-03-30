"use strict"

let Batiments = require('./Batiments');

class Restaurant extends Batiments {
    constructor(nom, employee) {
        super(nom, employee);
        this.menus = [1, 2]
        this.menusPrice = [12, 15]
        // this.menuOne = 1
        // this.menuTwo = 2
        // // menu 1 : 12 euros menu 2 : 15 euros
        // this.menuOnePrice = 12
        // this.menuTwoPrice = 15
    }
}

module.exports = Restaurant;
