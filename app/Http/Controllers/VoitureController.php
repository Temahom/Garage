<?php

namespace App\Http\Controllers;
use App\Models\Voiture;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
    public function create(Client $client, Voiture $voiture)
    {
        
      $this->authorize('create', Voiture::class);
      $clients= Client::all();
      return view('voitures.create',compact('clients','client', 'voiture'));
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
           $voiture = Voiture::create($data);
           return redirect()->route('voitures.show', ['voiture' => $voiture]);
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
        
        $clients = Client::all();
        return view('voitures.edit',compact('voiture','clients'));
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
            'matricule'=>'required|distinct',
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
