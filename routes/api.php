<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('hostname', 'App\Http\Controllers\HostnameController');    

    Route::resource('files', 'App\Http\Controllers\FilesController');
    Route::get('/getFile/{idHostname}', 'App\Http\Controllers\FilesController@onGetFile');
    
    Route::resource('keyFiles', 'App\Http\Controllers\KeyFilesController');    
    Route::post('/onSaveFile', 'App\Http\Controllers\KeyFilesController@onSaveFile');
});