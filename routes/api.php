<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register',[AuthController::class,'register']);


Route::get('categories',[CategoryController::class,'index']);
Route::get('categories/show/{category}',[CategoryController::class,'show']);

Route::get('skills/show/{skill}',[SkillController::class,'show']);

Route::get('exams/show/{exam}',[ExamController::class,'show']);

Route::middleware('auth:sanctum')->group(function(){
Route::post('exams/start/{examId}',[ExamController::class,'start']);
Route::post('exams/submit/{examId}',[ExamController::class,'submit']);

Route::get('exams/show-questions/{exam}',[ExamController::class,'showQuestions']);
});