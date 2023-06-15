<?php


namespace App\Http\DAO;

use App\Models\Student;
use Illuminate\Http\Request;

Interface StudentDAO 
{
    public function allStudent();
    public function createStudent(Request $request);
    public function showStudent($id);
    public function destroyStudent(Student $student);
    public function updateStudent(Request $request, Student $student);
}
