<?php

namespace App\Http\Controllers;
use App\Models\Voiture;
use App\Models\Client;

use Illuminate\Http\Request;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voitures= Voiture::orderBy('created_at','DESC')->paginate(15);
        return view('voitures.index',compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clients= Client::all();
      return view('voitures.create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);

        $data= request()->validate([
            'matricule'=>'required',
            'marque'=>'required',
            'model'=>'required',
            'annee'=>'required',
            'carburant'=>'required',
            'puissance'=>'required',
            'client_id'=>'required'
          ]);
          Voiture::create($data);
          return redirect('/voitures');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voiture=Voiture::find($id);
        $interventions = $voiture->interventions;
        return view('voitures.show',compact('voiture', 'interventions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture)
    {
        //
        $client_default= $voiture->client()->first();
        $clients= Client::where('id','!=',$client_default->id)->get();
        return view('voitures.edit',compact('voiture','clients','client_default'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture)
    {
        $data= request()->validate([
            'matricule'=>'required',
            'marque'=>'required',
            'model'=>'required',
            'annee'=>'required',
            'carburant'=>'required',
            'puissance'=>'required',
            'client_id'=>'required'
          ]);
         $voiture->update($data);
         return redirect ('/voitures');
    }

    /**
     * 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voiture $voiture)
    {
        $voiture->delete();
        return redirect('/voitures');
    }
}
