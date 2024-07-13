<?php

use App\Models\Product;
use App\Livewire\SearchUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
Route::redirect('/', '/dashboard', 301);


Route::middleware(['ensureguest'])->group(function () {
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('login#Page');
    Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('register#Page');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // ADMIN ROUTING
    Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {


        // AJAX
        Route::get('orderstatus', [AjaxController::class, 'orderStatus']);

        // ADMIN PRODUCT ROUTING
        Route::group(
            ['prefix' => 'product'],
            function () {
                Route::get('listpage', [ProductController::class, 'productList'])->name('admin#products#list');
                Route::get('createpage', [ProductController::class, 'createProductPage'])->name('admin#product#createpage');
                Route::post('create', [ProductController::class, 'createProduct'])->name('admin#product#create');
                Route::get('updatepage/{id}', [ProductController::class, 'updateProductPage'])->name('admin#product#updatepage');
                Route::post('update/{id}', [ProductController::class, 'updateProduct'])->name('admin#product#update');
                Route::post('delete/{id}', [ProductController::class, 'deleteProduct'])->name('admin#product#delete');
                Route::get('searchpage', [ProductController::class, 'searchProduct'])->name('admin#products#search');
            }
        );

        // ADMIN CATEGORY ROUTING
        Route::group(
            ['prefix' => 'category'],
            function () {
                Route::get('listpage', [CategoryController::class, 'categoryList'])->name('admin#categories#list');
                Route::get('createpage', [CategoryController::class, 'createCategoryPage'])->name('admin#category#createpage');
                Route::post('create', [CategoryController::class, 'createCategory'])->name('admin#category#create');
                Route::get('updatepage/{id}', [CategoryController::class, 'updateCategoryPage'])->name('admin#category#updatepage');
                Route::post('update/{id}', [CategoryController::class, 'updateCategory'])->name('admin#category#update');
                Route::post('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#category#delete');
                Route::get('searchpage', [CategoryController::class, 'searchCategory'])->name('admin#categories#search');
            }
        );

        // ADMIN ORDER ROUTING
        Route::group(
            ['prefix' => 'order'],
            function () {
                Route::get('listpage', [OrderController::class, 'list'])->name('admin#orders#list');
                Route::get('searchpage', [OrderController::class, 'searchPage'])->name('admin#orders#search');
                Route::get('ordered_product/{ordercode}', [OrderController::class, 'productList'])->name('admin#order#list');
            }
        );


        // ADMIN MESSAGE ROUTING
        Route::group(
            ['prefix' => 'messages'],
            function () {
                Route::view('list', 'admin.messages.list');
            }
        );

        // ADMIN ACCOUNT ROUTING
        Route::group(
            ['prefix' => 'account'],
            function () {
                Route::view('changepasswordpage', 'admin.account.changepassword')->name('admin#account#changepasswordpage');
                Route::view('profileinfopage', 'admin.account.profileinformation')->name('admin#account#profilepage');
            }
        );

        // ADMIN PERMISSIONS ROUTING
        Route::group(['prefix' => 'permissions'], function () {
            Route::get('adminlist', [AuthController::class, 'adminList'])->name('admin#list');
            Route::get('adminrole/{id}', [AuthController::class, 'adminRole'])->name('admin#role#change');
            Route::post('admindelete/{id}', [AuthController::class, 'adminDelete'])->name('admin#delete');
            Route::get('adminsearch', [AuthController::class, 'adminSearch'])->name('admin#search');
            Route::get('customer', [AuthController::class, 'customerList'])->name('admin#customer#list');
        });
    });

    // USER ROUTING
    Route::group(['prefix' => 'user', 'middleware' => 'user.auth'], function () {

        // AJAX
        Route::get('productfilter', [AjaxController::class, 'productFilter']);
        Route::get('addcart', [AjaxController::class, 'addToCart']);
        Route::get('editcart', [AjaxController::class, 'editCart']);
        Route::get('deletecart', [AjaxController::class, 'deleteCart']);
        Route::get('clearcart', [AjaxController::class, 'clearCart']);
        Route::get('order', [OrderController::class, 'orderProceed'])->name('order');
        Route::get('viewcount', [AjaxController::class, 'viewCount']);
        Route::get('rater', [RatingController::class, 'rater']);


        Route::group(
            ['prefix' => 'shop'],
            function () {
                Route::get('home', [ShopController::class, 'index'])->name('user#shop');
                Route::group([
                    'prefix' => 'pizza'
                ], function () {
                    Route::get('details/{id}', [ShopController::class, 'pizzaDetails'])->name('user#pizza#details');
                });
                Route::get('cart', [CartController::class, 'list'])->name('user#cart');
                Route::get('order', [OrderController::class, 'list'])->name('user#order');
            }
        );

        Route::group(
            ['prefix' => 'account'],
            function () {
                Route::view('changepasswordpage', 'user.account.changepassword')->name('user#account#changepasswordpage');
                Route::view('profileinfopage', 'user.account.profileinformation')->name('user#account#profilepage');
            }
        );

        Route::group([
            'prefix' => 'message'
        ], function () {
            Route::view('main', 'user.main.message')->name('user#message');
        });
    });
});





Route::get('/searchuser', SearchUser::class);
