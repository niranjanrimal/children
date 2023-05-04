<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildrenController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/children',[ChildrenController::class, 'index'])->name('children.index');

Route::post('/children',[ChildrenController::class, 'store'])->name('children.store');

Route::delete('/children/{child}',[ChildrenController::class, 'destroy'])->name('children.destroy');