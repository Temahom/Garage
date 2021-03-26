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
use App\Http\Controllers\MailSend;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\SignaturePadController;
//use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FullCalendarController;
 use App\Http\Controllers\TestController;

use Illuminate\Support\Facades\App;
use App\Models\Voiture;
use App\Models\Diagnostic;
use App\Models\Intervention;
use App\Models\Devi;
use App\Models\Produit;
     
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
Route::get('send-mail',[MailSend::class,'mailsend']);
Route::get('send-devis/{id}',[MailSend::class,'send_devis']);
Route::get('send-message',[SmsController::class,'sendMessage']);
 Route::get('facture', function () {
    $pdf = PDF::loadView('Pdf.facture');    
    return $pdf->stream('facture.pdf');
}); 
Route::get('Pdf/{id}', function ($id) {
   $devis_id=Intervention::find($id)->devis_id;
   $devi = Devi::find($devis_id);
   $pdevis=$devi->produits()->get();
   $devi_client=Intervention::find($id)->voiture->client()->first();

   //dd(Intervention::find($id)->voiture->client()->get());
  // $commandes= \App\Models\Commande::all();
   
    $pdf = PDF::loadView('Pdf.pdf',compact('pdevis','devi','devi_client'));    
    return $pdf->stream('Devis.pdf');
});
Route::get('diag-pdf/{id}',function($id){
    $diagnostic = Diagnostic::find($id);
    $voitureID=$diagnostic->intervention()->first()->voiture_id;
    $voiture = Voiture::find($voitureID);
    $pdf = PDF::loadView("Pdf.diagnostic",compact('diagnostic','voiture'));
    return $pdf->stream('Diagnostic.pdf');
});


Route::middleware('auth')->group(function () {
    
    Route::resource('produits',ProduitController::class);
    Route::resource('clients',ClientController::class);  
    Route::resource('clients.voitures', VoitureController::class);
    Route::resource('factures',FactureController::class);
    Route::resource('voitures',VoitureController::class);
    Route::resource('voitures.interventions',InterventionController::class);
    Route::resource('voitures.interventions.reparations',ReparationController::class);
    Route::resource('voitures.interventions.summaries',SummaryController::class);
    Route::resource('voitures.interventions.devis',DeviController::class);
/*     Route::resource('commandes', CommandeController::class);
 */    Route::resource('voitures.interventions.devis.commandes', CommandeController::class);
    Route::resource('actors', ActorController::class);
    Route::resource('voitures.interventions.diagnostics',DiagnosticController::class);
    Route::resource('diagnostics', DiagnosticController::class);
    
    Route::get('/interventions-list', [InterventionController::class, 'index']);
    Route::get('/devis-etat', [DeviController::class, 'etat']);

    Route::get('signaturepad', [SignaturePadController::class, 'index']);
    Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');
    
    
   Route::get('/produits.creer', [ProduitController::class, 'creer']);

    Route::get('/admin', function () {
        return view('admin.home');
    });
           //routes
         
    
   /* Route::get('/', function () {
        return view('google_map');
    }); */
 
        
     //fullcalender
    //Route::get('/calendars.index', [CalendarController::class, 'index']);
   
    /* Route::get('events', [EventController::class, 'index']);
    
    Route::get('/events', [EventController::class, 'index']); */
    // Route::get('/admin.index',[CalendarController::class, 'index']);
    /*Route::resource('fullcalendar',CalendarController::class);
    Route::get('/produits.creer', [CalendarController::class, 'index']); */
   // Route::post('fullcalendar/create','CalendarController@create');
  /*  Route::post('fullcalendar/update','FullCalendarController@update');
    Route::post('fullcalendar/delete','FullCalendarController@destroy'); */

});


Route::middleware(['auth','manager'])->group(function () {

});
    
 
Route::middleware(['auth','user'])->group(function () {
    
});

Route::get('fullcalendar', [FullCalendarController::class, 'index']);
Route::post('fullcalendarAjax', [FullCalendarController::class, 'ajax']);


Route::get('/google_map', function () {
    return view('google_map');
});

