"use strict"

let Client = require("../Classes/People/Client");
let Caissier = require("../Classes/People/Staff/Caissier");
let Restaurateur = require("../Classes/People/Staff/Restaurateur");
let Attraction = require("../Classes/Buildings/Attraction");
let Restaurant = require("../Classes/Buildings/Restaurant");

let myClient = new Client("Larrieu", "Maxime", 150)
let theCaissier = new Caissier("Feugère", "Thibaut")
let theRestaurator = new Restaurateur("Maury", "Louis")
let theAttraction = new Attraction("GrAnD 8", theCaissier.firstName, 10, 20)
let theRestaurant = new Restaurant("Le Rest'au Lit", theRestaurator.firstName)

// ======================== Histoire du client et ses amis qui veulent faire une attraction ======================== //
// console.log("======================= BIENVENUE AU PARC =======================")
// console.log("##### " + myClient.firstName + " se présente à une attraction #####")

// let clientList = myClient.tellList()
// let nbrClient = myClient.nbrEntrant(clientList)
// let nbrTickets = theCaissier.nbrTickets(nbrClient)
// let price = theCaissier.price(nbrTickets, theAttraction.price)
// let enoughBudget = theCaissier.isClientBudgetEnough(myClient.budget, price)
// let enoughPlace = theCaissier.isEnoughPlace(theAttraction.nbPlace, nbrClient)
// let isPaid = myClient.paidTransact(enoughBudget, enoughPlace, price)

// if (enoughBudget) {
//     if(enoughPlace) {
//         console.log("Caissier : Ah enchanté de vous rencontrer : " + clientList.join(', ') + ". Il y aura donc " + nbrTickets + " tickets soit " + price + " euros s'il vous plait")
//     } else {
//         console.log("Caissier : il n'y a plus assez de places disponibles, veuillez attendre votre tour. - Puis on videra le nombre de places occupées de l'attraction")
//     }
// } else {
//     console.log("Caissier : Ah... Il semblerait que vous n'ayez pas assez sur votre compte")
// }

// ======================== Histoire du client et ses amis qui veulent manger au restaurant ======================== //
console.log("======================= BIENVENUE AU PARC =======================")
console.log("##### " + myClient.firstName + " se présente à un restaurant #####")

let nbList = myClient.tellNumber()
let nbClients = theRestaurator.nbrRecipe(nbList)
let getMenus = theRestaurator.getMenus(nbClients)
let countMenus = theRestaurator.countMenus(getMenus)
let verifNbMenus = theRestaurator.verifNbMenus(nbClients, countMenus)
let price = theRestaurator.price(nbClients, theRestaurant.menusPrice[0, 1])
let enoughBudget = theRestaurator.isClientBudgetEnough(myClient.budget, price)
let paidMenus = myClient.paidMenus(enoughBudget, verifNbMenus, price)

if (!verifNbMenus) {
    console.log("Restaurateur : J'ai du mal noter quelque chose... On recommence !")
}

console.log(nbList)
console.log(nbClients)
console.log(getMenus)
console.log(countMenus)
console.log(verifNbMenus)
console.log(price)
console.log(enoughBudget)
console.log(paidMenus)
