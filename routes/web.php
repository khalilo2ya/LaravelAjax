<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AjaxContactController;
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
    return view('contact');
});



Route::get('ajax-form', [AjaxContactController::class, 'index']);
Route::post('store-data', [AjaxContactController::class, 'store']);
Route::get('contact', [AjaxContactController::class, 'contact']);
Route::post('store-data-json', [AjaxContactController::class, 'store_json']);
