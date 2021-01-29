<?php

namespace App\Http\Controllers;

use App\Models\Reparation;
use App\Models\Voiture;
use App\Models\Intervention;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $reparation=Reparation::all();
       return view('reparations.index',compact('reparation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Voiture $voiture, Intervention $intervention)
    {
        return view('reparations.create', compact('voiture', 'intervention'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture, Intervention $intervention)
    {
        $request->validate([
            'element_3' => 'required'
           
        ]);
        $reparation = new Reparation();
        $reparation->element_3 = $request->input('element_3');
        $reparation->save();

        $intervention->reparation_id = $reparation->id;
        $intervention->update();

        return redirect( route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) )
            ->with('success', 'Ajout Réussi');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function show(Reparation $reparation)
    {
        //
        return view('reparations.show', compact('reparation'));
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture, Intervention $intervention, Reparation $reparation)
    {
        return view('reparations.edit', compact('voiture', 'intervention', 'reparation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture, Intervention $intervention, Reparation $reparation)
    {
        $request->validate([  
            'element_3' => 'required'
        ]);
        $reparation->update($request->all());

        return redirect( route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) )
            ->with('success', 'Modification Réussie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reparation $reparation)
    {
        //
        $reparation->delete();

        return redirect('/reparations')
            ->with('success', 'Suppression Réussie');
    }
}
