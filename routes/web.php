<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tasksController;
use App\Models\Task;

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


Route::get('/' ,[tasksController::class, 'index']);
Route::post('/add-task/' ,[tasksController::class, 'store'])->name('add.task');
Route::post('/delete-task/{task}' ,[tasksController::class, 'destroy'])->name('delete.task');
Route::put('/complete-task/{task}' , [tasksController::class, 'complete'])->name('complete.task');