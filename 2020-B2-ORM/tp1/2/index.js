const datasets = require("./datasets.json")
const reset = '\x1b[0m'
const bright = '\x1b[1m'

exports = module.exports = {
  name: "Déménagement",
  datasets,
  algo: function (input) {
    // YOUR CODE BETWEEN HERE
    let poids = 0
    let nb_aller_retour = 1

    for (let index = 1; index < input.length; index++) {
      const i = input[index];
      if ((poids + i) <= 100) {
        poids += i
      } else {
        nb_aller_retour += 1
        poids = i
      }
    }
    return nb_aller_retour
    // AND HERE
  },
  verify: function (dataset, output) {
    if (dataset.output !== output) {
      throw new Error(`${bright}Got ${output} but expected ${dataset.output}${reset}`)
    } else {
      return true
    }
  }
}