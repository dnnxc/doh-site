<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SidePanelController;

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
    return view('welcome');
});
Route::get('/test_1', function () {
    return view('test_1');
});
Route::get('/side-panel', [SidePanelController::class, 'show']);


