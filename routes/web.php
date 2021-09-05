<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;


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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', EntryController::class);

Route::get('/entry/add', function () {
    return view('addEntry');
})->name('addEntry');

Route::post('/entry/add',  [EntryController::class, 'create'])->name('createEntry');


