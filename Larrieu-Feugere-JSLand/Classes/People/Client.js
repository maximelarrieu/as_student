'use strict'
let readlineSync = require('readline-sync');
let Personnes = require('../Personnes');

class Client extends Personnes {
    constructor(name, firstName, budget) {
        super(name, firstName);
        this.budget = budget;
        this.lastTransact = null;
        this.lastLocateTransact = null;
    }

    tellList() {
        let clients = readlineSync.question("Client: Bonjour je voudrais participer à cette fantastique attraction. Je vous présente les membres de ma famille. Il y a : ").split(' ')
        clients.push(this.firstName)
        return clients
    }
    tellNumber() {
        let clients = readlineSync.questionInt("Restaurant: Ah bonjour ! Combien êtes vous ? ")
        return clients
    }

    nbrEntrant(allClients){
        let nbrClients = allClients.length
        return nbrClients
    }

    paidTransact(enoughBudget, enoughPlace, price) {
        if (enoughBudget && enoughPlace) {
            this.budget -= price
            return true
        }
        else {
            return false
        }
    }
    paidMenus(enoughBudget, verifNbMenus, price) {
        if (enoughBudget && verifNbMenus) {
            this.budget -= price
            return true
        } else {
            return false
        }
    }

    buyLunch() {
        if (checkTransact(cost)) {
            console.log("Client : Bonjour, je mangerai bien dans ce restaurant, le" + restaurantName);
            this.lastLocateTransact = restaurantName
            this.lastTransact = cost
        } else {
            console.log("Désolé mais vous n'avez pas les fonds nécessaires...")
        }
    }
}

module.exports = Client;
