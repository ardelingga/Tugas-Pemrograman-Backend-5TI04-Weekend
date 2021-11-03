<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AnimalController extends Controller
{

    public $animals;

    public function __construct(){
        $this->animals = array("Ayam", "Bebek", "Burung");
    }

    public function index(){
        $this->animals = Session::get('animals.name') == null ? $this->animals : Session::get('animals.name');


        $response = [
            "code" => 200,
            "message" => "Berhasil Get Data!",
            "data" => $this->animals,
        ];


        return response()->json($response, 200);
    }

    public function store(Request $request){
        $animal_name = $request->input('animal');

        $this->animals = Session::get('animals.name') == null ? $this->animals : Session::get('animals.name');
        array_push($this->animals, $animal_name);

        $response = [
            "code" => 200,
            "message" => "Berhasil Tambah Data!",
            "data" => $this->animals,
        ];

        Session::put('animals.name', $this->animals);

        return response()->json($response, 200);
    }

    public function update(Request $request, $index){
        $animal_name = $request->input('animal');
        $this->animals = Session::get('animals.name') == null ? $this->animals : Session::get('animals.name');

        $this->animals[$index] = $animal_name;

        $response = [
            "code" => 200,
            "message" => "Berhasil Update Data!",
            "data" => $this->animals,
        ];

        Session::put('animals.name', $this->animals);
        return response()->json($response, 200);
    }

    public function destroy(Request $request, $index){
        // $request->session()->forget('animals.name');
        // dd("ar");
        $animal_name = $request->input('animal');
        $this->animals = Session::get('animals.name') == null ? $this->animals : Session::get('animals.name');


        unset($this->animals[$index]);

        // dd($this->animals);
        $re_indexing = array_values($this->animals);
        $this->animals = $re_indexing;

        $response = [
            "code" => 200,
            "message" => "Berhasil Delete Data!",
            "data" => $this->animals,
        ];

        Session::put('animals.name', $this->animals);
        return response()->json($response, 200);
    }
}
