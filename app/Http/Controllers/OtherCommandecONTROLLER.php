<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\IsNight;
use App\Models\OtherCommande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherCommandecONTROLLER extends Controller
{
    //
    public $notif;

    public function __construct()
    {
        $this->notif
            = new notifController();
    }
    public function store(Request $req)
    {
        try {
            $user_id = Auth::user()->user_id;
            $message = $req->message;


            $new = new OtherCommande;
            $new->message = $message;

            if ($req->hasFile("picture")) {
                $file = $req->file("picture");
                $file_name = time() . "." . $file->getClientOriginalExtension();
                $file->move("uploads/commandes", $file_name);
                $new->picture = $file_name;
            }
            $new->user_id = $user_id;
            $frais = Config::latest()->first();
            $is_night = IsNight::latest()->first();
            $new->frais = Auth::user()->region->deliveryPrice;

            if ($is_night->id_night) {
                $new->by_night = 1;
                $new->frais = $frais->frais_nuit;
            }
            $new->save();
            $check = User::where("type", 3)->where("onDuty", 1)->get();
            foreach ($check as $deliv) {
                $this->notif->storeNotif("Nouvelle commande", "Le client " . Auth::user()->name . " demande un livreur pour livrer ses besoins.", $user_id, $deliv->user_id);
            }
            return response(json_encode(["type" => "success", "message" => "Commande bien envoyée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function accept(Request $req)
    {
        try {
            $id = $req->id;
            $cmd = OtherCommande::where("id", $id)->first();
            if (!$cmd->taken) {
                $cmd->taken = 1;
                $cmd->statut = 2;
                $cmd->deliverer_id = Auth::user()->user_id;
                $cmd->save();
                $this->notif->storeNotif("Commande acceptée", "Le livreur " . Auth::user()->name . " a accepté votre commande.", Auth::user()->user_id, $cmd->user_id);
                return response(json_encode(["type" => "success", "message" => "Commande bien acceptée"]), 200);
            } else {
                return response(json_encode(["type" => "error", "message" => "Commande déjà acceptée par un autre livreur"]), 500);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    public function termine(Request $req)
    {
        try {
            $id = $req->id;
            $cmd = OtherCommande::where("id", $id)->first();

            $cmd->statut = 3;
            $cmd->save();
            $this->notif->storeNotif("Commande livrée", "Le livreur " . Auth::user()->name . " a bien livrée votre commande.", Auth::user()->user_id, $cmd->user_id);
            return response(json_encode(["type" => "success", "message" => "Commande bien acceptée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }

    public function cancel(Request $req)
    {

        try {
            $type = Auth::user()->type;
            $id = $req->id;
            $cmd = OtherCommande::where("id", $id)->first();
            if ($type == 3) {

                $cmd->taken = 0;
                $cmd->statut = 1;
                $cmd->deliverer_id = null;
                $cmd->save();
                $this->notif->storeNotif("Livraison annulée", "Le livreur " . Auth::user()->name . " a annulée la livraison de  votre commande.", Auth::user()->user_id, $cmd->user_id);
                return response(json_encode(["type" => "success", "message" => "Commande bien annulée"]), 200);
            } else {
                if ($cmd->taken) {
                    $this->notif->storeNotif("Commande annulée", "Le client " . Auth::user()->name . " a annulé sa commande.", Auth::user()->user_id, $cmd->deliverer_id);
                }
                $cmd->delete();
                return response(json_encode(["type" => "success", "message" => "Commande bien annulée"]), 200);
            }
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
