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
        $check = Supplement::where("label", $label)->first();
        if (!$check) {
            $new = new Supplement;
            $new->label = $label;
            $new->price = $price;
            $new->resto_id = $resto_id;
            if ($new->save()) {
                return \response(json_encode(["type" => "success", "message" => "Added Successfully"]), 200);
            }
        } else {
            return \response(json_encode(["type" => "error", "message" => "This suppelment already exists "]), 500);
        }
    }

    public function Delete($id)
    {
        if (Supplement::where("id", $id)->first()->delete()) {
            return \response(json_encode(["type" => "success", "message" => "Deleted Successfully"]), 200);
        } else {
            return \response(json_encode(["type" => "error", "message" => "Something went wrong!"]), 500);
        }
    }
}
