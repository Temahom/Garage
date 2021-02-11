<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Models\Intervention;

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
        return view('diagnostics.create', compact('voiture', 'intervention'));
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
            'plusdechamps.*.title' => 'required',
            'plusdechamps.*.description' => 'required'
        ]);
        $diagnostic = new Diagnostic();
        $tab = $request->input('plusdechamps');

    
        foreach ($tab as $key => $value) {
            Diagnostic::create($value);
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
        return view('diagnostics.show',compact('diagnostic'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture, Intervention $intervention, Diagnostic $diagnostic)
    {
        return view('diagnostics.edit', compact('voiture', 'intervention', 'diagnostic'));
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
         $request->validate([
        'plusdechamps.*.title' => 'required',
        'plusdechamps.*.description' => 'required',
        ]);

         $diagnostic->update($request->all());

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
        $diagnostic->delete();

        return redirect()->route('diagnostics.index')
        ->with('success','diagnostic Supprimé !!');
    }
}
