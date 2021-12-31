const Students = require("../model/Students");

class StudentController{
    async index(req, res){

        const students = await Students.all();
        const data = {
            "message": "Menampilkan semua students",
            "data": students,
        };
        res.json(data);
    }

    async store(req, res){
        const body = req.body;
        const createStudent = await Students.create(body);
        const data = {
            "message": "Berhasil! Menambahkan students",
            "data": createStudent,
        };
        res.json(data);
    }

    async update(req, res){
        const body = req.body;
        const id = req.params.id;

        const createStudent = await Students.update(id, body);
        const data = {
            "message": "Berhasil! Update students",
            "data": createStudent,
        };
        res.json(data);
    }
    
    async destroy(req, res){
        const id = req.params.id;

        const createStudent = await Students.delete(id);
        const data = {
            "message": "Berhasil! Delete students",
            "data": createStudent,
        };
        res.json(data);
    }
}

const controller = new StudentController();
module.exports = controller;