<?php

namespace App\Http\Controllers;

use App\Models\commande_ref;
use App\Models\CommandeMessage;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class CommandeMessageController extends Controller
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
            $user_id = $req->user_id;
            $resto_id = $req->resto_id;
            $cmd_id = 0;
            $ref = Random::generate(6, '0-9A-Z');

            $newRefCmd = new commande_ref;
            $newRefCmd->user_id = $user_id;
            $newRefCmd->resto_id = $resto_id;
            $newRefCmd->statut = 1;
            $newRefCmd->taken = 0;
            $newRefCmd->is_message = 1;
            $newRefCmd->reference = $ref;
            $newRefCmd->save();
            $cmd_id = $newRefCmd->id;
            $new = new CommandeMessage;
            $new->message = $req->message;
            $new->commande_id = $cmd_id;
            $new->save();
            $this->notif->storeNotif("Commande par message", "Vous avez reçu une nouvelle commande par message", $user_id, $resto_id);
            return response(json_encode(["type" => "success", "message" => "Commande bien envoyée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
