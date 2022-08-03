<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;

class SupplementController extends Controller
{
    public function store(Request $req)
    {
        $label = $req->label;
        $price = $req->price;
        $resto_id = $req->resto_id;
        $check = Supplement::where("label", $label)->where("resto_id", $resto_id)->first();
        if (!$check) {
            $new = new Supplement;
            $new->label = $label;
            $new->price = $price;
            $new->resto_id = $resto_id;
            if ($new->save()) {
                return \response(json_encode(["type" => "success", "message" => "Added Successfully"]), 200);
            }
        } else {
            return \response(json_encode(["type" => "error", "message" => "Ce supplément est déjà existant"]), 500);
        }
    }
    public function Update(Request $req, $id)
    {
        try {
            $supp = Supplement::where("id", $id)->first();
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
        if (Supplement::where("id", $id)->first()->delete()) {
            return \response(json_encode(["type" => "success", "message" => "Supprimé avec succès"]), 200);
        } else {
            return \response(json_encode(["type" => "error", "message" => "Erreur inconnue"]), 500);
        }
    }
}
