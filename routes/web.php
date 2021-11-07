<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\LogoutController;
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


Route::get('/', [IndexController::class, 'index'])->name('index');

Route::view('/categories', 'categories.categories')->name('categories');

Route::get('/category/{slug}', [CategoriesController::class, 'showCategory'])->name('showCategory');

Route::get('/products', [ProductController::class, 'products'])->name('products');

Route::get('/product/{slug}', [ProductController::class, 'showProduct'])->name('showProduct');

Route::get('/checkout', [CheckoutController::class, 'checkoutController'])->middleware('auth')->name('checkout');




if (Schema::hasTable('users')) {

	Route::middleware('auth')->group(function () {

	    Route::view('/kabinet', 'Kabinet.kabinet')->name('kabinet');

	    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

	    Route::post('/product/{slug}', [CommentController::class, 'comment'])->name('comment');


	});




	
	
	Route::middleware('guest')->group(function () {

		
		Route::name('auth.')->group(function () {

		    
		    Route::view('/login', 'auth.login')->name('login');

		    
		    Route::post('/login', [LoginController::class, 'loginProcess']);


		    Route::view('/registration', 'auth.registration')->name('registration');

		    
		    Route::post('/registration', [RegistrationController::class, 'registrationUser']);



		    
		    Route::view('/forgot', 'auth.forgot')->name('forgot');
		    Route::post('/forgot-process', [ForgotController::class, 'forgot_process'])->name('forgot_process');

		});

	});


	Route::name('cart.')->group(function () {

		
		Route::view('/cart', 'cart.cart')->name('view');


		Route::post('/add-in-cart', [CartController::class, 'addInCart'])->name('addInCart');

		
		Route::post('/del-elem-cart', [CartController::class, 'delElemCart'])->name('delElemCart');

		
		Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clearCart');

		
		Route::post('/edit-cart', [CartController::class, 'editCart'])->name('editCart');

	});

}







Route::view('/contact', 'ContactForm.contact')->name('contact');
Route::post('/contact-form-process', [ContactController::class, 'contactForm'])->name('contactForm');






