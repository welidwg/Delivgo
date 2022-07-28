<?php

namespace App\Http\Controllers;

use App\Models\RequestResto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    //
    public $notifCtrl;
    public function __construct()
    {
        $this->notifCtrl = new notifController();
    }

    public function store()
    {
        try {
            $user = Auth::user();
            $new = new RequestResto;
            $check = User::where("type", 3)->where("onDuty", 1)->get();
            if ($check->count() == 0) {
                return response(json_encode(["type" => "error", "message" => "Aucun livreur est disponible pour le moment"]), 500);
            }

            $new->resto_id = $user->user_id;
            $new->statut = 1;
            $new->save();
            foreach ($check as $deliv) {
                $this->notifCtrl->storeNotif("Nouvelle demande", "Le restaurant $user->name demande immédiatement un livreur", $user->user_id, $deliv->user_id);
            }
            return response(json_encode(["type" => "success", "message" => "Demande bien envoyée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }


    public function accept(Request $req)
    {
        try {
            $id = $req->req_id;
            $request = RequestResto::where("id", $id)->first();
            $request->statut = 2;
            $request->deliverer_id = Auth::user()->user_id;
            $request->save();
            $this->notifCtrl->storeNotif("Demande acceptée", "Le livreur " . $request->deliverer->name . " a accepté votre demande", Auth::user()->user_id, $req->resto_id);

            return response(json_encode(["type" => "success", "message" => "Demande acceptée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function cancel(Request $req)
    {
        try {
            $id = $req->req_id;
            $request = RequestResto::where("id", $id)->first();
            $type = Auth::user()->type;
            if ($type == 3) {
                $request->statut = 1;
                $request->deliverer_id = null;
                $request->save();
                $this->notifCtrl->storeNotif("Annulation", "Le livreur" . Auth::user()->name . " n'est plus chargé pour votre demande", Auth::user()->user_id, $req->resto_id);
            } else {
                $request->delete();
            }


            return response(json_encode(["type" => "success", "message" => "Demande annulée"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
}
