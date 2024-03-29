<?php

namespace App\Http\Controllers;

use App\Models\Garniture;
use Illuminate\Http\Request;

class GarnitureController extends Controller
{
    //

    public function store(Request $req)
    {
        $label = $req->label;
        $price = $req->price;
        $resto_id = $req->resto_id;
        $check = Garniture::where("label", $label)->where("resto_id", $resto_id)->first();
        if (!$check) {
            $new = new Garniture;
            $new->label = $label;
            $new->price = $price;
            $new->resto_id = $resto_id;
            if ($new->save()) {
                return response(json_encode(["type" => "success", "message" => "Ajoutée avec succès !"]), 200);
            }
        } else {
            return \response(json_encode(["type" => "error", "message" => "Ce garniture est déjà existant "]), 500);
        }
    }
    public function Update(Request $req, $id)
    {
        try {
            $supp = Garniture::where("id", $id)->first();
            $supp->label = $req->label;
            $supp->price = $req->price;

            if ($supp->save()) {
                return \response(json_encode(["type" => "success", "message" => "Mis à jour"]), 200);
            } else {
                return \response(json_encode(["type" => "error", "message" => "Erreur inconnue"]), 500);
            }
        } catch (\Throwable $th) {
            return \response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    public function Delete($id)
    {
        if (Garniture::where("id", $id)->first()->delete()) {
            return \response(json_encode(["type" => "success", "message" => "Supprimé avec succès"]), 200);
        } else {
            return \response(json_encode(["type" => "error", "message" => "Erreur inconnue"]), 500);
        }
    }
}
