<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Diagnostic;

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
    public function create()
    {
        return view('diagnostics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'description' => 'required',
        ]);

        Diagnostic::create($request->all());

        return redirect()->route('diagnostics.index')
            ->with('success', 'diagnostic ajouté avec succés.');
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
    public function edit($id)
    {
        $diagnostic = Diagnostic::find($id);
        return view('diagnostics.edit', compact('diagnostic'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'description' => 'required',
        ]);
        $diagnostic= Diagnostic::find($id);
        $diagnostic->update($request->all());

        return redirect()->route('diagnostics.index')
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
