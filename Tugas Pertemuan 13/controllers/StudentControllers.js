const Students = require("../model/Students");
const validator = require('validator');

class StudentController{
    
    async index(req, res){
        const students = await Students.all();

        const response = {
            "message": "Get all students",
            "data": students,
        };
        res.json(response);
        return;
    }

    async show(req, res){
        const {id} = req.params;
        
        if(!validator.isNumeric(id)){
            const response = {
                "message": "Id not valid! Please make sure again id.",
            };
            res.json(response);
            return;
        }

        const student = await Students.find(id);

        const response = {
            "message": "Success get student data!",
            "data": student,
        };
        res.json(response);
    }

    async store(req, res){

        const {name, nim, prodi, address} = req.body;

        if(!validator.isNumeric(nim)){
            const response = {
                "message": "Masukan nim dengan benar.",
            };
            res.json(response);
            return;
        }
        

        const studentId = await Students.create(req.body);
        const student = await Students.find(studentId);

        const response = {
            "message": "Store student data",
            "data": student,
        };

        res.json(response);
    }

    async update(req, res){
        const {id} = req.params;
        if(!validator.isNumeric(id)){
            const response = {
                "message": "Id not valid! Please make sure again id.",
            };
            res.json(response);
            return;
        }
        
        const {name, nim, prodi, address} = req.body;
        if(!validator.isNumeric(nim)){
            const response = {
                "message": "Masukan nim dengan benar.",
            };
            res.json(response);
            return;
        }

        const student = await Students.find(id);

        if(student.length > 0){
            const update = await Students.update(id, req.body);

            const response = {
                "message": "Success update student data",
                "data": update,
            };
    
            res.json(response);
        }else{
            const response = {
                "message": "Student data doesn't exist",
            };
            res.status(404).json(response);
        }
    }
    
    async destroy(req, res){
        const {id} = req.params;
        if(!validator.isNumeric(id)){
            const response = {
                "message": "Id not valid! Please make sure again id.",
            };
            res.json(response);
            return;
        }

        const student = await Students.find(id);

        if(student.length > 0){
            await Students.delete(id);
            const response = {
                "message": "Success delete student data",
                "data":student,
            };
            res.json(response);
        }else{
            const response = {
                "message": "Student data doesn't exist",
            };
            res.status(404).json(response);
        }
    }
}

const controller = new StudentController();
module.exports = controller;