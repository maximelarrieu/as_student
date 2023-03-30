const GameMode = require('../gamemode')

// Classe du mode de jeu : 301
class trois_cent_un extends GameMode {
    // Constructor
    constructor(name = "301", score = 301, nbDarts, nbPlayers) {
        super(),
        this.name = name,
        this.score = score,
        this.randomize = this.randomize
    }

    // Fonction shot (chaque joueur y passe 3x)
    async shot(sector, multiplicator, gameplayer) {
        // Récupération du score total du GamePlayer
        let new_score = gameplayer.score - (sector * multiplicator)
        // Récupération du nombre de tirs restants au joueur
        let new_shots = gameplayer.remainingShots - 1
        // Assignation des nouvelles valeurs dans un objet
        const results = {new_score: new_score, new_shots: new_shots}
        // Retourne l'objet avec les nouvelles valeurs
        return results
    }

    // Fonction de vérification, est-ce que le score final est à 0 grâce à un double
    async checkScore(score, multiplicator) {
        // Check si le score est égal à 0
        if(score ===  0) {
            // Check si le multiplicateur touché est un double
            if (multiplicator == 2) {
                // Fin de partie pour le joueur
                return "0"
            } else {
                // Perdra un flêchette pour eventuellement retenter
                return "fail"
            }
        // Son score est en dessous de 0 ou 1 (donc ne pourra pas être un double)
        } else if (score < 0 || score === 1) {
            // Perdra un flêchette pour eventuellement retenter
            return "fail"
        }
    }

    // Fonction de vérification, est-ce que le score de tous les joueurs est égal à 0
    async checkFinish(gameplayers) {
        // Initialisation d'un tableau vide qui stockera tous les scores
        const scores = []
        // Si le tableau de joueurs reçu n'est pas vide 
        if (gameplayers.length > 0) {
            // Parse ce tableau de joueur
            gameplayers.map((index) => {
                // Insère chaque score dans le tableau vide initialisé plus haut
                scores.push(index.score)
            })
            // Vérification de tous les scores dans le tableau rempli
            const result = scores.every((score) => {
                // Si chaque score est égal à 0
                return score === 0
            })
            // Retourne true ou false selon le every
            return result
        }
    }
}

module.exports = new trois_cent_un()