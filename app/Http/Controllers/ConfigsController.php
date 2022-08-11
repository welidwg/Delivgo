<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
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
                $check->du = $req->du;
                $check->to = $req->to;

                $check->save();
            } else {
                $new = new Config;
                $new->frais_nuit = $req->frais_nuit;
                $check->du = $req->du;
                $check->to = $req->to;
                $new->save();
            }

            return response(json_encode(["type" => "success", "message" => "Opération réussite!"]), 200);
        } catch (\Throwable $th) {
            return response(json_encode(["type" => "error", "message" => $th->getMessage()]), 500);
        }
    }
    public function CheckDate()
    {
        // $tz = new DateTimeZone('Africa/Tunis');


        // $time = Carbon::now($tz); // Current time
        // $start = Carbon::create( 22, 0, 0, $tz);
        // $end = Carbon::create( 06, 0, 0, $tz);
        // $test = 0;

        // if ($time->between($start, $end)) {
        //     $test = 1;
        // }

        // return "tets";
    }
}
