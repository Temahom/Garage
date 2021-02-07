<?php

namespace App\Http\Controllers;

use App\Models\Diagnosti;
use Illuminate\Http\Request;

class DiagnostiController extends Controller
{
    public function index() 
    {
        $diagnostics = Diagnosti::all();

        return view('diagnostics.index',compact('diagnostics'));
    }

    public function create()
    {
        return view('diagnostics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plusdechamps.*.title' => 'required',
            'plusdechamps.*.description' => 'required'
        ]);
     
        foreach ($request->plusdechamps as $key => $value) {
            Diagnosti::create($value);
        }
     
        return back()->with('Bien', 'Diagnostic ajouter avec succés');
    }

    public function show(Diagnosti $diagnostic)
    {
        $diagnostic = $diagnostic;
        return view('diagnostics.show',compact('diagnostic'));
    }

    public function edit(Diagnosti $diagnostic)
    {
        return view('diagnostics.edit', compact('diagnostic'));
    }

    public function update(Request $request,Diagnosti $diagnostic)
    {
         $request->validate([
        'title' => 'required',
        'description' => 'required',
        ]);

         $diagnostic->update($request->all());

         return redirect()->route('diagnostics.index')
        ->with('success','Diagnostic Modifié !!');
    }

    public function destroy(Diagnosti $diagnostic)
    {
        $diagnostic->delete();

        return redirect()->route('diagnostics.index')
        ->with('success','diagnostic Supprimé !!');
    }
}
