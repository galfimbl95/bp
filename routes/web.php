<?php

use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';


Route::get('/', EntryController::class)->middleware(['auth']) ->name('home');

Route::get('/entry/add', function () {
    return view('addEntry');
})->middleware(['auth'])->name('addEntry');

Route::get('entry/{date}', [EntryController::class, 'showDay'])->middleware(['auth'])->name('showDay');

Route::post('/entry/add',  [EntryController::class, 'create'])->middleware(['auth'])->name('createEntry');
