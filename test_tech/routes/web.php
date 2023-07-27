<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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


Route::get('/contacts',[ContactController::class,'index'])
->name('contacts.index');
Route::post('/contacts',[ContactController::class,'store'])
->name('contacts.store');
Route::post('/contacts/delete',[ContactController::class,'destroy'])
->name('contacts.destroy');
Route::put('/contacts/{contact}/update',[ContactController::class,'update'])
->name('contacts.update');
Route::get('/contacts/doublon',[ContactController::class,'AddDoubon'])
->name('contacts.doublon');
Route::post('contacts/search',[ContactController::class,'search'])
->name('contacts.search');

