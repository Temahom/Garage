<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Liste;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('listes/{marques}',function($marques){
    return Liste::select('lemodel')->where('marques','=',$marques)->orderBy('lemodel')->distinct()->get();  
});

Route::get('listes/model/{lemodel}',function($lemodel){
    return Liste::select('lannee')->where('lemodel','=',$lemodel)->orderBy('lannee')->distinct()->get();
});

Route::get('listes/annee/{lannee}',function($lannee){
    return Liste::select('lecarburant')->where('lannee','=',$lannee)->orderBy('lecarburant')->distinct()->get();
});

Route::get('listes/carburant/{lecarburant}',function($lecarburant){
    return Liste::select('lapuissance')->where('lecarburant','=',$lecarburant)->orderBy('lapuissance')->distinct()->get();
});