<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Devi;
use App\Models\Facture;
use App\Models\Diagnostic;
use App\Models\Intervention;
use Illuminate\Http\Request;
use PDF;
class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function generer_facture($id)
    {
    
        $intervention=Intervention::find($id);
        
        //$intervention=$diagnostic->intervention()->first();
        $facture= new Facture();
        $facture->etat=1;
        $facture->numero=time();
        $facture->save();
        $intervention->facture_id=$facture->id;
        $intervention->save();
        return redirect()->back()->with("creer_facture","Facture générer avec succes");


    }
     public function facture_payer($id)
    {
        $facture=Facture::find($id);
        $facture->etat=2;
        $facture->save();
        return redirect()->back()->with("payer_facture","Facture payé avec succes");
    }
    public function facture_pdf($id)
    {
        $facture=Facture::find($id);
        $intervention=$facture->intervention->first();
        $prix_total=0;
        $les_devis=0;
        $diagnostic=Diagnostic::find($intervention->diagnostic_id);
        $prix_total=$diagnostic->coût;
        $client=$intervention->voiture->client->first();
        //dd($client);
        $prix_total=$diagnostic->coût;
        if (! $intervention->devis_id) {
            //return View('Pdf.facture',compact('prix_total','facture','client'));
             $pdf = PDF::loadView('Pdf.facture',compact('prix_total','facture','client'));    
             return $pdf->stream('facture.pdf');
        } else {
            $devi = Devi::find($intervention->devis_id);
            $les_devis=$devi->produits()->get();
                $pdf=PDF::load('Pdf.facture',compact('prix_total','facture','client','les_devis','devi'));
                //pdf = PDF::loadView('Pdf.facture',compact('prix_total','facture'));    
                return $pdf->stream('facture.pdf');
        }
        
           
         
        
        
    }
    
}
