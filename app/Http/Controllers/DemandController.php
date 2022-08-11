<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandController extends Controller
{
    public $notif;
    function __construct()
    {
        $this->notif = new notifController();
    }

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
                return response(json_encode(["type" => "error", "message" => "Vous avez déjà un compte avec cet email !"]), 500);
            }
            $checkDemand = Demande::where("email", $email)->orWhere("phone", $phone)->orWhere("name", "like", "%$nom%")->first();
            if ($checkDemand) {
                return response(json_encode(["type" => "error", "message" => "Il semble que vous avez déjà demandé de nous rejoindre en utilisant ces données!"]), 500);
            }
            $new = new Demande;
            $new->type = $type;
            $new->email = $email;
            $new->name = $nom;
            $new->phone = $phone;
            $message = "Mr/Mme $nom veut rejoigner delivgo";
            if ($type == 2) {
                $message = "L'entreprise $nom veut rejoigner delivgo";
            }
            if ($new->save()) {
                $admin = User::where("type", 4)->get();
                foreach ($admin as $ad) {
                    # code...
                    $this->notif->storeNotif("Nouvelle demande", $message, $ad->user_id, $ad->user_id);
                }

                return response(json_encode(["type" => "success", "message" => "Opération réussite!"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }


    public function Delete($id)
    {
        try {
            $demande = Demande::where("id", $id)->first();
            if ($demande->delete()) {
                return response(json_encode(["type" => "success", "message" => "Opération réussite!"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
