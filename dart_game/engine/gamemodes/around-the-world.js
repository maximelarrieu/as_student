const GameMode = require('../gamemode')

// Classe du mode de jeu : Around the world
class around_the_world extends GameMode {
    // Constructor
    constructor(name = "around-the-world", score = 0, nbDarts, nbPlayers) {
        super(),
        this.name = name,
        this.score = score
    }

    // Fonction de vérification, est ce que le secteur est celui attendu ? 
    async ifNext(sector, player_score) {
        if(sector == player_score + 1) {
            return true
        } else {
            return false
        }
    }

    // Fonction de vérification, est ce que le dernier tir est celui attendu
    async isLast(sector, player_score) {
        if (sector == player_score + 5) {
            return true
        } else {
            return false
        }
    }

    // Fonction de vérification, est ce que tous les joueurs ont 25 points ? -> Fin de la partie
    async checkFinish(gameplayers) {
        const scores = []
        if (gameplayers.length > 0) {
            gameplayers.map((index) => {
                scores.push(index.score)
            })
            const result = scores.every((score) => {
                return score === 25
            })
            return result
        }
    }
}

module.exports = new around_the_world()