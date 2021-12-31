const db = require("../config/database");

class Students {
    static all() {
        return new Promise((resolve, reject) => {
            const query = "SELECT * FROM students";
            db.query(query, (err, results) => {
                resolve(results);
            });
        });
    }

    static create(data) {
        const {
            name,
            nim,
            prodi,
            address
        } = data;
        return new Promise((resolve, reject) => {
            const query = `INSERT INTO students (name, nim, prodi, address) VALUES ("${name}", "${nim}", "${prodi}", "${address}")`;
            db.query(query, (err, results) => {
                if (err) {
                    resolve(err);
                } else {
                    resolve(data);
                }
            });
        });
    }

    static update(id, data) {
        const {
            name,
            nim,
            prodi,
            address
        } = data;
        console.log(data);
        return new Promise((resolve, reject) => {
            const query = `UPDATE students SET name="${name}", nim="${nim}", prodi="${prodi}", address="${address}" WHERE id="${id}"`;
            db.query(query, (err, results) => {
                if (err) {
                    resolve(err);
                } else {
                    resolve(data);
                }
            });
        });
    }

    static delete(id) {
        return new Promise((resolve, reject) => {
            const query = `DELETE FROM students WHERE id="${id}"`;
            const querySelect = `SELECT * FROM students WHERE id="${id}"`;
            db.query(querySelect, (err, data) => {
                if (err) {
                    resolve(err);
                } else {
                    db.query(query, (err, results) => {
                        if (err) {
                            resolve(err);
                        } else {
                            resolve(data);
                        }
                    });
                }
            });
        });
    }
}

module.exports = Students;