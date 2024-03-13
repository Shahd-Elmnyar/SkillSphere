<?php

use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\SkillController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ProfileController;

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
// web routes

Route::middleware('lang')->group(function () {
    //home
    Route::get('/', [HomeController::class, 'index']);
    //show category
    Route::get('/categories/show/{id}', [CategoryController::class, 'show']);
    //show skills
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    //show exams
    Route::get('/exams/show/{id}', [ExamController::class, 'show']);
    //show questions
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware('auth', 'verified', 'student');
    //contact page
    Route::get('/contact', [ContactController::class, 'index']);
    //show profile page
    Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth', 'verified', 'student');
});
//start exam
Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware('auth', 'verified', 'student', 'can-enter-exam');
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware('auth', 'verified', 'student');
//send message
Route::post('/contact/message/send', [ContactController::class, 'send ']);
//change language
Route::get('/lang/set/{lang}', [LangController::class, 'set']);


// dashboard routes

Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'index']);
    //category
    Route::get('/categories', [AdminCategoryController::class, 'index']);
    Route::post('/categories/store', [AdminCategoryController::class, 'store']);
    Route::get('/categories/delete/{categorie}', [AdminCategoryController::class, 'delete']);
    Route::post('/categories/update', [AdminCategoryController::class, 'update']);
    Route::get('/categories/toggle/{categorie}', [AdminCategoryController::class, 'toggle']);
    //skills
    Route::get('/skills', [AdminSkillController::class, 'index']);
    Route::post('/skills/store', [AdminSkillController::class, 'store']);
    Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);
    Route::post('/skills/update', [AdminSkillController::class, 'update']);
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);
});
