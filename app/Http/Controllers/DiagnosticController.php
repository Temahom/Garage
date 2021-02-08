<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Models\Intervention;

class DiagnosticController extends Controller
{
    public function index() 
    {
        $diagnostics = Diagnostic::all();

        return view('diagnostics.index',compact('diagnostics'));
    }

    public function create(Voiture $voiture, Intervention $intervention)
    {
        return view('diagnostics.create', compact('voiture', 'intervention'));
    }

    public function store(Request $request, Voiture $voiture, Intervention $intervention)
    {
            $request->validate([
                'plusdechamps.*.title' => 'required',
                'plusdechamps.*.description' => 'required'
            ]);
            $diagnostic = new Diagnostic();
            $diagnostic->title = $request->input('plusdechamps.*.title');
            $diagnostic->description = $request->input('plusdechamps.*.description');
            $diagnostic->save();
            
            
            return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id] );
     
            foreach ($request->plusdechamps as $key => $value) {
                Diagnostic::create($value);
        }
    }

    public function show(Diagnostic $diagnostic)
    {
        return view('diagnostics.show',compact('diagnostic'));
    }

    public function edit(Voiture $voiture, Intervention $intervention, Diagnostic $diagnostic)
    {
        return view('diagnostics.edit', compact('voiture', 'intervention', 'diagnostic'));
    }

    public function update(Request $request, Voiture $voiture, Intervention $intervention, Diagnostic $diagnostic)
    {
         $request->validate([
        'title' => 'required',
        'description' => 'required',
        ]);

         $diagnostic->update($request->all());

        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id] )
            ->with('success', 'Diagnostic ajouté avec succés');
    }

    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();

        return redirect()->route('diagnostics.index')
        ->with('success','diagnostic Supprimé !!');
    }
}
