<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //

    public function store(Request $req)
    {
        try {
            $check = Region::where("label", "like", "%$req->label%")->first();
            if ($check) {
                return response(json_encode(["type" => "error", "message" => "Cette région est déjà ajoutée"]), 500);
            }
            $rec = explode(",", $req->label);
            foreach ($rec as $nom) {
                $new = new Region;
                $new->label = $nom;
                $new->deliveryPrice = $req->prix;
                $new->save();
            }

            return response(json_encode(["type" => "success", "message" => "Région ajoutée !"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
