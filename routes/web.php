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
// Route::get('/welcome', function () {
//     return view('welcome');
// });
Route::get('/bhw', function () {
    return view('mainpages/bhw');
});
Route::get('/lgu', function () {
    return view('mainpages/lgu');
});
Route::get('/gida', function () {
    return view('mainpages/gida');
});
Route::get('/lhsml', function () {
    return view('mainpages/lhsml');
});
Route::get('/side-panel', [SidePanelController::class, 'show']);


