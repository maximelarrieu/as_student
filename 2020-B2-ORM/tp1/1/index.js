const datasets = require("./datasets.json")
const reset = '\x1b[0m'
const bright = '\x1b[1m'

exports = module.exports = {
  name: "Marathon",
  datasets,
  algo: function (input) {
    // YOUR CODE BETWEEN HERE
    let start_place = input[0]

    for (let index = 1; index < input.length; index++) {
      let depasse = input[index].split(' ');
      start_place = start_place + parseInt(depasse[0]) - parseInt(depasse[1])
    }

    if (start_place <= 100) {
      return 1000
    }
    else if (start_place > 100 && start_place <= 10000) {
      return 100
    }
    else if (start_place > 1000) {
      return 'KO'
    }
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