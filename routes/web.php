<?php

use App\Http\Controllers\admins\adminsController;
use App\Http\Controllers\admins\authAdminsController;
use App\Models\admin;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('admins',[adminsController::class,'index']);
Route::get('admins/create',[adminsController::class,'create']);
Route::post('admins/store',[adminsController::class,'store']);
Route::delete('admins/delete',[adminsController::class,'remove']);
Route::get('admins/edit/{id}',[adminsController::class,'edit']);
Route::put('admins/update/{id}',[adminsController::class,'update']);

#### Auth Routes
Route::get('login',[authAdminsController::class,'login']);
Route::post('DOLogin',[authAdminsController::class,'doLogin']);
Route::get('logout',[authAdminsController::class,'logout']);
