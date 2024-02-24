<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SidePanelController;
use App\Http\Controllers\BHWController;
use App\Http\Controllers\GIDAController;

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
    return view('main');
});
Route::get('/bhw', [BHWController::class, 'index']);
Route::get('/lgu', function () {
    return view('mainpages/lgu');
});
Route::get('/gida', [GIDAController::class, 'index']);
Route::get('/lhsml', function () {
    return view('mainpages/lhsml');
});
Route::get('/side-panel', [SidePanelController::class, 'show']);
Route::get('/get-provinces-bhw/{region}', [BHWController::class, 'getProvinces']);
Route::get('/get-cities-bhw/{province}', [BHWController::class, 'getCities']);
Route::get('/get-info-bhw', [BHWController::class, 'getInfo']);


