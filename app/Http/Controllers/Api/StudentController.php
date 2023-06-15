<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\UsesCases\students\CreateUseCase;
use App\Http\UsesCases\students\DestroyUseCase;
use App\Http\UsesCases\students\IndexUseCase;
use App\Http\UsesCases\students\ShowUseCase;
use App\Http\UsesCases\students\UpdateUseCase;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct(

        private IndexUseCase $indexUseCase,
        private CreateUseCase $createUseCase,
        private ShowUseCase $showUseCase,
        private UpdateUseCase $updateUseCase,
        private DestroyUseCase $destroyUseCase

    ) {
    }

    public function index()
    {
        return $this->indexUseCase->__invoke();
    }

    public function create(Request $request)
    {
        return $this->createUseCase->__invoke($request);
    }

    public function show($id)
    {

        return $this->showUseCase->__invoke($id);
    }

    public function update(Request $request, int $id)
    {
        return $this->updateUseCase->__invoke($request, $id);
    }

    public function destroy($id)
    {
        return $this->destroyUseCase->__invoke($id);
    }
}
