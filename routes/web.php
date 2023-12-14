<?php

use App\Http\Controllers\ProxyCheckController;
use App\Http\Controllers\ProxyCheckResultsController;
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

Route::get('/', function () {
    return view('proxy_checker');
});

// Проверка прокси
Route::post('/check-proxy', ProxyCheckController::class);

// Получение результатов проверки прокси
Route::get('/proxy-check-results', ProxyCheckResultsController::class);
