<?php

namespace App\Http\DAO\impl;

use App\Http\DAO\StudentDAO;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDAOImpl implements StudentDAO
{
    public function allStudent()
    {
        $student = Student::all();

        return $student;
    }

    public function createStudent(Request $request)
    {
        $student = Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,

        ]);

        return $student;
    }
    public function showStudent($id)
    {
        $student = Student::find($id);

        return $student;
    }
    public function destroyStudent(Student $student)
    {
        $student->delete();
    }
    public function updateStudent(Request $request, Student $student)
    {
        $student->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,

        ]);
    }
}
