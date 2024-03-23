<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\SkillController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Models\Role;

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
//change language
Route::get('/lang/set/{lang}', [LangController::class, 'set']);

//start exam

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware('auth', 'verified', 'student', 'can-enter-exam');
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware('auth', 'verified', 'student');

//send message

Route::post('/contact/message/send', [ContactController::class, 'send ']);

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

    //exams

    Route::get('/exams', [AdminExamController::class, 'index']);
    Route::get('/exams/show/{exam}', [AdminExamController::class, 'show']);
    Route::get('/exams/show/{exam}/questions', [AdminExamController::class,'showQuestions']);
    Route::get('/exams/create', [AdminExamController::class, 'create']);
    Route::get('/exams/create-questions/{exam}', [AdminExamController::class, 'createQuestions']);
    Route::post('/exams/store-questions/{exam}', [AdminExamController::class, 'storeQuestions']);
    Route::post('/exams/store', [AdminExamController::class, 'store']);
    Route::get('/exams/delete/{exam}', [AdminExamController::class, 'delete']);
    Route::get('/exams/edit/{exam}', [AdminExamController::class, 'edit']);
    Route::post('/exams/update/{id}', [AdminExamController::class, 'update']);
    Route::get('/exams/toggle/{exam}', [AdminExamController::class, 'toggle']);

    //students

    Route::get('/students',[StudentController::class,'index']);
    Route::get('/students/show-scores/{id}',[StudentController::class,'showScores']);
    Route::get('/students/open-exam/{studentId}/{examId}',[StudentController::class,'openExam']);
    Route::get('/students/close-exam/{studentId}/{examId}',[StudentController::class,'closeExam']);

    //admin
    Route::middleware('superAdmin')->group(function(){
        Route::get('/admins',[AdminController::class,'index']);
        Route::get('/admins/create',[AdminController::class,'create']);
        Route::post('/admins/store',[AdminController::class,'store']);
        Route::get('/admins/promote/{id}',[AdminController::class,'promote']);
        Route::get('/admins/demote/{id}',[AdminController::class,'demote']);
    });
});
