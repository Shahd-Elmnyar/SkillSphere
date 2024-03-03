<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\SkillController;
use App\Http\Controllers\Web\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('lang')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [CategoryController::class, 'show']);
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    Route::get('/exams/show/{id}', [ExamController::class, 'show']);
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware('auth','verified','student');
    Route::get('/contact', [ContactController::class, 'index']);
});
Route::post('/exams/start/{id}',[ExamController::class,'start'])->middleware('auth','verified','student');
Route::post('/exams/submit/{id}',[ExamController::class,'submit'])->middleware('auth','verified','student');
Route::post('/contact/message/send', [ContactController::class, 'send ']);
Route::get('/lang/set/{lang}', [LangController::class, 'set']);
