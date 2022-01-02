const db = require("../config/database");

class Students {
    static tableName = "students";

    static all(){
        const sql = `SELECT * FROM ${this.tableName}`;
        return Students.query(sql, null, (result) => result);
    }

    static find(id){
        const sql = `SELECT * FROM ${this.tableName} WHERE id = ?`;
        return Students.query(sql, id, (result) => result);
    }
    
    static create(body){
        const sql = `INSERT INTO ${this.tableName} SET ?`;
        return Students.query(sql, body, (result) => result.insertId);
    }
    
    static async update(id, body){
        const sql = `UPDATE ${this.tableName} SET ? WHERE id = ?`;
        await Students.query(sql, [body, id], (result) => result);
        return Students.find(id);
    }

    static async delete(id){
        const sql = `DELETE FROM ${this.tableName} WHERE id = ?`;
        await Students.query(sql, id, (result) => result);
    }

    static query(sql, body, callback){
        return new Promise((resolve, reject) => {
            db.query(sql, body, (err, results) => {
                resolve(callback(results));
            })
        });
    }
}

module.exports = Students;