<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use App\Models\Voiture;
use App\Models\Intervention;
use Illuminate\Http\Request;

class SummaryController extends Controller
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
    public function create(Voiture $voiture, Intervention $intervention)
    {
        return view('summaries.create', compact('voiture','intervention'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture, Intervention $intervention)
    {
         $data = request()->validate([
           'description' => 'required',
        ]);
      $summary = new Summary();
      $summary->resume = $request->input('description');
      $summary->save();
      $intervention->summary_id = $summary->id;
      $intervention->update();
      return redirect(route('voitures.interventions.show',['voiture'=>$voiture->id, 'intervention'=>$intervention->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function show(Summary $summary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $summary = Summary::find($id);
        $intervention = Intervention::where('summary_id', '=',$id )->first();
        $voiture = $intervention->voiture()->first();
        return view('summaries.edit', compact('intervention','voiture','summary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'description' => 'required',
         ]);
         $summary = Summary::find($id);
         $intervention = Intervention::where('summary_id', '=',$id )->first();
         $voiture = $intervention->voiture()->first();
        $summary->resume = $request->input('description');
        $summary->update();
       return redirect(route('voitures.interventions.show',['voiture'=>$voiture->id, 'intervention'=>$intervention->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Summary $summary)
    {
        //
    }
}
