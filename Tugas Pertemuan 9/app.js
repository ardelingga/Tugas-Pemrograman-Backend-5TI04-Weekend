
const { index, store, update, destroy } = require("./FruitController.js");

const main = () => {
    index();
    store("Melon");
    update(3, "Anggur");
    destroy(3);
};

main();