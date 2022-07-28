<?php

namespace App\Http\Controllers;

use App\Models\commande_ref;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commandesRefController extends Controller
{
    //
    public function statut(Request $req)
    {
        $statut = $req->statut;
        $user_id = $req->user_id;
        $resto_id = $req->resto_id;
        $cmds = [];
        $notif = new notifController();
        try {
            switch ($statut) {

                case 2:
                    # code...
                    $cmds =
                        commande_ref::where("user_id", $user_id)->where("resto_id", $resto_id)->where("statut", 1)->with("resto")->first();
                    $notif->storeNotif($cmds->resto->name, "" . $cmds->resto->name . " a commencé le traitement de votre commande", $resto_id, $user_id);

                    break;
                case 3:
                    # code...
                    $cmds =
                        commande_ref::where("user_id", $user_id)->where("resto_id", $resto_id)->where("statut", 2)->with("resto")->with("deliverer")->first();
                    if ($cmds->taken) {
                        $notif->storeNotif($cmds->resto->name, " Votre commande est prêt est va être délivrée par  " . $cmds->deliverer->name, $resto_id, $user_id);
                        $notif->storeNotif($cmds->resto->name, " La commande que vous avez acceptée est prêt ", $resto_id, $cmds->deliverer->user_id);
                        $statut = 4;
                    } else {
                        $notif->storeNotif($cmds->resto->name, "Votre demande est prêt est en attente de livreur", $resto_id, $user_id);
                    }

                    break;
                case 4:
                    # code...
                    if (Auth::user()->type == 3) {
                        $cmds =
                            commande_ref::where("id", $req->req_id)->with("resto")->with("user")->first();
                    } else {
                        $cmds =
                            commande_ref::where("user_id", $user_id)->where("resto_id", $resto_id)->with("resto")->with("user")->first();
                    }

                    if ($cmds->statut == 3) {
                        $notif->storeNotif($cmds->resto->name, " Votre commande  est en cours de livraison", $resto_id, $user_id);
                    } else {
                        $statut = $cmds->statut;
                    }
                    $notif->storeNotif("Commande acceptée", "Votre commande est acceptée par le livreur  " . Auth::user()->name, $user_id, $resto_id);

                    $cmds->taken = 1;
                    $cmds->deliverer_id = Auth::user()->user_id;


                    break;
                case 5:
                    # code...
                    $cmds =
                        commande_ref::where("user_id", $user_id)->where("resto_id", $resto_id)->where("statut", 4)->with("resto")->with("user")->first();
                    $notif->storeNotif("Livraison", " Votre commande du " . $cmds->resto->name . " est delivrée avec succès", $resto_id, $user_id);
                    $notif->storeNotif("Livraison", " La commande du " . $cmds->user->name . " est delivrée avec succès  ", $user_id, $resto_id);

                    break;
                case 6:
                    # code...
                    $cmds =
                        commande_ref::where("user_id", $user_id)->where("resto_id", $resto_id)->with("resto")->with("user")->with("deliverer")->first();

                    if (Auth::user()->type == 3) {
                        # code...
                        $notif->storeNotif("Livraison", "Le livreur " . $cmds->deliverer->name . " a annulé la livraison de la commande ", $cmds->deliverer->user_id, $resto_id);
                        $statut = 3;
                        $cmds->taken = 0;
                        $cmds->deliverer_id = null;
                    } else {
                        $notif->storeNotif("Commande", $cmds->user->name . " a annulé sa commande ", $user_id, $resto_id);
                    }

                    break;
                default:
                    # code...
                    break;
            }
            $cmds->statut = $statut;
            $cmds->save();
            return response(json_encode(["type" => "success", "message" => "Mis à jour"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function delete(Request $req)
    {
        // $user_id = $req->user_id;
        // $resto_id = $req->resto_id;
        $cmds = commande_ref::where("id", $req->id)->first();
        $cmds->delete();
        return response(json_encode(["type" => "success", "message" => "Mis à jour"]), 200);
    }
}
