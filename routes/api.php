<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Liste;
use App\Models\listeproduit;
use App\Models\Produit;
use App\Models\Listedefaut;
use App\Http\Controllers\DeviController;
use App\Http\Controllers\CommandesApiController;
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
Route::resource('commandes', CommandesApiController::class);
Route::get('listes/{marques}',function($marques){
    return Liste::select('lemodel')->where('marques','=',$marques)->orderBy('lemodel')->distinct()->get();  
});

Route::get('listes/model/{lemodel}',function($lemodel){
    return Liste::select('lannee')->where('lemodel','=',$lemodel)->orderBy('lannee','desc')->distinct()->get();
});

Route::get('listes/annee/{lannee}',function($lannee){
    return Liste::select('lecarburant')->where('lannee','=',$lannee)->orderBy('lecarburant')->distinct()->get();
});

Route::get('listes/carburant/{lecarburant}',function($lecarburant){
    return Liste::select('lapuissance')->where('lecarburant','=',$lecarburant)->orderBy('lapuissance','asc')->distinct()->get();
});

Route::get('listescate/{categorie}',function($categorie){
    return listeproduit::select('souscategorie','produit')->where('categorie','=',$categorie)->get();  
});  
Route::get('listesp/{categorie}',function($categorie){
    return listeproduit::select('produit')->where('categorie','=',$categorie)->orderBy('produit','asc')->distinct()->get();  
});  

Route::get('listespu/{produit}',function($produit){
    return listeproduit::select('prix1')->where('produit','=',$produit)->get();  
});  

Route::get('erreurByCode/{code}',function($code){
    return Listedefaut::select('*')->where('code','=',$code)->get();  
});  


Route::get('produit/{categorie}',function($categorie){
    return Produit::select('produit','id', 'categorie')->where('categorie','=',$categorie)->orderBy('produit','asc')->distinct()->get();  
});  

Route::get('commandes/{produit_id}',function($produit){
    return Produit::select('*')->where('produit','=',$produit)->orderBy('produit','asc')->distinct()->get();  
});  

Route::get('produits/{catProduit}',function($produit){
    return Produit::select('*')->where('categorie','=',$produit)->orderBy('produit','asc')->distinct()->get();  
}); 

Route::get('eror',function(){
    return Listedefaut::all();
});
Route::get('listesp',function(){
    return listeproduit::all();
});
Route::get('voitures',function(){
    return Liste::all();
});
Route::get('devis-list',[DeviController::class,'etat']);




