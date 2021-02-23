<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;

class SmsController extends Controller
{
   



    public function sendMessage()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('f1254d83', 'WIYmOjq1YWbSYdDW');
        $client = new \Nexmo\Client($basic);
        $message = $client->message()->send([
            'to' => '221778531640',
            'to' => '221783071757',
            'from' => 'SAKA-Garage',
            "text" => "SAKA vous remercie d'être passé."
        ]);
        echo "Message envoyé";
    }
}
