<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\historyController;
use App\Http\Controllers\ImportProductController;
use App\Http\Controllers\Membercontroller;
use App\Http\Controllers\Shopcontroller;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\Testcontroller;
use App\Http\Controllers\Usercontroller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'prefix' => '/shop'
], function () {

    // Trang Chủ
    Route::get('/', [Shopcontroller::class, 'index']);
    //testQR

    Route::get('/load-data-product', [Shopcontroller::class, 'loadproduct'])->name('load.data.product');
    Route::get('/product-detail/{id}', [Shopcontroller::class, 'productdetail']);
    Route::post('/review-product',[Shopcontroller::class,'ReviewProduct'])->name('review.Product');

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
    Route::get('/view-update-bill', [Shopcontroller::class, 'ViewUpdateBill'])->name('view-update-bill');
    Route::post('/update-bill', [Shopcontroller::class, 'UpdateBill'])->name('update-bill');

    //shop
    Route::get('/page-shop', [Shopcontroller::class, 'PageShop'])->name('page.shop');



    // Route::group(['middleware' => 'memberNotLogin'], function () {
    //  Đăng Kí
    Route::get('/register-user', [Membercontroller::class, 'indexregister']);
    Route::post('/register-user', [Membercontroller::class, 'createuser']);
    //  Login
    Route::get('/login-user', [Membercontroller::class, 'indexLogin']);
    Route::post('/login-user', [Membercontroller::class, 'ActionLogin']);
    // });

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
        });
    });
});



Auth::routes();

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);
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

    Route::post('/search-product', [Membercontroller::class, 'SearchProduct'])->name('search-product');



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
    Route::group(['prefix' => '/history'], function () {
        Route::get('/', [historyController::class, 'indexhistory'])->name('search.bil.history');
        Route::get('/delete-history/{id}', [historyController::class, 'destroy']);
        Route::post('/filter-history-nótell', [historyController::class, 'loadhistory']);
        Route::get('/change-approve/{id}', [historyController::class, 'changeApprove']);
        // Search-bill
        Route::get('/search-bill-paided', [HistoryController::class, 'paided'])->name('search.bil.paided');
        Route::get('/search-bill-unpaid', [HistoryController::class, 'unpaid'])->name('search.bil.unpaid');
        Route::get('/search-bill-unapprove', [HistoryController::class, 'unapprove'])->name('search.bil.unapprove');

        Route::get('/invoice-detail/{id}', [HistoryController::class, 'viewinvoicedetail'])->name('invoice-detail');

    });

    Route::group(['prefix'=>'/account-user'],function(){
        Route::get('/',[AccountController::class,'viewAccoutuser'])->name('user.Account.indexAccount');

        Route::get('/delete/{id}',[AccountController::class,'destroyAcountuser']);
        Route::get('/block/{id}',[AccountController::class,'BlockAcountuser']);

        Route::get('/update-password/{id}',[AccountController::class,'EditAcountuser']);
        Route::post('/update-password',[AccountController::class,'UpdateAcountuser']);
    });
    Route::group(['prefix'=>'/import-product'],function(){
        Route::get('/',[ImportProductController::class,'viewImportProduct'])->name('view.ImportProduct');
        Route::get('/LoadProduct',[ImportProductController::class,'LoadDataProduct'])->name('LoadDataProduct');
        //Load InvoiceImportProduct
        Route::get('/InvoiceImportProduct',[ImportProductController::class,'LoadInvoiceImportProduct'])->name('Load.Invoice.Import.Product');

        Route::post('/add-Product-in-Bill',[ImportProductController::class,'addProductInBill'])->name('add.Product.in.Bill');
        Route::get('/Load-Product-in-Bill',[ImportProductController::class,'loadProductInBill'])->name('load.Product.In.Bill');


        Route::post('/search-Product-in-Bill',[ImportProductController::class,'searchProductInBill'])->name('search.Product.in.Bill');
        Route::post('/Importbill-product',[ImportProductController::class,'ImportProductInBill'])->name('import.Product.Bill');

        Route::post('/Delete-Importbill-product',[ImportProductController::class,'DeleteImportProductInBill'])->name('Delete.import.Product.Bill');
        Route::post('/Delete-Import-product',[ImportProductController::class,'DeleteImportProduct'])->name('Delete.import.Product');

        Route::get('/Detail-Importbill-product/{id}',[ImportProductController::class,'DetailImportProductInBill'])->name('detail.import.Product.Bill');

    });
    Route::group(['prefix'=>'/statistical'],function(){
        Route::get('/',[StatisticalController::class,'viewStatistical']);
        Route::get('/LoadDatastatistical',[StatisticalController::class,'LoadStatisticalAll'])->name('Load.Statistical.All');

        Route::post('/handle-statistical',[StatisticalController::class,'handleStatisticalAll'])->name('handle.Statistical.All');

        Route::get('/Load-user-review',[StatisticalController::class,'LoaduserReview'])->name('Load.user.Review');
        Route::post('/Delete-user-review',[StatisticalController::class,'DestoyuserReview'])->name('Destroy.user.Review');

    });

});
