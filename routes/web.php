<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\InterventionController;


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
   
Route::middleware(['auth','admin' ])->group(function () {
    Route::resource('reparations',ReparationController::class);
    Route::resource('voitures',VoitureController::class);
    Route::get('/admin', function () {
        return view('admin.home');
    });
        
    
    
    });


    Route::middleware(['auth','manager'])->group(function () {
        Route::resource('factures',FactureController::class);
        Route::resource('diagnostics',DiagnosticController::class);
        Route::resource('devis',DevisController::class);
    });
    
 
Route::middleware(['auth','user'])->group(function () {
    Route::resource('produits',ProduitController::class);
    Route::resource('clients',ClientController::class);
    //Route::resource('voitures',VoitureController::class);
    Route::resource('interventions',InterventionController::class);
});
