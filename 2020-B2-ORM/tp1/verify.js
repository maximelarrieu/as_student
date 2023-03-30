const process = require('process')
const reset = '\x1b[0m'
const red = '\x1b[31m'
const blink = '\x1b[5m'
const green = '\x1b[32m'
const bright = '\x1b[1m'

const exos = []
const exoPaths = ['./1', './2', './3']

const log = (messages) => {
  if (!Array.isArray(messages)) {
    console.log(messages)
    return
  }
  for (const message of messages) {
    console.log(message)
  }
}

const verboseRequire = (path) => {
  try {
    return require(path)
  } catch (err) {
    log([`${bright}${red}Error when requiring ${path}/index.js${reset}`, err])
    process.exit(1)
  }
}

for (const exoPath of exoPaths) {
  exos.push(verboseRequire(exoPath))
}

for (const exo of exos) {
  log(`Starting test for ${exo.name}...`)
  for (const dataset of exo.datasets) {

    let result = undefined
    try {
      result = exo.algo(dataset.input)
      exo.verify(dataset, result)
    } catch (err) {
      log([
        `${exo.name} -> ${bright}${blink}${red}KO${reset}`,
        "\nError :",
        err
      ])
      process.exit(1)
    }
  }
  log(`${exo.name} -> ${bright}${green}OK${reset}\n`)
}
log(`${bright}${green}GG !${reset}`)