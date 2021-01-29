<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Diagnostic;
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
        $diagnostics = Diagnostic::all();
        //dd($diagnostics);

        return view('diagnostics.index',compact('diagnostics'));
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
            'date' => 'required',
            'description' => 'required',
        ]);
        $diagnostic = new Diagnostic();
        $diagnostic->date = $request->input('date');
        $diagnostic->description = $request->input('description');
        $diagnostic->save();
        $intervention->diagnostic_id = $diagnostic->id;
        $intervention->update();
        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostic $diagnostic)
    {
        return view('diagnostics.show', compact('diagnostic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnostic  $diagnostic
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
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture, Intervention $intervention, Diagnostic $diagnostic)
    {
        $request->validate([
            'date' => 'required',
            'description' => 'required',
        ]);
        $diagnostic->update($request->all());

        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id] )
            ->with('success', 'Diagnostic ajouté avec succés');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();

        return redirect()->route('diagnostics.index')
            ->with('success', 'Diagnostic supprimé avec succés');
    }
}
