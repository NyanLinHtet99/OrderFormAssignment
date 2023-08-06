<?php

use App\Http\Controllers\NrcRegionController;
use App\Http\Controllers\NrcTownshipController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\NrcRegion;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/orders', function () {
    return view('orders.index');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::post('/order/store', [OrderController::class, 'store']);
