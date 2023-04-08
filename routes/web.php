<?php

use App\Http\Middleware\MenuMiddleware;
use App\Http\Middleware\PortalCheckMiddleware;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminSkillController;
use App\Http\Controllers\PDFController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin
Route::get('/admin/projects/create', [AdminProjectController::class, 'create'])->name('admin.projects.create');
Route::post('/admin/projects/store', [AdminProjectController::class, 'store'])->name('admin.projects.store');
Route::get('/admin/projects/index', [AdminProjectController::class, 'index'])->name('admin.projects.index');
Route::get('/admin/projects/edit/{id}',[AdminProjectController::class, 'edit'])->name('admin.projects.edit');
Route::post('/admin/projects/update/{id}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
Route::delete('/admin/projects/delete/{id}',[AdminProjectController::class, 'destroy'])->name('admin.projects.destroy');

//user pannel
Route::get('/projects/index', [HomepageController::class, 'index'])->name('projects.index');
Route::get('/projects/index/{id}', [HomepageController::class, 'detail'])->name('projects.detail');

//serach functionality
Route::get('/search', [HomepageController::class, 'search'])->name('projects.search');

//Admin Skill
Route::get('/admin/skills/create', [AdminSkillController::class, 'create'])->name('admin.skills.create');
Route::post('/admin/skills/store', [AdminSkillController::class, 'store'])->name('admin.skills.store');
Route::get('/admin/skills/index', [AdminSkillController::class, 'index'])->name('admin.skills.index');
Route::delete('/admin/skills/delete/{id}',[AdminSkillController::class, 'destroy'])->name('admin.skills.destroy');
//skill chart
Route::get('/skills/index', [HomepageController::class, 'showSkillChart'])->name('skills.index');

//for view
Route::get('/pdf/index', [PDFController::class, 'index'])->name('index');

Route::get('/pdf/view', [PDFController::class, 'pdfView'])->name('pdf.view');


//for convert pdf (/pdf/convert/{id})->for partical one
Route::get('/pdf/convert', [PDFController::class, 'pdfGeneration'])->name('pdf.convert');






Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
