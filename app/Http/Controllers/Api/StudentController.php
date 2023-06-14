<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * @type string
     */
    private const LANG_PATH = 'studentMessageController';

    public function index()
    {
        $students = Student::all();

        if ($students->count() > 0) {

            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => __(self::LANG_PATH . '.errors.no_records')
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'course' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,

            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => __(self::LANG_PATH . '.succesful.created')
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => __(self::LANG_PATH . '.errors.unexpected')
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {

            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => __(self::LANG_PATH . '.errors.student_not_found')
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'course' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $student = Student::find($id);

            if ($student) {

                $student->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,

                ]);

                return response()->json([
                    'status' => 200,
                    'message' => __(self::LANG_PATH . '.succesful.updated')
                ], 200);

            } else {

                return response()->json([
                    'status' => 404,
                    'message' => __(self::LANG_PATH . '.errors.student_not_found')
                ], 404);
            }
        }
    }
    public function destroy($id){

        $student = Student::find($id);

        if($student){

            $student->delete();
        }else {
            return response()->json([
                'status' => 404,
                'message' => __(self::LANG_PATH . '.errors.student_not_found')
            ], 404);
        }
    }
}
