<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(StudentController::class)->prefix("students")->group(function () {

    Route::get("all", "index")->name("students.all");
    Route::post("", "store")->name("students.create");
    Route::get("{id}", "show")->name("students.show");
    Route::put("{id}/edit", "update")->name("students.update");
    Route::delete("{id}/delete", "destroy")->name("students.destroy");
});
