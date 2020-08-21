<?php

use App\Http\Controllers\UserController;
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

//Admin Routes

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => ['auth:admin']], function () {

        //Dashboard
        Route::get('/', 'DashboardController@index');

        //Products
        Route::resource('/products', 'ProductController');

        //Orders
        Route::resource('/orders', 'OrderController');
        Route::get('/orders/confirm/{id}', 'OrderController@confirm')->name('order.confirm');
        Route::get('/orders/pending/{id}', 'OrderController@pending')->name('order.pending');

        //Users
        Route::get('/users', 'UserController@index');
        Route::get('/users/show/{id}', 'UserController@show')->name('user.show');

        //Logout
        Route::get('/logout', 'AdminUserController@logout');
    });

    //Admin Login
    Route::get('/login', 'AdminUserController@index');
    Route::post('/login', 'AdminUserController@store');
});

Route::prefix('user')->group(function () {

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/logout', 'Front\SessionsController@logout');

        Route::get('/profile', 'Front\UserProfileController@index');
        Route::get('/profile/edit', 'Front\UserProfileController@edit');
        Route::put('/profile/edit/{id}', 'Front\UserProfileController@update');
        Route::get('/profile/show/{id}', 'Front\UserProfileController@show')->name('userOrders.show');

        Route::get('/cart', 'Front\CartController@index');
        Route::post('/cart', 'Front\CartController@store');
        Route::delete('/cart/remove/{rowId}', 'Front\CartController@remove')->name('userCart.remove');
        Route::put('/cart/addtowishlist/{rowId}', 'Front\CartController@addToWishlist')->name('userCart.addToWishlist');
        Route::patch('/cart/update/{rowId}', 'Front\CartController@update')->name('userCart.updateQuantity');

        Route::post('/wishlist', 'Front\WishListController@store');
        Route::delete('/wishlist/remove/{rowId}', 'Front\WishListController@remove')->name('userWishlist.remove');
        Route::put('/wishlist/movetocart/{rowId}', 'Front\WishListController@moveToCart')->name('userWishlist.moveToCart');

        Route::get('/checkout', 'Front\CheckoutContoller@index');
        Route::post('/checkout', 'Front\CheckoutContoller@store');

    });

    Route::get('/register', 'Front\RegistrationController@index');
    Route::post('/register', 'Front\RegistrationController@store');

});

Route::get('/login', 'Front\SessionsController@index')->name('login');
Route::post('/login', 'Front\SessionsController@store');

Route::get('/', 'Front\HomeController@index');
