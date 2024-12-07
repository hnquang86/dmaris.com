<?php

use Illuminate\Support\Facades\File;
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


Route::get('/home', function () {
    return File::get(resource_path('views/index.html'));
});

Route::get('/contact.html', function () {
    return File::get(resource_path('views/contact.html'));
});

Route::get('/menu', function () {
    return File::get(resource_path('views/menu.html'));
}); 

Route::get('/account', function () {
    return File::get(resource_path('views/account.html'));
}); 