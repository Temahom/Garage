<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devi;
use App\Models\Voiture;
use App\Models\Intervention;

class DeviController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devi=Devi::all();

        return view('devis.index',['devi'=>$devi]);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Voiture $voiture, Intervention $intervention)
    {
        return view('devis.create', compact('voiture', 'intervention'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture, Intervention $intervention)
    {
        $devi = new Devi();
        $devi->cout = $request->input('cout');
        $devi->save();
        $intervention->devis_id = $devi->id;
        $intervention->update();
        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id])->with('fait','Devis créer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devi=Devi::findOrFail($id);

        return view('devis.show',['devi'=>$devi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture, Intervention $intervention, Devi $devi)
    {
        return view('devis.edit', compact('voiture', 'intervention', 'devi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture, Intervention $intervention, Devi $devi)
    {
        $devi->update($request->all());
        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id])->with('modifier','Devis Modifier avec succées');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devi=Devi::findOrFail($id);
        $devi->delete();
        return redirect('/devis')->with('Supprimer','Devis Supprimer avec succées');
    }
}
