<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\Auth;
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

Route::post("/login", [UserController::class, "Login"])->name("login");
Route::get("/logout", [UserController::class, "Logout"]);
Route::post("/register", [UserController::class, 'CreateUser']);
Route::post("/first_register", [UserController::class, 'FirstRegister']);
Route::post("/verify_code", [UserController::class, 'VerifyCode']);
Route::post("/resend_code", [UserController::class, 'ResendCode']);
Route::post("/verify_code_password", [UserController::class, 'VerifyCodePassword']);
Route::post("/password_recovery", [UserController::class, 'PasswordRecovery']);
Route::post("/password_update", [UserController::class, 'UpdatePassword']);


Route::get("/check_codes", function () {
    TestJob::dispatch();
});
Route::group(["middleware" => "auth"], function () {
    //user manager
    Route::get("/user/profile/{id}", [UserController::class, "GetUser"]);
    Route::delete("/user/delete/{id}", [UserController::class, "DeleteUser"]);
    Route::post("/user/update/{id}", [UserController::class, "UpdateUser"]);
    Route::post("/user/update/logo/{id}", [UserController::class, "UpdateLogo"]);
    Route::get("/user/all", [UserController::class, "GetAllUsers"]);
    Route::get("/user/all/restau", [UserController::class, "GetAllRestau"]);

    //products manager
    Route::post("/product/add", [ProductController::class, "AddProduct"]);
    Route::post("/product/update/{id}", [ProductController::class, "UpdateProduct"]);
    Route::get("/product/all/{id}", [ProductController::class, "GetProducts"]);
    Route::get("/product/all", [ProductController::class, "GetAllProducts"]);
    Route::delete("/product/delete/{id}", [ProductController::class, "DeleteProduct"]);

    //views

    Route::get('/dash', function () {
        return view('dash/pages/main', ["user" => Auth::user()]);
    })->name("dash");

    Route::get('/dash/profile', function () {
        return view('dash/pages/profile', ["user" => Auth::user()]);
    })->name("dash.profile");;
});

Route::get('/getToken', function () {
    return csrf_token();
});


Route::get('/', function () {
    return view('main/pages/index');
});

Route::get('/resto', function () {
    return view('main/pages/menu');
});
Route::get('/profile', function () {
    return view('main/pages/profile');
});
Route::get('/cart', function () {
    return view('main/pages/cart');
});
