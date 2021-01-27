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
    return Liste::where('marques', '=', $marques)->groupby('lemodel')->get();

});

Route::get('listes/model/{lemodel}',function($lemodel){
    return Liste::where('lemodel', '=', $lemodel)->get();

});

Route::get('listes/annee/{lannee}',function($lannee){
    return Liste::where('lannee', '=', $lannee)->get();

});

Route::get('listes/carburant/{lecarburant}',function($lecarburant){
    return Liste::where('lecarburant', '=', $lecarburant)->get();

});