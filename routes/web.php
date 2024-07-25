<?php

// Admin

use App\Http\Controllers\AdminController\DashboardController;
use App\Http\Controllers\AdminController\ProductController  as AdminProductController;
use App\Http\Controllers\AdminController\CategoryController  as AdminCategoryController;
use App\Http\Controllers\AdminController\BannerController  as AdminBannerController;
use App\Http\Controllers\AdminController\VoucherController  as AdminVoucherController;
use App\Http\Controllers\AdminController\OrderController  as AdminOrderController;
use App\Http\Controllers\AdminController\UserController  as AdminUserController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\CartController;
use App\Http\Controllers\UserController\ShopController;
use App\Http\Controllers\UserController\ContactController;
use App\Http\Controllers\UserController\AboutController;
use App\Http\Controllers\UserController\FavoriteController;
use App\Http\Controllers\UserController\AuthController;
use App\Http\Controllers\UserController\DetailController;
use App\Http\Controllers\UserController\InfoController;
use App\Http\Controllers\UserController\OrderController;

// Middleware Auth


// Đã đăng nhập

Route::middleware(['checkAuth', 'verified'])->group(function() {

    Route::controller(InfoController::class)->group(function() {
        Route::get('/info', [InfoController::class, 'index'])->name('info');
        Route::put('/info/{user}', [InfoController::class, 'update'])->name('info-update');
    });
    
    // Order User
    Route::resource('order', OrderController::class);
    
    Route::post('/momo_payment', [OrderController::class, 'momo_payment'])->name('momo_payment');

    Route::get('/order/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');

    // Favorite
    Route::controller(FavoriteController::class)->group(function() {
        Route::middleware('auth')->group(function() {
            Route::get('/favorite',  'index')->name('favorite');
            Route::delete('/favorite/{favorite}',  'destroy')->name('favorite.destroy');
        });
        Route::post('/favorite', 'store')->name('favorite-store');
        
    });

});

// Home
// Route::get('/', [HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/', [HomeController::class, 'index'])->middleware('noCache')->name('home');

// Shop
Route::controller(ShopController::class)->group(function() {
    Route::get('/shop', 'index')->name('shop');
    Route::get('/shop/search', 'search')->name('search.product');
    Route::get('/shop/{category}', 'index')->name('shop.category');
});


// Detail
Route::get('detail/{product}', [DetailController::class, 'index'])->name('detail');

// Cart
Route::middleware('noCache')->group(function(){
    Route::resource('cart', CartController::class);
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
});


// Article
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Auth
Route::controller(AuthController::class)->group(function() {

    // Has Auth
    Route::middleware('guest')->group(function() {
        // Login
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginStore')->name('login-store');
        
        // Register
    
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'registerStore')->name('register-store');

        // Reset password

        Route::get('/forgot-password', 'forgotPassword')->name('password.request');

        Route::post('/forgot-password', 'passwordEmail')->name('password.email');

        Route::get('/reset-password/{token}', 'passwordReset')->name('password.reset');

        Route::post('/reset-password', 'passwordUpdate')->name('password.update');
    });
    
    Route::middleware(['auth', 'noCache'])->group(function() {

        // Change Password

        Route::get('/change-password/{user}', 'changePassword')->name('change-password');
        Route::post('/change-password/{user}', 'changePasswordStore')->name('change-password.store');

        // Logout
        Route::get('/logout', 'logout')->name('logout');
        
        // Thông báo người dùng xác minh email
        Route::get('/email/verify', 'verifyNotice')->name('verification.notice');

        // Xử lí xác minh email
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');

        // Gửi lại email xác minh
        Route::post('/email/verification-notification', 'verifyHandler')->middleware('throttle:6,1')->name('verification.send');
    });
});

