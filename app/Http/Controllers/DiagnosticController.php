<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Models\Listedefaut;
use App\Models\Intervention;
use App\Models\Defaut;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $diagnostic = Diagnostic::all();
        return view('diagnostics.index',compact('diagnostic'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Voiture $voiture, Intervention $intervention)
    {
        $this->authorize('create', Diagnostic::class);
        $listedefauts = Listedefaut::all();
        $diagnostic = Diagnostic::find($intervention->diagnostic_id);
         //dd($intervention->diagnostic()->first()->defauts()->get());
        if($intervention->diagnostic()->first())
        {
            $defauts = $intervention->diagnostic()->first()->defauts()->get();
            return view('diagnostics.create', compact('voiture', 'intervention', 'diagnostic', 'defauts', 'listedefauts'));
        }
       
        return view('diagnostics.create', compact('voiture', 'intervention', 'diagnostic', 'listedefauts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture, Intervention $intervention)
    {
        $diagnostic = new Diagnostic();
        $diagnostic->constat = $request->input('constat');
        $diagnostic->save();
        $intervention->diagnostic_id = $diagnostic->id;
        $intervention->update();
                 
        
        foreach ($request->plusdechamps as $key => $value) {
            $defaut = new Defaut();
            $defaut->diagnostic_id = $diagnostic->id;
            $defaut->code =  $value['code'];
            $defaut->localisation =  $value['localisation'];
            $defaut->description =  $value['description'];
            $defaut->etat =  $value['etat'];
            $defaut->save();
        }

       

        
        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id] );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostic $diagnostic)
    {
        $voitureID =$diagnostic->intervention()->first()->voiture_id;
        $voiture = Voiture::find($voitureID);

        //dd($diagnostic->intervention()->first()->defauts()->get());
        //$voiture=intervention()->first()->voiture()->first();
        return view('diagnostics.show',compact('diagnostic','voiture'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture, Intervention $intervention, Diagnostic $diagnostic, Defaut $defaut, Listedefaut $listedefaut)
    {
        $defauts = Defaut::all();
        $listedefauts = Listedefaut::all();
        return view('diagnostics.edit', compact('voiture', 'intervention', 'diagnostic','defauts','listedefauts'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture, Intervention $intervention, Diagnostic $diagnostic)
    {
        $this->authorize('update', $diagnostic);
        $diagnostic->constat = $request->input('constat');
        $diagnostic->update();

        $defauts = $intervention->diagnostic()->first()->defauts()->get();
        foreach($defauts as $defaut)
        {
            $defaut->delete();
        }
                
        foreach ($request->plusdechamps as $key => $value) {
            $defaut = new Defaut();
            $defaut->diagnostic_id = $diagnostic->id;
            $defaut->code =  $value['code'];
            $defaut->localisation =  $value['localisation'];
            $defaut->description =  $value['description'];
            $defaut->etat =  $value['etat'];
            $defaut->save();
        }

        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id] )
            ->with('success', 'Diagnostic ajouté avec succés');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        $this->authorize('delete', $diagnostic);
        $diagnostic->delete();

        return redirect()->route('diagnostics.index')
        ->with('success','diagnostic Supprimé !!');
    }
}
