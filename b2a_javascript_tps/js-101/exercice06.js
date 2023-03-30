let tab = ['bonsoir', 'je', 'suis', 'fabrice']
let separator = '/'

function bonsoir(tab, separator) {
    for(let index = 0; index < tab.length; index++) {
        let word = tab[index]
        //return word += word
        return word = word += separator
    }
}
console.log(bonsoir(tab, separator));

console.log(tab.join('/'));