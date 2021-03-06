<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

Route::resource('orders', OrderController::class);
Route::get('/orders/{reference}/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders/{reference}/pay/processing', [OrderController::class, 'payProcessing'])->name('orders.pay_processing');

Route::get('/', function () {
    return redirect(route('orders.create'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
