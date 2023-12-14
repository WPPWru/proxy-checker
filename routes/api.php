<?php

use App\Domain\Order\Controllers\GetOrdersController;
use App\Domain\Order\Document\Controllers\OrderDocumentController;
use App\Domain\Order\Starter\AddOrderFromFileByBookingFileObjectController;
use App\Domain\SoapServer\Controllers\SoapController;
use App\Domain\User\Controllers\Auth\AviaWLAuthLoginController;
use App\Domain\User\Controllers\Auth\AviaWLAuthLogoutController;
use App\Domain\User\Controllers\Lifecycle\AviaWLAgentDeleteController;
use App\Domain\User\Controllers\Lifecycle\AviaWLAgentEditController;
use App\Domain\User\Controllers\Lifecycle\AviaWLAgentRegisterController;
use App\Domain\User\Controllers\Lifecycle\AviaWLGetAgentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});