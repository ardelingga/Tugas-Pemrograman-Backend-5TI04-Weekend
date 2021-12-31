const express = require("express");
const router = require("./routes/api.js");
const bodyParser = require('body-parser');


const app = express();


// middleware
app.use(bodyParser.urlencoded({
    extended: true
}));
app.use(bodyParser.json());

app.use(router);

app.listen(3000, () => {
    console.log(`Server berjalan di http://localhost:300`);
});