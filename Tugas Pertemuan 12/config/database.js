const mysql = require('mysql');

require("dotenv").config();

const {
    DB_HOST,
    DB_USERNAME,
    DB_PASSWORD,
    DB_DATABASE
} = process.env;

const db = mysql.createConnection({
    host: "127.0.0.1",
    user: "root",
    password: "Linggaarde26%",
    database: "db_be_nodejs"
});

db.connect((err) => {
    if(err){
        console.log("Error connecting"+ err.stack);
        return;
    }else{
        console.log("Connected to database");
        return;
    }
});

module.exports = db;