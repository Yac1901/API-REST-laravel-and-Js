<?php

namespace App\Http\UsesCases\students;

use App\Http\DAO\impl\StudentDAOImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateUseCase
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

    public function __invoke(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'course' => 'required|string|max:100',
            'email' => 'required|unique:students,email|max:100',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $student = $this->studentDAOImpl->showStudent($id);

            if ($student) {

                $this->studentDAOImpl->updateStudent($request, $student);

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
}
