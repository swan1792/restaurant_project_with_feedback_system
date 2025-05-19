<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\FeedbackController;

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

Route::get('/',[App\Http\Controllers\OrdersController::class,'index'])->name('order.form');

Route::post('order_submit', [App\Http\Controllers\OrdersController::class, 'submit'])->name('order.submit');


Route::resource('dish', DishesController::class);
Route::get('order', [App\Http\Controllers\DishesController::class,'order'])->name('kitchen.order');
Route::get('order/{order}/approve', [App\Http\Controllers\DishesController::class,'approve']);
Route::get('order/{order}/cancel', [App\Http\Controllers\DishesController::class,'cancel']);
Route::get('order/{order}/ready', [App\Http\Controllers\DishesController::class,'ready']);

Route::get('order/{order}/serve', [App\Http\Controllers\OrdersController::class,'serve']);

// Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.submit');

Route::get('/admin/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks');



Auth::routes(
    ['register' => false,
    'reset' => false,
    'verify' => false,
    'comfirm' => false,]
);
