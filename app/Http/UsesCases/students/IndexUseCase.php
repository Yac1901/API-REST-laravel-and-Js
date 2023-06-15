<?php


namespace App\Http\UsesCases\students;

use App\Http\DAO\impl\StudentDAOImpl;
use App\Models\Student;

class IndexUseCase
{

    /**
     * @type string
     */
    private const LANG_PATH = 'studentMessageController';

    private $studentDAOImpl;

    public function __construct()
    {
        $this->studentDAOImpl = new StudentDAOImpl();
    }

    public function __invoke()
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
}
