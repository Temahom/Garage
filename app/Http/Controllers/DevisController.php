<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\Voiture;
use App\Models\Intervention;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devis=Devis::all();

        return view('devis.index',['devis'=>$devis]);
      
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
        $devis = new Devis();
        $devis->cout = $request->input('cout');
        $devis->save();
        $intervention->devis_id = $devis->id;
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
        $devi=Devis::findOrFail($id);

        return view('devis.show',['devi'=>$devi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devi=Devis::findOrFail($id);
        return view('devis.edit', ['devi'=>$devi]);

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
        $devi=Devis::findOrFail($id);
        $devi->update($request->all());
        return redirect('/devis')->with('modifier','Devis Modifier avec succées');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $devi=Devis::findOrFail($id);
        $devi->delete();
        return redirect('/devis')->with('Supprimer','Devis Supprimer avec succées');
    }
}
