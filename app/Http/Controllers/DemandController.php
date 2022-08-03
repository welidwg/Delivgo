<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    //
    public function store(Request $req)
    {
        try {
            $type = $req->type;
            $email = $req->email;
            $nom = $req->name;
            $phone = $req->phone;
            $first = substr($phone, 0, 1);
            if ($first != "5" && $first != "2" && $first != "4" && $first != "9") {
                return response(json_encode(["type" => "error", "message" => "Veuillez introduire un numéro valide"]), 500);
            }
            $check = User::where("email", $email)->first();
            if ($check) {
                return response(json_encode(["type" => "error", "message" => "Tu as déjà un compte avec cet email !"]), 500);
            }

            $new = new Demande;
            $new->type = $type;
            $new->email = $email;
            $new->name = $nom;
            $new->phone = $phone;
            if ($new->save()) {
                return response(json_encode(["type" => "success", "message" => "Opération réussite!"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
