<?php

use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
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

// Email Confirmation

Route::get('/email', function(){
    $order = Order::with('user')->first();
    $email = User::first();
    Mail::to($email)->send(new OrderMail($order));
    return new OrderMail($order);
});
