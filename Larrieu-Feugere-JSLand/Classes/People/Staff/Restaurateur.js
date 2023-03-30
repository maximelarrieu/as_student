"use strict"

let readlineSync = require('readline-sync');

let personnelDuParc = require('../personnelDuParc');

class Restaurateur extends personnelDuParc {
    constructor(nom, prenom) {
        super(nom, prenom);
    }

    nbrRecipe(nbrClients) {
        return nbrClients
    }

    getMenus() {
        let menus = readlineSync.question("Restaurateur : Très bien, vous êtes donc " + this.nbrRecipe() + ". Combien y aura t-il de menus 1 ? Et combien y aura t-il de menus 2 ? ").split(' ')
        let nbMenus = menus.map(Number)
        return nbMenus
    }

    countMenus(getMenus) {
        let count = getMenus
        const reducer = (accumulator, currentValue) => accumulator + currentValue;
        return count.reduce(reducer)
    }

    verifNbMenus(nbrClients, countMenus) {
        if (countMenus == nbrClients) {
            return true
        } else {
            return false
        }
    }

    price(nbrClients, cost) {
        return nbrClients * cost
    }

    isClientBudgetEnough(budget, price) {
        if (budget >= price) {
            return true
        }
        else {
            return false
        }
    }   
}

module.exports = Restaurateur