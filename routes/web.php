<?php

use App\Events\Notif;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandeMessageController;
use App\Http\Controllers\commandesRefController;
use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\GarnitureController;
use App\Http\Controllers\notifController;
use App\Http\Controllers\OtherCommandecONTROLLER;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SauceController;
use App\Http\Controllers\SupplementController;
use App\Http\Controllers\UserController;
use App\Jobs\TestJob;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Commande;
use App\Models\CommandeMessage;
use App\Models\Config;
use App\Models\Drink;
use App\Models\Garniture;
use App\Models\IsNight;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Region;
use App\Models\RequestResto;
use App\Models\Sauce;
use App\Models\Supplement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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


//Demande managaer
Route::post("/demande/add", [DemandController::class, 'store']);
Route::post("/demande/delete/{id}", [DemandController::class, 'Delete']);


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
    Route::post("/user/update/duty/{id}", [UserController::class, "DutyManager"]);
    Route::post("/user/updateAddress/{id}", [UserController::class, "UpdateAddress"]);




    //products manager
    Route::post("/product/add", [ProductController::class, "AddProduct"]);
    Route::post("/product/update/{id}", [ProductController::class, "UpdateProduct"]);
    Route::get("/product/all/{id}", [ProductController::class, "GetProducts"]);
    Route::get("/product/all", [ProductController::class, "GetAllProducts"]);
    Route::delete("/product/delete/{id}", [ProductController::class, "DeleteProduct"]);


    //categories manager
    Route::post("/category/add", [CategoryController::class, "AddCategory"])->name("category.add");
    Route::post("/category/update/{id}", [CategoryController::class, "Update"])->name("category.update");
    Route::delete("/category/delete/{id}", [CategoryController::class, "DeleteCategory"]);

    //Toppings manager
    Route::post("/topping/add", [GarnitureController::class, "store"])->name("topping.add");
    Route::post("/topping/update/{id}", [GarnitureController::class, "Update"])->name("topping.update");

    Route::delete("/topping/delete/{id}", [GarnitureController::class, "Delete"]);

    //Sauces manager
    Route::post("/sauce/add", [SauceController::class, "store"])->name("sauce.add");
    Route::post("/sauce/update/{id}", [SauceController::class, "Update"])->name("sauce.update");

    Route::delete("/sauce/delete/{id}", [SauceController::class, "Delete"]);

    //drink manager
    Route::post("/drink/add", [DrinkController::class, "store"])->name("drink.add");
    Route::post("/drink/update/{id}", [DrinkController::class, "Update"])->name("drink.update");

    Route::delete("/drink/delete/{id}", [DrinkController::class, "Delete"]);

    //supplements manager
    Route::post("/supplement/add", [SupplementController::class, "store"])->name("supplement.add");
    Route::post("/supplement/update/{id}", [SupplementController::class, "Update"])->name("supplement.update");
    Route::delete("/supplement/delete/{id}", [SupplementController::class, "Delete"]);

    //cart_manager    
    Route::post("/cart/add", [CartController::class, "store"])->name("cart.add");
    Route::post("/cart/increment", [CartController::class, "increment"])->name("cart.increment");
    Route::post("/cart/decrement", [CartController::class, "Decrement"])->name("cart.decrement");
    Route::delete("/cart/delete/{id}", [CartController::class, "Delete"])->name("cart.delete.item");
    Route::delete("/cart/delete/all/{id}", [CartController::class, "DeleteAll"])->name("cart.delete.all");


    //commande_manager    
    Route::post("/commande/add", [CommandeController::class, "store"])->name("commande.add");
    Route::post("/commande/statut", [commandesRefController::class, "statut"])->name("commande.statut");
    Route::delete("/commande/delete", [commandesRefController::class, "delete"])->name("commande.delete");


    //commandeMessage_manager    
    Route::post("/commandeMessage/add", [CommandeMessageController::class, "store"])->name("commandemessage.add");

    //otherCommande_Manager
    Route::post("/otherCommande/add", [OtherCommandecONTROLLER::class, "store"])->name("otherCommande.add");
    Route::post("/otherCommande/accept", [OtherCommandecONTROLLER::class, "accept"])->name("otherCommande.accept");
    Route::post("/otherCommande/cancel", [OtherCommandecONTROLLER::class, "cancel"])->name("otherCommande.cancel");
    Route::post("/otherCommande/termine", [OtherCommandecONTROLLER::class, "termine"])->name("otherCommande.termine");


    //request_manager
    Route::post("/request/add", [RequestController::class, "store"])->name("request.add");
    Route::post("/request/accept", [RequestController::class, "accept"])->name("request.accept");
    Route::post("/request/cancel", [RequestController::class, "cancel"])->name("request.cancel");


    //region_manager
    Route::post("/region/add", [RegionController::class, "store"])->name("region.add");
    Route::post("/region/update/{id}", [RegionController::class, "update"])->name("region.update");
    Route::delete("/region/delete/{id}", [RegionController::class, "delete"])->name("region.delete");

    //configs_manager
    Route::post("/configs/add", [ConfigsController::class, "store"])->name("configs.add");


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

    Route::get("/layouts/profile/{id}", function ($id) {
        $user = User::where("user_id", $id)->with("configs")->with("region")->first();
        return view("dash/layouts/profile", ["user" => $user]);
    });




    //views

    Route::get('/dash', function () {
        return view('dash/pages/main', ["user" => Auth::user()]);
    })->name("dash");

    Route::get('/dash/historique', function () {
        return view('dash/pages/historique');
    })->name("dash.historique");

    Route::get('/dash/historiqueContent', function () {
        return view('dash/layouts/historiqueContent');
    })->name("dash.historiqueC");

    Route::get(
        '/dash/users',
        function () {
            return view('dash/pages/users', ["users" => User::where("user_id", "!=", Auth::user()->user_id)->get()]);
        }
    )->name("dash.users");

    Route::get('/dash/mainContent', function () {
        return view('dash/layouts/indexContent', ["user" => Auth::user()]);
    })->name("dash.mainContent");


    Route::get('/dash/stats', function () {
        return view('dash/pages/stats', ["user" => Auth::user()]);
    })->name("stats");


    Route::get('/dash/mainContent', function () {
        return view('dash/layouts/indexContent', ["user" => Auth::user()]);
    })->name("dash.mainContent");

    Route::get('/dash/profile/{id}', function ($id) {
        $user = User::where("user_id", $id)->first();
        return view('dash/pages/profile', ["user" => $user]);
    })->name("dash.profile");;


    Route::get('/dash/menu', function () {
        return view('dash/pages/menu', ["user" => Auth::user()]);
    })->name("dash.menu");;

    Route::get('/orders', function () {
        return view('main/pages/orders', ["user" => Auth::user()]);
    })->name("main.orders");


    Route::get('/ordersTable', function () {
        $is_night = IsNight::latest()->first();
        $frais_nuit = Config::latest()->first();
        return view('main/layouts/ordersTable', ["user" => Auth::user(), "frais_nuit" => $frais_nuit, "is_night" => $is_night->id_night]);
    })->name("main.ordersTable");

    //notif_manager
    Route::post("/notif/empty", [notifController::class, "empty"]);
    Route::get('/notif', function () {
        return view('main/layouts/notif');
    })->name("main.notifs");
    Route::post("/notif/seen", function () {
        $notifs = Notification::where('to', Auth::user()->user_id)
            ->where("seen", 0)
            ->with('sender')
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($notifs as $notif) {
            $notif->seen = 1;
            $notif->save();
        }
        return "done";
    });
    Route::get("/checkNotifNumber", function () {
        $notifs = Notification::where('to', Auth::user()->user_id)

            ->with('sender')
            ->orderBy('created_at', 'desc')
            ->get();
        $seen = false;
        foreach ($notifs as $notif) {
            if ($notif->seen == 0) {
                $seen = true;
                break;
            }
        }

        return $seen;
    });
});

