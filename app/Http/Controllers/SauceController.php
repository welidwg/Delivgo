<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;

class SauceController extends Controller
{
    //
    public function store(Request $req)
    {
        $label = $req->label;
        $price = $req->price;
        $resto_id = $req->resto_id;
        $check = Sauce::where("label", $label)->first();
        if (!$check) {
            $new = new Sauce;
            $new->label = $label;
            $new->price = $price;
            $new->resto_id = $resto_id;
            if ($new->save()) {
                return \response(json_encode(["type" => "success", "message" => "Added Successfully"]), 200);
            }
        } else {
            return \response(json_encode(["type" => "error", "message" => "This Sauce already exists "]), 500);
        }
    }

    public function Delete($id)
    {
        if (Sauce::where("id", $id)->first()->delete()) {
            return \response(json_encode(["type" => "success", "message" => "Deleted Successfully"]), 200);
        } else {
            return \response(json_encode(["type" => "error", "message" => "Something went wrong!"]), 500);
        }
    }
}
