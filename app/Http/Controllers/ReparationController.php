<?php

namespace App\Http\Controllers;

use App\Models\Reparation;
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
    public function create()
    {
        //
        return view('reparations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'element_1' => 'required',
            'element_2' => 'required',
            'element_3' => 'required'
           
        ]);

        Reparation::create($request->all());

        return redirect('/reparations')
            ->with('success', 'Reparation created successfully.');
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
    public function edit($id)
    {
        $reparation=Reparation::find($id);

        return view('reparations.edit', compact('reparation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reparation $reparation)
    {
        $request->validate([
            'element_1' => 'required',
            'element_2' => 'required',
            'element_3' => 'required'
        ]);
        $reparation->update($request->all());

        return redirect('/reparations')
            ->with('success', 'Reparation updated successfully');
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
            ->with('success', 'Reparation deleted successfully');
    }
}
