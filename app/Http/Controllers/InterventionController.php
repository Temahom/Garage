<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Voiture;
use App\Models\Diagnostic;
use App\Models\Reparation;
use App\Models\Devis;
use Illuminate\Http\Request;

class InterventionController extends Controller
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
    public function create(Voiture $voiture)
    {
        return view('interventions.create', compact('voiture'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture)
    {
        $intervention = new Intervention();
        $intervention->voiture_id = $voiture->id;
        $intervention->type = $request->input('type');
        $intervention->debut = $request->input('debut');
        $intervention->fin = $request->input('fin');
        $intervention->save();
        return redirect('/voitures/'.$voiture->id.'/interventions/'.$intervention->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function show(Voiture $voiture, Intervention $intervention)
    {
        $data['voiture'] = $voiture;
        $data['intervention'] = $intervention;
        if($intervention->diagnostic_id)
        {
            $diagnostic = Diagnostic::find($intervention->diagnostic_id);
            $data['diagnostic'] = $diagnostic;
        }
        if($intervention->reparation_id)
        {
            $reparation = Reparation::find($intervention->reparation_id);
            $data['reparation'] = $reparation;
        }
        if($intervention->devis_id)
        {
            $devis = Devis::find($intervention->devis_id);
            $data['devis'] = $devis;
        }
        return view('interventions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function edit(Intervention $intervention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intervention $intervention)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervention $intervention)
    {
        //
    }
}
