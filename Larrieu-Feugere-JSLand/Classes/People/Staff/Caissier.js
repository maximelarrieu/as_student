"use strict"

let personnelDuParc = require('../personnelDuParc');

class Caissier extends personnelDuParc {
    constructor(nom, prenom) {
        super(nom, prenom);
    }

    nbrTickets(nbrClient) {
        return nbrClient
    }

    price(nbrTickets, cost) {
        return nbrTickets * cost
    }

    isClientBudgetEnough(budget, price) {
        if (budget >= price) {
            return true
        }
        else {
            return false
        }
    }

    isEnoughPlace(nbrFreeAttractionPlaces, nbrClient) {
        if (nbrFreeAttractionPlaces >= nbrClient) {
            return true
        }
        else {
            return false
        }
    }

}

module.exports = Caissier;