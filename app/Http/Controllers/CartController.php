<?php

namespace App\Http\Controllers;

use App\Events\Notif;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Json;

class CartController extends Controller
{
    //
    public function store(Request $req)
    {
        try {
            $product_id = $req->product_id;
            $resto_id = $req->resto_id;
            $user_id = Auth::user()->user_id;
            $qte = $req->input("quantity$product_id");
            $unitTotal = $req->UnitTotal;
            $total = $req->total;
            $supp = [];
            $sauceArr = [];
            $drink = [];
            $topp = [];
            $check = Cart::where("user_id", $user_id)->where("product_id", $product_id)->first();
            $new = new Cart;
            if ($req->has("supplement$product_id")) {
                $supplement = $req->input("supplement$product_id");
                foreach ($supplement as $val) {
                    array_push($supp, $val);
                }
                $new->supplements = json_encode($supp);
                if ($check) {

                    $check->supplements = json_encode($supp);
                }
            }
            if ($req->has("sauces$product_id")) {
                $sauces = $req->input("sauces$product_id");
                foreach ($sauces as $val) {
                    array_push($sauceArr, $val);
                }
                $new->sauces = json_encode($sauceArr);
                if ($check) {

                    $check->sauces = json_encode($sauceArr);
                }
            }
            if ($req->has("drink$product_id")) {
                $drinks = $req->input("drink$product_id");
                foreach ($drinks as $val) {
                    array_push($drink, $val);
                }
                $new->drinks = json_encode($drink);
                if ($check) {

                    $check->drinks = json_encode($drink);
                }
            }
            if ($req->has("topping$product_id")) {
                $toppings = $req->input("topping$product_id");
                foreach ($toppings as $val) {
                    array_push($topp, $val);
                }
                $new->toppings = json_encode($topp);
                if ($check) {

                    $check->toppings = json_encode($topp);
                }
            }

            if ($check) {
                $check->quantity = $qte;
                $check->total = $total;
                $check->UnitTotal = $unitTotal;
                $check->save();
                return response("Panier modifiée", 200);
            }
            $new->resto_id = $resto_id;
            $new->product_id = $product_id;
            $new->user_id = $user_id;
            $new->quantity = $qte;
            $new->total = $total;
            $new->UnitTotal = $unitTotal;

            if ($new->save()) {
              
                return response("Ajouté au panier", 200);
            }


            // return Json::encode($total);;
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
    public function Increment(Request $req)
    {
        $id = $req->idCart;
        $cart = Cart::where("id", $id)->first();
        $cart->total += $cart->UnitTotal;
        $cart->increment("quantity");

        $cart->save();
    }
    public function Decrement(Request $req)
    {
        $id = $req->idCart;
        $cart = Cart::where("id", $id)->first();
        $cart->total -= $cart->UnitTotal;
        $cart->decrement("quantity");
        $cart->save();
    }
    public function Delete($id)
    {
        $cart = Cart::where("id", $id)->first();

        $cart->delete();
        return $id;
    }
    public function DeleteAll($id)
    {
        $carts = Cart::where("user_id", $id)->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }
        return $id;
    }
}
