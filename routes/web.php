<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
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

// Front management
Route::get("/", [FrontController::class, "index"]);
Route::get("checkout", [FrontController::class, "checkout"]);
Route::get("register", [FrontController::class, "register"]);
Route::get("login", [FrontController::class, "login"]);
Route::get("forgot-password", [FrontController::class, "forgot_password"]);
Route::post("set_session", [FrontController::class, "set_session"]);
Route::post("locale", [FrontController::class, "set_local"]);

Route::post("forgot-password/email", [CustomerController::class, "submit_forgot_password"])->name('forgot-password.email');



Route::post("register/store", [CustomerController::class, "store"])->name('register.store');
Route::post("login/getLogin", [CustomerController::class, "getLogin"])->name('login.getLogin');
Route::get("/userLogout", [CustomerController::class, "userLogout"]);
Route::get("/verification/{id}", [CustomerController::class, "email_verification"]);
Route::get("recover-password/{id}", [CustomerController::class, "recover_password"]);
Route::post("recover-password/password", [CustomerController::class, "recover_password_submit"])->name('submit-recover-password.password');

Route::group(["middleware"=>"user_auth"], function(){
    Route::get("checkout", [FrontController::class, "checkout"]);
    Route::get("order", [OrderController::class, "index"]);
    Route::post("checkout/coupon", [CouponController::class, "show"])->name('coupon.get');
    Route::post("checkout/order", [OrderController::class, "store"])->name('checkout.order');
    Route::get("order-success", [FrontController::class, "orderSuccess"]);
});

// Admin Management
Route::get("admin", [AdminController::class, "index"]);
Route::post("admin/auth", [AdminController::class, "auth"])->name('admin.auth');

Route::group(["middleware"=>"admin_auth", "prefix"=>"admin"], function(){
    Route::get("/dashboard", [AdminController::class, "dashboard"]);
    Route::get("/logout", [AdminController::class, "logout"]);

    // Category Page
    Route::get("/category", [CategoryController::class, "index"]);
    Route::get("/category/destroy/{id}", [CategoryController::class, "destroy"]);
    Route::get("/category/edit/{id}", [CategoryController::class, "edit"]);
    Route::post("/category/store", [CategoryController::class, "store"])->name('category.store');
    Route::post("/category/update", [CategoryController::class, "update"])->name('category.update');

    // Coupon page
    Route::get("/coupon", [CouponController::class, "index"]);
    Route::get("/coupon/create", [CouponController::class, "create"]);
    Route::get("/coupon/destroy/{id}", [CouponController::class, "destroy"]);
    Route::get("/coupon/edit/{id}", [CouponController::class, "edit"]);
    Route::post("/coupon/store", [CouponController::class, "store"])->name('coupon.store');
    Route::post("/coupon/update", [CouponController::class, "update"])->name('coupon.update');

    // Product page
    Route::get("/product", [ProductController::class, "index"]);
    Route::get("/product/create", [ProductController::class, "create"]);
    Route::get("/product/destroy/{id}", [ProductController::class, "destroy"]);
    Route::get("/product/edit/{id}", [ProductController::class, "edit"]);
    Route::post("/product/store", [ProductController::class, "store"])->name('product.store');
    Route::post("/product/update", [ProductController::class, "update"])->name('product.update');

});
