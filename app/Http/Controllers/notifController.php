<?php

namespace App\Http\Controllers;

use App\Events\Notif;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notifController extends Controller
{
    //
    public function storeNotif($title, $content, $from, $to)
    {

        $new = new Notification;
        $new->title = $title;
        $new->content = $content;
        $new->from = $from;
        $new->to = $to;
        $new->save();
        event(new Notif($new));
        return "done";
    }
    public function empty(Request $req)
    {
        $user = Auth::user();
        $notifs = Notification::where("to", $user->user_id)->get();
        foreach ($notifs as $notif) {
            $notif->delete();
        }
        return "done";
    }
}
