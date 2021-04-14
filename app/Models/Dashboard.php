<?php

namespace App\Models;

use App\Models\Intervention;
use App\Models\Voiture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    public static function tabRecupLastSevenDays()
    {
        $tabRecupLastSevenDays[] = [];
        
        for($i = 0; $i < 7; $i++)
        {
            $date = date('Y-m-d', (strtotime(date('Y-m-d'). ' - '.$i.' days')));
            $tabRecupLastSevenDays[$i]['date'] = $date;
            $interventiosByMoth = Intervention::where('created_at','like', $date.'%')->get();
            $tabRecupLastSevenDays[$i]['nbIntervention'] = $interventiosByMoth;
        }
        return $tabRecupLastSevenDays;
    }

    public static function interventionVoitureEnGarages()
    {
        $interventionVoitureEnGarages = Intervention::all();
        return $interventionVoitureEnGarages;
    }
}
