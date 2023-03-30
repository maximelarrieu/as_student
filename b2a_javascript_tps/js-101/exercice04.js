const myWord = 'kayak'
const mySecondWord = 'test'

function isPalindrom(word) {
    return word === word.split('').reverse().join('') ? 'palindrome' : 'not palindrome'
}

console.log(isPalindrom(myWord))
console.log(isPalindrom(mySecondWord))