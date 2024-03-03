<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\Membercontroller;
use App\Http\Controllers\Shopcontroller;
use App\Http\Controllers\Testcontroller;
use App\Http\Controllers\Usercontroller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'prefix' => '/shop'
], function () {

    // Trang Chủ
    Route::get('/', [Shopcontroller::class, 'index']);
    Route::get('/load-data-product', [Shopcontroller::class, 'loadproduct'])->name('load.data.product');
    Route::get('/product-detail/{id}', [Shopcontroller::class, 'productdetail']);
    // ALL SEARCH
    Route::post('/search-product', [Shopcontroller::class, 'Searchproduct'])->name('search.product');

    //ADD-TO-CART
    Route::post('/add-to-cart', [Shopcontroller::class, 'Addtocart'])->name('add.to.cart');
    //Cart
    Route::get('/cart', [Shopcontroller::class, 'indexCart'])->name('cart');
    Route::get('/load-data-cart', [Shopcontroller::class, 'loadDatacart'])->name('load.data.cart');
    //Action in Cart
    Route::get('/action-in-cart', [Shopcontroller::class, 'ActioninCart'])->name('action.in.cart');

    //checkout
    Route::get('/check-out', [Shopcontroller::class, 'Checkout'])->name('check.out');
    Route::post('/oder-bill', [Shopcontroller::class, 'Oder'])->name('oder.bill');



    Route::group(['middleware' => 'memberNotLogin'], function () {
        //  Đăng Kí
        Route::get('/register-user', [Membercontroller::class, 'indexregister']);
        Route::post('/register-user', [Membercontroller::class, 'createuser']);
        //  Login
        Route::get('/login-user', [Membercontroller::class, 'indexLogin']);
        Route::post('/login-user', [Membercontroller::class, 'ActionLogin']);
    });
    
    Route::group(['middleware' => 'member'], function () {
        //  Logout
        Route::get('/logout', [Membercontroller::class, 'ActionLogout']);

        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', [BlogController::class, 'indexFE']);
            Route::get('/blog-detail/{id}', [BlogController::class, 'ShowBlogDetail'])->name('blog.show');
            // Rate Blog
            Route::post('/rate-blog', [BlogController::class, 'rateBlog'])->name('rate.blog');
            Route::get('/get-rate-blog/{id}', [BlogController::class, 'getrateBlog'])->name('get.rate.blog');

            // Comment Blog
            Route::post('/comment-blog', [BlogController::class, 'CommentBlog'])->name('Comment.blog');
            Route::get('/getdatacomentBlog', [BlogController::class, 'getcmtblog'])->name('get.cmt.blog');
        });

        Route::group(['prefix' => 'account'], function () {
            // Update Account Member
            Route::get('/update-account', [Membercontroller::class, 'IndexAccount'])->name('Account.Member');
            Route::post('/update-account', [Membercontroller::class, 'UpdateAccount'])->name('Account.Member');

            // ADD PRODUCT
            Route::get('/add-product', [Membercontroller::class, 'IndexAddproduct'])->name('Add.product');
            Route::post('/add-product', [Membercontroller::class, 'Addproduct']);
            // My Product
            Route::get('/my-product', [Membercontroller::class, 'Myproduct'])->name('My.product');

            //Delete Product
            Route::get('/delete-product/{id}', [Membercontroller::class, 'destroyProduct']);
            //Edit Product
            Route::get('/edit-product/{id}', [Membercontroller::class, 'EditProduct']);
            Route::post('/edit-product/{id}', [Membercontroller::class, 'UpdateProduct']);
        });
    });
});



Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/',[LoginController::class, 'showLoginForm']);
    Route::get('/login',[LoginController::class, 'showLoginForm']);
    Route::post('/login',[LoginController::class, 'login']);
    Route::get('/logout',[LoginController::class, 'logout']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group([
    'prefix' => '/admin',
    'namespace' => 'Admin',
    'middleware' => ['admin']
], function () {
    Route::get('/dashboard', [Dashboardcontroller::class, 'index']);
    Route::get('/update-profile', [UserController::class, 'indexprofile'])->name('profile');
    Route::post('/update-profile', [UserController::class, 'update'])->name('user.update.profile');

    Route::group(['prefix' => '/country'], function () {
        Route::get('/', [CountryController::class, 'indexcountry']);
        Route::post('/add-title', [CountryController::class, 'store']);
        Route::get('/delete-title/{id}', [CountryController::class, 'destroy']);
        Route::get('/edit-title/{id}', [CountryController::class, 'edit']);
        Route::post('/update', [CountryController::class, 'update']);
    });

    Route::group(['prefix' => '/blog'], function () {
        Route::get('/', [BlogController::class, 'indexBlog']);
        Route::post('/add-blog', [BlogController::class, 'store'])->name('add-blog');
        Route::get('/delete-blog/{id}', [BlogController::class, 'destroy']);
        Route::get('/edit-blog/{id}', [BlogController::class, 'edit']);
        Route::post('/update-blog', [BlogController::class, 'update'])->name('update-blog');
    });

    Route::group(['prefix' => '/brand'], function () {
        Route::get('/', [BrandController::class, 'indexBrand']);
        Route::post('/add-brand', [BrandController::class, 'store']);
        Route::get('/delete-brand/{id}', [BrandController::class, 'destroy']);
        Route::get('/edit-brand/{id}', [BrandController::class, 'edit']);
        Route::post('/update', [BrandController::class, 'update']);
    });
    Route::group(['prefix' => '/category'], function () {
        Route::get('/', [CategoryController::class, 'indexcategory']);
        Route::post('/add-category', [CategoryController::class, 'store']);
        Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
        Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update']);
    });
});
