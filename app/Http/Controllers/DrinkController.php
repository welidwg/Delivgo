<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function store(Request $req)
    {
        $label = $req->label;
        $price = $req->price;
        $resto_id = $req->resto_id;
        $check = Drink::where("label", $label)->where("resto_id", $resto_id)->first();
        if (!$check) {
            $new = new Drink;
            $new->label = $label;
            $new->price = $price;
            $new->resto_id = $resto_id;
            if ($new->save()) {
                return response(json_encode(["type" => "success", "message" => "Ajoutée avec succès !"]), 200);
            }
        } else {
            return \response(json_encode(["type" => "error", "message" => "Ce boisson est déjà existant "]), 500);
        }
    }

    public function Delete($id)
    {
        if (Drink::where("id", $id)->first()->delete()) {
            return \response(json_encode(["type" => "success", "message" => "Supprimé avec succès"]), 200);
        } else {
            return \response(json_encode(["type" => "error", "message" => "Erreur inconnue !"]), 500);
        }
    }
}
