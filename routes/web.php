<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\GarnitureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SauceController;
use App\Http\Controllers\SupplementController;
use App\Http\Controllers\UserController;
use App\Jobs\TestJob;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Drink;
use App\Models\Garniture;
use App\Models\Product;
use App\Models\Sauce;
use App\Models\Supplement;
use App\Models\User;
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


    //categories manager
    Route::post("/category/add", [CategoryController::class, "AddCategory"])->name("category.add");
    Route::delete("/category/delete/{id}", [CategoryController::class, "DeleteCategory"]);

    //Toppings manager
    Route::post("/topping/add", [GarnitureController::class, "store"])->name("topping.add");
    Route::delete("/topping/delete/{id}", [GarnitureController::class, "Delete"]);

    //Sauces manager
    Route::post("/sauce/add", [SauceController::class, "store"])->name("sauce.add");
    Route::delete("/sauce/delete/{id}", [SauceController::class, "Delete"]);

    //drink manager
    Route::post("/drink/add", [DrinkController::class, "store"])->name("drink.add");
    Route::delete("/drink/delete/{id}", [DrinkController::class, "Delete"]);

    //supplements manager
    Route::post("/supplement/add", [SupplementController::class, "store"])->name("supplement.add");
    Route::delete("/supplement/delete/{id}", [SupplementController::class, "Delete"]);



    //layouts

    Route::get("/dash/toppingsTable", function () {
        $garns = Garniture::where('resto_id', Auth::user()->user_id)->get();
        return view("dash/layouts/toppingsTable", ["garns" => $garns]);
    });
    Route::get("/dash/productsTable", function () {
        $products = Product::where('resto_id', Auth::user()->user_id)
            ->with('Category')
            ->get();
        return view("dash/layouts/productsTable", ["products" => $products]);
    });
    Route::get("/dash/categoriesTable", function () {
        $categs = Category::where('resto_id', Auth::user()->user_id)->get();
        return view("dash/layouts/categoriesTable", ["categs" => $categs]);
    });

    Route::get("/dash/saucesTable", function () {
        $sauces = Sauce::where('resto_id', Auth::user()->user_id)->get();
        return view("dash/layouts/saucesTable", ["sauces" => $sauces]);
    });

    Route::get("/dash/drinksTable", function () {
        $drinks = Drink::where('resto_id', Auth::user()->user_id)->get();
        return view("dash/layouts/drinksTable", ["drinks" => $drinks]);
    });

    Route::get("/dash/supplementsTable", function () {
        $supps = Supplement::where('resto_id', Auth::user()->user_id)->get();
        return view("dash/layouts/supplementsTable", ["supps" => $supps]);
    });




    //views

    Route::get('/dash', function () {
        return view('dash/pages/main', ["user" => Auth::user()]);
    })->name("dash");

    Route::get('/dash/profile', function () {
        return view('dash/pages/profile', ["user" => Auth::user()]);
    })->name("dash.profile");;
    Route::get('/dash/menu', function () {
        return view('dash/pages/menu', ["user" => Auth::user()]);
    })->name("dash.menu");;
});

Route::get('/getToken', function () {
    return csrf_token();
});


Route::get('/', function () {
    $restos = User::where("type", 2)->where("city", "!=", "")->get();
    return view('main/pages/index', ["restos" => $restos]);
})->name("main");

Route::get("/cartContent", function () {
    if (Auth::check()) {
        $id = Auth::user()->user_id;
    } else {
        $id = 0;
    }
    $cart = Cart::where("user_id", $id)->get();
    return view("main/pages/cart", ["items" => $cart]);
});

Route::get('/resto/{id}', function ($id) {
    $user = User::where("user_id", $id)->with("products")->with("sauces")->with("toppings")->with("drinks")->with("supplements")->first();
    return view('main/pages/menu', ["resto" => $user]);
});
Route::get('/profile', function () {
    return view('main/pages/profile');
});
Route::get('/cart', function () {
    return view('main/pages/cart');
});
