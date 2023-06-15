<?php

namespace App\Http\UsesCases\students;

use App\Http\DAO\impl\StudentDAOImpl;
use App\Models\Student;

class DestroyUseCase
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

    public function __invoke($id)
    {   

        $student = $this->studentDAOImpl->showStudent($id);

        if($student) {

            $this->studentDAOImpl->destroyStudent($student);
            
            return response()->json([
                'status' => 200,
                'message' => __(self::LANG_PATH . '.succesful.removed')
            ], 200);

        } else {
            return response()->json([
                'status' => 404,
                'message' => __(self::LANG_PATH . '.errors.student_not_found')
            ], 404);
        }
    }
}