Route::get('/getToken', function () {
    return csrf_token();
});


Route::get('/', function () {
    $restos = User::where("type", 2)->where("city", "!=", "")->with("region")->get();
    $is_night = IsNight::latest()->first();
    return view('main/pages/index', ["restos" => $restos, "is_night" => $is_night->id_night]);
})->name("main");

Route::get("/cartContent", function () {
    $is_night = IsNight::latest()->first();
    $frais_nuit = Config::latest()->first();
    if (Auth::check()) {
        $id = Auth::user()->user_id;
    } else {
        $id = 0;
    }
    $cart = Cart::where("user_id", $id)->with("product")->with("resto")->get();
    if ($cart->count() > 0) {
        return view("main/pages/cart", ["items" => $cart, "frais_nuit" => $frais_nuit, "is_night" => $is_night->id_night]);
    } else {
        return view("main/layouts/notfound", ["message" => "Votre panier est vide", "cart" => true]);
    }
});

Route::get("/restosContent/{params}", function (Request $req, $params) {

    $city = Region::get();
    $arr = [];
    $is_night = IsNight::latest()->first();
    $frais_nuit = Config::latest()->first();
    $check = false;
    foreach ($city as $ct) {
        array_push($arr, $ct->label);
    }
    if ($params == "0" || $params == "") {
        $restos = User::where("type", 2)->where("city", "!=", "")->with("region")->with("products")->get();
    } else {
        if (in_array($params, $arr)) {
            $restos = User::where("type", 2)->where("city", "!=", "")->with("region")->with("products")->get();
        } else {
            $restos = [];
            $check = true;
        }
    }

    return view("main/layouts/restoCard", ["restos" => $restos, "check" => $check, "is_night" => $is_night->id_night, "frais_nuit" => $frais_nuit->frais_nuit, "params" => $params]);
});

Route::get('/resto/{id}', function ($id) {
    $user = User::where("user_id", $id)->with("region")->with("products")->with("sauces")->with("toppings")->with("drinks")->with("supplements")->with('configs')
        ->first();
    return view('main/pages/menu', ["resto" => $user]);
});
Route::get('/profile/{id}', function () {
    return view('main/pages/profile');
});
Route::get('/cart', function () {
    return view('main/pages/cart');
});

Route::get("/test", function () {
    $geocoder = new Geocodio();
    $response = Geocodio::reverse('35.6777984,10.092544');
    dump($response);
});



Route::post("/location", function (Request $req) {
    Mapper::map($req->lat, $req->long);
    return Mapper::render();
});

Route::post("/frais/verif", function (Request $req) {
    $night = $req->night;
    if ($night == true) {
        $frais = Config::latest();
        return json_encode(["night" => true, "frais" => $frais]);
    }
    return "none";
});


Route::get("/isnight", function () {

    try {
        $check = Config::latest()->first();
        $is_night = IsNight::latest()->first();
        $now = Carbon::now();
        $curr = date('a');
        $start = Carbon::createFromTimeString($check->du);
        $end = Carbon::createFromTimeString($check->to);
        if (!$is_night) {
            $is_night = new IsNight;
        }
        if ($curr == 'am') {
            $start = Carbon::createFromTimeString($check->du)->subDay();
        } else {
            $end = Carbon::createFromTimeString($check->to)->addDay();
        }

        if ($now->between($start, $end, true)) {
            $is_night->id_night = 1;
        } else {
            $is_night->id_night = 0;
        }

        $is_night->save();
        return response(json_encode(["type" => "success", "message" => "done"]), 200);
    } catch (\Throwable $th) {
        return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
    }
});
