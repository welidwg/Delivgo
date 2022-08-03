<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    //

    function store(Request $req)
    {
        try {
            $check = Config::where("id", "!=", null)->first();
            if ($check) {
                $check->frais_nuit = $req->frais_nuit;
                $check->save();
            } else {
                $new = new Config;
                $new->frais_nuit = $req->frais_nuit;
                $new->save();
            }

            return response(json_encode(["type" => "success", "message" => "Opération réussite!"]),200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]),500);
        }
    }
}
