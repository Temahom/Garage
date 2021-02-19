<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeviController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ActorController;

use Illuminate\Support\Facades\App;

     
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('Pdf', function () {
   
   $commandes= \App\Models\Commande::all();
   
    $pdf = PDF::loadView('Pdf.pdf',["commandes"=>$commandes]);    
    return $pdf->stream('Devis.pdf');
});
   
Route::middleware('auth')->group(function () {

    Route::resource('produits',ProduitController::class);
    Route::resource('clients',ClientController::class);  
    Route::resource('clients.voitures', VoitureController::class);
    Route::resource('factures',FactureController::class);
    Route::resource('voitures',VoitureController::class);
    Route::resource('voitures.interventions',InterventionController::class);
    Route::resource('voitures.interventions.reparations',ReparationController::class);
    Route::resource('voitures.interventions.devis',DeviController::class);
    Route::resource('commandes', CommandeController::class);
    Route::resource('voitures.interventions.devis.commandes', CommandeController::class);
    Route::resource('actors', ActorController::class);
    Route::resource('voitures.interventions.diagnostics',DiagnosticController::class);
    Route::resource('diagnostics', DiagnosticController::class);
    
    Route::get('/interventions-list', [InterventionController::class, 'index']);
    Route::get('/devis-etat', [DeviController::class, 'etat']);
    
    
   Route::get('/produits.creer', [ProduitController::class, 'creer']);


    Route::get('/admin', function () {
        return view('admin.home');
    });
        
});


Route::middleware(['auth','manager'])->group(function () {

});
    
 
Route::middleware(['auth','user'])->group(function () {
    
});




