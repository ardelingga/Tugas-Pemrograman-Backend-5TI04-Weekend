<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
    function index(){

        $students = Student::all();

        $response = [
            "message" => "Success get all students!",
            "data" => $students
        ];

        return response()->json($response, 200);

    }

    function create(Request $request){
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::create([
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'jurusan' => $jurusan,
        ]);

        $data = [
            "message" => 'student is created successfully',
            'data' => $student
        ];

        return response()->json($data, 201);
    }

    function update(Request $request, $id){
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::find($id)->update([
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'jurusan' => $jurusan,
        ]);

        $data = [
            "message" => 'Success! data is updated',
            'data' => Student::all()->where('id', $id)
        ];

        return response()->json($data, 201);
    }

    function delete($id){

        Student::destroy($id);

        $data = [
            "message" => 'Success delete student!',
            'data' => Student::all()
        ];

        return response()->json($data, 201);
    }


}
