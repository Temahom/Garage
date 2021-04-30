<?php
use Carbon\Carbon;
use App\Models\Devi;
use App\Models\Liste;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Voiture;
use App\Models\Listedefaut;
use App\Models\listeproduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviController;
use App\Http\Controllers\CommandesApiController;






Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('chart',function ()
{


    function chiffre($mois)
    {
        $factures=Facture::with('intervention')->whereMonth('created_at', $mois)->where("etat", 2)->get();
    
        //Pour le chiffre d'affaire des factures  payer
        $prixHT=0;
        $chiffe_affaires=0;
        // dd($factures->intervention);
        foreach ($factures as $facture) {
            $intervention=$facture->intervention->first();
    
            if ($intervention->devis_id) {
                $chiffe_affaires+=$intervention->devi->cout+$intervention->diagnostic->coût;
                $devi = Devi::find($intervention->devis_id);
                $les_devis=$devi->produits()->get();
                // dd($le_devis);
                foreach ($les_devis as $le_devi) {
                    $prixHT += $le_devi->pivot->quantite * $le_devi->prix1;
                }
    
            }else{
                $chiffe_affaires+=$intervention->diagnostic->coût;//98 500 000
            }
    
    
    
        }
        $chiffe_affaires+=$prixHT;
    
    
        //  Calcule du chiffre d'affaire des impayée
        $factures_impayer=Facture::with('intervention')->whereMonth('created_at', $mois)->where("etat",1)->get();
        $prixHT_imp=0;
        $chiffe_affaires_imp=0;
        foreach ($factures_impayer as $facture) {
            $intervention=$facture->intervention->first();
            if ($intervention->devis_id) {
                $chiffe_affaires_imp+=$intervention->devi->cout+$intervention->diagnostic->coût;
                $devi = Devi::find($intervention->devis_id);
                $les_devis=$devi->produits()->get();
    
                foreach ($les_devis as $le_devi) {
                    $prixHT_imp += $le_devi->pivot->quantite * $le_devi->prix1;
                }
    
            }else{
                $chiffe_affaires_imp+=$intervention->diagnostic->coût;//98 500 000
            }
    
    
    
        }
        $chiffe_affaires_imp+=$prixHT_imp;
    
        return ["CA"=>$chiffe_affaires ,"CAI"=>$chiffe_affaires_imp];
    }
    


//$chiffe_affaires_imp+=$prixHT_imp;
/**
 * Poru tous les 6 mois
 */

$months = [];
//dd(Carbon::now()->month(02)->format('F'));
Carbon::setLocale('fr');
$mois=Carbon::now()->month;
        for($i = 0; $i <$mois; $i++){
        $array = [];
        $array["chiffre"] =["mois"=>Carbon::now()->create()->month(Carbon::now()->month- $i)->format('F'),"data"=>chiffre(Carbon::now()->month- $i)] ;
        array_push($months, $array);
        }
return $months;

   
});

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

Route::get('vehicules',function(){
    return Voiture::all();
});

Route::get('vehicule/{id}',function($id){
    return Voiture::find($id);
});

Route::get('products',function(){
    return Produit::all();
});

