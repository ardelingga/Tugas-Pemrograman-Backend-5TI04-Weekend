<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
    function index()
    {
        $students = Student::all();

        $response = [
            'message' => 'Success get all students!',
            'data' => $students,
        ];

        return response()->json($response, 200);
    }

    function create(Request $request)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $validateNIM = $this->validateNIM($nim);
        $validateEmail = $this->validateEmail($email);

        if ($validateNIM['code'] == 0) {
            if ($validateEmail['code'] == 0) {
                $student = Student::create([
                    'nama' => $nama,
                    'nim' => $nim,
                    'email' => $email,
                    'jurusan' => $jurusan,
                ]);

                $data = [
                    'message' => 'student is created successfully',
                    'data' => $student,
                ];

                return response()->json($data, 201);
            } else {
                $data = [
                    'message' => $validateEmail['msg'],
                ];
                return response()->json($data, 400);
            }
        } else {
            $data = [
                'message' => $validateNIM['msg'],
            ];
            return response()->json($data, 400);
        }
    }

    function update(Request $request, $id)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $validateId = $this->validateIdStudent($id);
        $validateNIM = $this->validateNIM($nim);
        $validateEmail = $this->validateEmail($email);

        if ($validateId['code'] == 0) {
            if ($validateNIM['code'] == 0) {
                if ($validateEmail['code'] == 0) {
                    $student = Student::find($id)->update([
                        'nama' => $nama,
                        'nim' => $nim,
                        'email' => $email,
                        'jurusan' => $jurusan,
                    ]);

                    $data = [
                        'message' => 'Success! data is updated',
                        'data' => Student::all()->where('id', $id),
                    ];

                    return response()->json($data, 201);
                } else {
                    $data = [
                        'message' => $validateEmail['msg'],
                    ];
                    return response()->json($data, 400);
                }
            } else {
                $data = [
                    'message' => $validateNIM['msg'],
                ];
                return response()->json($data, 400);
            }
        } else {
            $data = [
                'message' => $validateId['msg'],
            ];
            return response()->json($data, 400);
        }
    }

    function delete($id)
    {
        $validateId = $this->validateIdStudent($id);
        if ($validateId['code'] == 0) {
            Student::destroy($id);

            $data = [
                'message' => 'Success delete student!',
                'data' => Student::all(),
            ];

            return response()->json($data, 201);
        } else {
            $data = [
                'message' => $validateId['msg'],
            ];
            return response()->json($data, 400);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' =>
                'required|email|max:255|regex:/(.*)@myemail\.com/i|unique:users',
            'password' => 'required|min:6|confirmed',
            /*'usertype' => 'required',*/
        ]);
    }

    function validateIdStudent($id)
    {
        // CODE MESSAGE EMAIL ----------
        // 0 == ID is right
        // 1 == ID is not number

        if (is_numeric($id)) {
            $data = [
                'code' => 0,
                'msg' => 'ID dapat digunakan!',
            ];
            return $data;
        } else {
            $data = [
                'code' => 1,
                'msg' => 'ID harus number!',
            ];
            return $data;
        }
    }

    function validateEmail($email)
    {
        // CODE MESSAGE EMAIL ----------
        // 0 == EMAIL is right
        // 1 == EMAIL already exist

        $email_count = Student::where('email', $email)->count();
        if ($email_count != 0) {
            $data = [
                'code' => 1,
                'msg' => 'Email sudah ada!',
            ];
            return $data;
        } else {
            $data = [
                'code' => 0,
                'msg' => 'Email dapat digunakan!',
            ];
            return $data;
        }
    }

    function validateNIM($nim)
    {
        // CODE MESSAGE NIM ----------
        // 0 == NIM is right
        // 1 == NIM not number
        // 2 == NIM already exist

        if (is_numeric($nim)) {
            $nim_count = Student::where('nim', $nim)->count();
            if ($nim_count != 0) {
                $data = [
                    'code' => 2,
                    'msg' => 'NIM sudah ada!',
                ];

                return $data;
            } else {
                $data = [
                    'code' => 0,
                    'msg' => 'NIM dapat digunakan!',
                ];
                return $data;
            }
        } else {
            $data = [
                'code' => 1,
                'msg' => 'NIM harus number!',
            ];
            return $data;
        }
    }
}
