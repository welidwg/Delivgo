<?php

namespace App\Http\Controllers;

use App\Events\Notif;
use App\Models\Notification;
use Illuminate\Http\Request;

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
}
