<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Commande;
use App\Models\commande_ref;
use App\Models\Config;
use App\Models\IsNight;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Nette\Utils\Random;

class CommandeController extends Controller
{
    //
    public function store(Request $req)
    {
        try {
            $cart = Cart::where("user_id", Auth::user()->user_id)->with("product")->with("resto")->get();
            $items = [];
            $ref = Random::generate(6, '0-9A-Z');
            $is_night = IsNight::latest()->first();
            $frais_nuit = Config::latest()->first();

            $frais = Auth::user()->region->deliveryPrice;
            if ($is_night->id_night) {
                $frais = $frais_nuit->frais_nuit;
            }

            $notif = new notifController();
            $cmd_id = 0;
            $user = User::where("user_id", Auth::user()->user_id)->first();
            $user->address
                = $req->address;
            $total = 0;
            $user->save();

            foreach ($cart as $item) {
                $total += $item->total;
                $checkref = commande_ref::where("user_id", $item->user_id)->where("resto_id", $item->resto_id)->with("user")->first();
                if ($checkref && !$checkref->is_message) {
                    if ($checkref->statut != 1) {
                        $newRefCmd = new commande_ref;
                        $newRefCmd->user_id = $item->user_id;
                        $newRefCmd->resto_id = $item->resto_id;
                        $newRefCmd->statut = 1;
                        $newRefCmd->frais = $frais;
                        $newRefCmd->taken = 0;
                        $newRefCmd->reference = $ref;
                        $newRefCmd->address = $req->address;
                        $newRefCmd->total = $total;
                        $newRefCmd->by_night = $is_night->id_night;
                        $newRefCmd->save();
                        $cmd_id = $newRefCmd->id;
                    } else {
                        $cmd_id = $checkref->id;
                        $ref = $checkref->reference;
                        $checkref->total += $total;
                        $checkref->save();
                    }
                } else {
                    $newRefCmd = new commande_ref;
                    $newRefCmd->user_id = $item->user_id;
                    $newRefCmd->resto_id = $item->resto_id;
                    $newRefCmd->statut = 1;
                    $newRefCmd->frais = $frais;
                    $newRefCmd->taken = 0;
                    $newRefCmd->reference = $ref;
                    $newRefCmd->by_night = $is_night->id_night;
                    $newRefCmd->total = $total;

                    $newRefCmd->address = $req->address;

                    $newRefCmd->save();
                    $cmd_id = $newRefCmd->id;
                }



                // $checkCmd = Commande::where("product_id", $item->product_id)->where("ref", $refernce)->first();
                $new = new Commande();
                $new->product_id = $item->product_id;
                $new->garnitures = $item->toppings;
                $new->sauces = $item->sauces;
                $new->supplements = $item->supplements;
                $new->drinks = $item->drinks;
                $new->total = $item->total;
                $new->quantity = $item->quantity;
                $new->commande_id = $cmd_id;

                // if ($checkCmd) {
                //     $checkCmd
                //     $created = date("Y-m-d H:i:s", strtotime($checkCmd->created_at));
                //     $date = date("Y-m-d H:i:s", strtotime($created . " + 10 minutes"));

                //     if ($date > date("Y-m-d H:i:s")) {
                //         return response("You recently ordred the product <strong>" . $item->product->label . " </strong>  from <strong>" . $item->resto->name . "</strong>", 500);
                //     }
                // }
                $new->save();
                $notif->storeNotif("Nouvelle commande", "Vous avez reçu une nouvelle commande", $item->user_id, $item->resto_id);

                $item->delete();
            }
            return response("done", 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
