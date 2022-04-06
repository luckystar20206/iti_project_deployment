<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Product;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;


use App\Http\Controllers\Api\UserProductController;
use App\Http\Controllers\Api\ReviewsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

///////////////////// Orders //////////////////////////////////////////

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
Route::post('/orders', [OrderController::class, 'store']);

// // Email Confirmation

// Route::get('/email', function(){

//     Mail::to('user_name@bruh.com')->send(new OrderMail);
//     return new OrderMail();
// });


// Route::resource('orders', OrderController::class);

////////////////////////////////////////////////////////////////////////

Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
});

Route::group(['middleware' => ['jwt.auth']], function () {
});

//////////////////////// User ///////////////////////////////


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Show All Users
Route::get('users', [UserController::class, "index"]);


// Update user's data (Protected route : requires token)
Route::put('users/{id}', [UserController::class, "update"]);

// Show user by id (Protected route : requires token)
Route::get('users/{id}', [UserController::class, "show"]);


// To get a new token after expiry of the token (Protected route : requires old token to renew it)
Route::get('refresh', [UserController::class, "refresh"]);
//

// Delete User
Route::delete('users/{id}', [UserController::class, "destroy"]);



Route::get('/brands', [BrandController::class, 'index']);
Route::get('/brands/{id}', [BrandController::class, 'getProducts']);
Route::post('/brands', [BrandController::class, 'store']);
Route::delete('brands/{id}', [BrandController::class, 'destroy']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [BrandController::class, 'getProducts']);
Route::post('categories', [CategoryController::class, 'store']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

///////////////////////////////////////////////////////////////////////
//                         Products                                  //
///////////////////////////////////////////////////////////////////////

// List
Route::get('/products', [ProductController::class, 'index']);

// Store
Route::post('/products', [ProductController::class, 'store']);

// Show Single Product
Route::get('/products/{id}',[ProductController::class,'show']);

// Update
Route::put('products/{id}',[ProductController::class,'update']);

// Delete
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Search -- Tested In Postman
Route::get('/products/search/{name}',[ProductController::class,'search']);


// Top products
Route::get('/topproducts',[ProductController::class,'rating']);


////////////////////// WishList///////////////////////
Route::post('/userproducts', [UserProductController::class,'store']);
Route::delete('/userproducts/{id}/{user_id}',[UserProductController::class,'destroy']);
Route::get('/userproducts/{id}', [UserProductController::class,'show']);


// Show Related Products

Route::get('/products/show/{id}',[ProductController::class,'showRealted']);

// Get Product Reviews
Route::get('/reviews', [ReviewsController::class,'index']);

// Get Avg  Rate For Each product
Route::get('/products/rate/{id}', [ReviewsController::class,'showRates']);

// Route::post('/products/rates/{id}', [ProductController::class,'storeAvgRate']);


// check if product in wishlist
Route::get('/products/wishlist/{id}', [ProductController::class,'checkProduct']);

//Add Rate For Product which is put
Route::post('/products/rate', [ReviewsController::class,'store']);
///////////////////// Orders //////////////////////////////////////////

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
Route::post('/orders', [OrderController::class, 'store']);


///////////////////////// Cart ////////////////////////////////////

Route::get('/carts', [CartController::class, 'index']);
Route::get('/carts/{id}', [CartController::class, 'show']);
Route::post('/carts', [CartController::class, 'store']);
Route::put('/carts/{id}', [CartController::class, 'update']);
Route::delete('/carts/{id}', [CartController::class, 'destroy']);

