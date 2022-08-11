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
                return response(json_encode(["type" => "error", "message" => "Cette région/ville est déjà existante"]), 500);
            }
            $rec = explode(",", $req->label);
            foreach ($rec as $nom) {
                $new = new Region;
                $new->label = $nom;
                $new->deliveryPrice = $req->prix;
                $new->save();
            }

            return response(json_encode(["type" => "success", "message" => "Région/ville ajoutée !"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function delete($id)
    {
        try {
            //code...

            $reg = Region::where("id", $id)->first();
            if ($reg->delete()) {
                return response(json_encode(["type" => "success", "message" => "Région/ville supprimée !"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function update(Request $req, $id)
    {
        try {
            //code...

            $reg = Region::where("id", $id)->first();
            $reg->label = $req->label;
            $reg->deliveryPrice = $req->prix;
            if ($reg->save()) {
                return response(json_encode(["type" => "success", "message" => "Région/ville modifiée !"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
