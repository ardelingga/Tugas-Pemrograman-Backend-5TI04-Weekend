
let fruits = require('./fruits');

function index(){
    for(const fruit of fruits){
        console.log(fruit);
    }

    console.log('\n');
}

function store(name){
    fruits.push(name);
    index();
}

function update(position, name){
    fruits[position] = name;
    index();
}

function destroy(position){
    fruits.pop(position);
    index();
}


module.exports = {index, store, update, destroy};