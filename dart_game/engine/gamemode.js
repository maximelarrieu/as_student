// Classe générale des gamemodes
class GameMode {
    // Constructor
    constructor(name, nbPlayers, nbDarts = 3) {
        this.name = name,
        this.nbPlayers = nbPlayers
        this.nbDarts = nbDarts
    }

    // Fonction d'initialisation d'une game lorsqu'un joueur est ajouté
    async startGame(gameplayers) {
        // Initialisation d'un tableau vide qui stockera tous les ids Player
        const ids = []
        // Parse le tableau de gameplayer reçu
        gameplayers.map((index) => {
            if(index.playerId) {
                // Insère chaque id de Player dans le tableau vide initialisé plus haut
                ids.push(index.playerId)
            } else {
                // Insère chaque id de Player dans le tableau vide initialisé plus haut
                ids.push(index)
            }
        })
        // Défini une variable qui retourne un index aléatoire du tableau des ids Players
        let rand = Math.floor(Math.random() * ids.length)
        // Récupération du nouveau Player à l'index aléatoire retourné au dessus
        let current_player = ids[rand]
        // Retourne le nouvel id qui deviendr le currentPlayer de la partie
        return current_player
    }

    // Fonction de changement de joueur dans l'ordre
    // Déduire l'ordre ici ?
    async setOrder(gameplayers, current) {
        // Initialisation d'un tableau vide qui reçoit les ids Player de chaque GamePlayer
        const order = []
        // Parse le tableau reçu
        gameplayers.map((index) => {
            // Insère chaque id de joueur dans le tableau initialisé plus haut
            order.push(JSON.stringify(index.playerId))
        })
        // Initialisation de l'index du currentPlayerId trouvé dans ce nouveau tableau
        const actual = order.indexOf(current)
        // S'il est dans le tableau
        if(actual >= 0 && actual < order.length) {
            // Initialisation du prochain index dans le nouveau tableau
            const next = order[actual + 1]
            // Si le prochain index n'est pas trouvé
            if (next === undefined) {
                // On récupère la première valeur à l'index 0 du tableau
                const next = order[0]
                // Retourne l'id correspondant
                return next
            } else {
                // Retourne l'id suivant
                return next
            }
        }
    }

    // Fonction de tir (chaque joueurs y passe 3 fois)
    async shot(mode, sector, multiplicator, gameplayer) {
        // Initialisation du prochain score qui sera retourné par la fonction
        let new_score = 0
        // Initialisation du prochain nombre de flêchettes qui sera retourné par la fonction
        let new_shots = 0
        // Initialisation de l'objet qui recevra les nouvelles données
        let results = {}
        // Si le mode de jeu reçu est 301
        if(mode === "301") {
            // Redéfinition du score total du GamePlayer selon le tir qu'il a effectué
            new_score = gameplayer.score - (sector * multiplicator)
        // Si le mide de jeu reçu est Around the world
        } else if (mode === "around-the-world") {
            // Si le sector reçu est celui attendu
            if(sector == gameplayer.score + 1) {
                console.log("d")
                // Incrémentation du score
                new_score = gameplayer.score + 1
            } else {
                // Le score reste celui reçu
                new_score += gameplayer.score
            }
        }
        // Récupération du nombre de tirs restants au joueur
        new_shots = gameplayer.remainingShots - 1
        // Assignation des nouvelles valeurs dans un objet
        results = {new_score: new_score, new_shots: new_shots}
        // Retourne l'objet avec les nouvelles valeurs
        return results
    }

    // Fonction de vérification de scores
    async checkScore(mode, score, multiplicator) {
        if(mode === "301") {
           // Check si le score est égal à 0
            if(score ===  0) {
                // Check si le multiplicateur touché est un double
                if (multiplicator == 2) {
                    // Fin de partie pour le joueur
                    return true
                } else {
                    // Perdra un flêchette pour eventuellement retenter
                    return "mistake"
                }
            // Son score est en dessous de 0 ou 1 (donc ne pourra pas être un double)
            } else if (score < 0 || score === 1) {
                // Perdra un flêchette pour eventuellement retenter
                return "mistake"
            }
        } else if (mode === "around-the-world") {
            if(score === 20) {
                return true
            } else {
                return false
            }
        }
    }

    // Fonction de vérification de l'ensemble des scores de la partie afin de
    // savoir si elle est terminée.
    async isFinished(mode, gameplayers) {
        // Initialisation d'un tableau vide qui stockera tous les scores
        const scores = []
        // Si le tableau de joueurs reçu n'est pas vide 
        if (gameplayers.length > 0) {
            // Parse ce tableau de joueur
            gameplayers.map((index) => {
                // Insère chaque score dans le tableau vide initialisé plus haut
                scores.push(index.score)
            })
            if (mode === "301") {
                // Vérification de tous les scores dans le tableau rempli
                const result = scores.every((score) => {
                    // Si chaque score est égal à 0
                    return score === 0
                })
                // Retourne true ou false selon le every
                return result
            } else if (mode === "around-the-world") {
                // Vérification de tous les scores dans le tableau rempli
                const result = scores.every((score) => {
                    // Si chaque score est égal à 0
                    return score === 20
                })
                console.log(scores)
                // Retourne true ou false selon le every
                return result
            }
        }
    }
}

module.exports = GameMode
