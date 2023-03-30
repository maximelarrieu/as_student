const numbers = ['1', '2', '3', '4']
numbers.map(x => console.log(x % 2 === 0 ? x + ' pair' : x + ' impair'))