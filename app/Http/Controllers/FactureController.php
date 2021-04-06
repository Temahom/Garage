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
    public function facture_diagnostic($id)
    {
    
        $diagnostic=Diagnostic::find($id);
        $intervention=$diagnostic->intervention()->first();
        $facture= new Facture();
        if($intervention->devis_id){
            $facture->devi_id=$intervention->devis_id;
        }else{
        $facture->devi_id=0;

        }
        $facture->etat=1;
        $facture->numero=time();
        $facture->diagnostic_id=$id;
        $facture->save();
        return redirect()->back();


    }
     public function facture_diagnostic_payer($id)
    {
        $facture=Facture::find($id);
        $facture->etat=2;
        $facture->save();
        return redirect()->back();
    }
    public function facture_pdf($id)
    {
        $facture=Facture::find($id);
        $prix_total=0;
        $les_devis=0;
        if (isset($facture->devi_id) &&  $facture->devi_id==0) {
            $diagnostic=Diagnostic::find($facture->diagnostic_id);
            $client=$diagnostic->intervention()->first()->voiture->client->get();
            $prix_total=$diagnostic->coût;
            return View('Pdf.facture',compact('prix_total','facture','client'));
            // $pdf = PDF::loadView('Pdf.facture',compact('prix_total','facture','client'));    
            // return $pdf->stream('facture.pdf');
        }else{
            $diagnostic=Diagnostic::find($facture->diagnostic_id);
            $prix_total=$diagnostic->coût;
            $devi = Devi::find($facture->devi_id);
            $les_devis=$devi->produits()->get();
            $client=$diagnostic->intervention()->first()->voiture->client->get();
            //dd($client);
            return View('Pdf.facture',compact('prix_total','facture','client','les_devis','devi'));
            //$pdf = PDF::loadView('Pdf.facture',compact('prix_total','facture'));    
            return $pdf->stream('facture.pdf');
                
        }
       // dd($les_devis);
        
        
    }
    
}