// Admin
Route::middleware(['admin', 'verified', 'noCache'])->group(function() {
    
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin Product
    
    Route::controller(AdminProductController::class)->group(function() {
        Route::get('/admin/product', 'index')->name('admin.product.list');
        Route::get('/admin/product/create', 'create')->name('admin.product.create');
        Route::post('/admin/product', 'store')->name('admin.product.store');
        Route::get('/admin/product/{product}/edit', 'edit')->name('admin.product.edit');
        Route::put('/admin/product/{product}', 'update')->name('admin.product.update');
        Route::post('/admin/product/check-order-details', 'checkOrderDetails')->name('admin.product.checkOrderDetails');
        Route::delete('/admin/product/{product}', 'destroy')->name('admin.product.destroy');
        Route::delete('/admin/product/{product}/byCate', 'setCategoryIdProduct')->name('admin.product.destroy.byCate');
        // Route::resource('Product', AdminProductController::class);
    });
    
    // Admin Category
    
    Route::controller(AdminCategoryController::class)->group(function() {
        Route::get('/admin/category', 'index')->name('admin.category.list');
        Route::get('/admin/category/create', 'create')->name('admin.category.create');
        Route::post('/admin/category', 'store')->name('admin.category.store');
        Route::get('/admin/category/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('/admin/category/{category}', 'update')->name('admin.category.update');
        Route::delete('/admin/category/{category}', 'destroy')->name('admin.category.destroy');
        Route::post('/admin/category/check-product', 'checkProduct')->name('admin.category.checkProduct');
    });
    
    
    // Admin Banner
    
    Route::controller(AdminBannerController::class)->group(function() {
        Route::get('/admin/banner', 'index')->name('admin.banner.list');
        Route::get('/admin/banner/create', 'create')->name('admin.banner.create');
        Route::post('/admin/banner', 'store')->name('admin.banner.store');
        Route::get('/admin/banner/{banner}/edit', 'edit')->name('admin.banner.edit');
        Route::put('/admin/banner/{banner}', 'update')->name('admin.banner.update');
        Route::delete('/admin/banner/{banner}', 'destroy')->name('admin.banner.destroy');
    });
    
    
    // Admin Voucher
    
    Route::controller(AdminVoucherController::class)->group(function() {
        Route::get('/admin/voucher', 'index')->name('admin.voucher.list');
        Route::get('/admin/voucher/create', 'create')->name('admin.voucher.create');
        Route::post('/admin/voucher', 'store')->name('admin.voucher.store');
        Route::get('/admin/voucher/{voucher}/edit', 'edit')->name('admin.voucher.edit');
        Route::put('/admin/voucher/{voucher}', 'update')->name('admin.voucher.update');
        Route::delete('/admin/voucher/{voucher}', 'destroy')->name('admin.voucher.destroy');
    });
    
    
    // Admin Order
    
    Route::controller(AdminOrderController::class)->group(function() {

        Route::get('/admin/order', 'index')->name('admin.order.list');
        // Sản phẩm theo status
        Route::get('/admin/order/status/{status}', 'index')->name('admin.order.status');

        Route::get('/admin/order/detail/{order}', 'show')->name('admin.order.show');

        Route::get('/admin/order/{order}/edit', 'edit')->name('admin.order.edit');
        Route::put('/admin/order/{order}', 'update')->name('admin.order.update');
        Route::delete('/admin/order/{order}', 'destroy')->name('admin.order.destroy');
        
        // Admin Order Deails
        
        Route::get('/admin/order/{order}', 'detail')->name('admin.order.detail');

        // Payment methods
    });
    
    
    // Admin User
    
    Route::controller(AdminUserController::class)->group(function() {
        Route::get('/admin/user', 'index')->name('admin.user.list');
        Route::get('/admin/user/create', 'create')->name('admin.user.create');
        Route::post('/admin/user', 'store')->name('admin.user.store');
        Route::get('/admin/user/{user}/edit', 'edit')->name('admin.user.edit');
        Route::put('/admin/user/{user}', 'update')->name('admin.user.update');
        Route::delete('/admin/user/{user}', 'destroy')->name('admin.user.destroy');
    });
});



