<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Jobs\TestJob;
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
Route::post("/logout", [UserController::class, "Logout"]);
Route::post("/register", [UserController::class, 'CreateUser']);
Route::post("/verify_code", [UserController::class, 'VerifyCode']);
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
    Route::get("/user/all", [UserController::class, "GetAllUsers"]);
    Route::get("/user/all/restau", [UserController::class, "GetAllRestau"]);

    //products manager
    Route::post("/product/add", [ProductController::class, "AddProduct"]);
    Route::post("/product/update/{id}", [ProductController::class, "UpdateProduct"]);
    Route::get("/product/all/{id}", [ProductController::class, "GetProducts"]);
    Route::get("/product/all", [ProductController::class, "GetAllProducts"]);
    Route::delete("/product/delete/{id}", [ProductController::class, "DeleteProduct"]);
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
