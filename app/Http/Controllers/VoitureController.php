<?php

namespace App\Http\Controllers;
use App\Models\Voiture;

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
        return view('voiture.index',compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('voiture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= request()->validate([
            'matricule'=>'required',
            'marque'=>'required',
            'model'=>'required',
            'annee'=>'required',
            'carburant'=>'required',
            'puissance'=>'required'
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
        //
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
        return view('voiture.edit',compact('voiture'));
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
            'puissance'=>'required'
          ]);
         $voiture->update($data);
         return redirect ('/voitures');
    }

    /**
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
