const user = {
    nom: 'John',
    description: '',
    budget: 5
}


function addDescription (user) {

    if (user.budget === undefined || user.budget === null) {
        user.description = 'Tu as oublié ton portefeuille'
    }

    if (user.budget >= 0 && user.budget < 5) {
        user.description =  'Il fallait travailler cet été'

    } else if (user.budget === 5) {
        user.description = 'Tu as le droit à une bière'

    } else if (user.budget > 5) {
        user.description = 'Tu peux payer ta tournée'
    }
}

addDescription(user)
console.log(`Bravo, ${user.nom}. ${user.description}. Voici le rappel de ton budget: ${user.budget}`)