<?php
namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class ApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvisionnements = Approvisionnement::latest()->paginate(5);

        return view('approvisionnements.index', compact('approvisionnements'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fournisseur $fournisseur, Approvisionnement $approvisionnement)
    {
       //$this->authorize('create', Approvisionnement::class);
       $fournisseurs= Fournisseur::all();
       return view('approvisionnements.create',compact('fournisseurs','fournisseur', 'approvisionnement'));
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
            'nomProduit' => 'required',
            'qteTotale' => 'required',
            'prixTotal' => 'required',
            'fournisseur_id' => 'required'
        ]);

            $approvisionnement = new Approvisionnement;
            $approvisionnement->nomProduit = $request->input('nomProduit');
            $approvisionnement->qteTotale = $request->input('qteTotale');
            $approvisionnement->prixTotal = $request->input('prixTotal');
            $approvisionnement->fournisseur_id = $request->input('fournisseur_id');
            $approvisionnement->save();
            $fournisseur = $approvisionnement->fournisseur()->first()->id;
            return redirect()->route('fournisseurs.show', ['fournisseur' => $fournisseur])
            ->with('success','Approvisionnement Enrégistré');   
    }
           
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Approvisionnement $approvisionnement)
    {
        return view('approvisionnements.show', compact('approvisionnement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvisionnement $approvisionnement)
    {
        return view('approvisionnements.edit', compact('approvisionnement'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvisionnement $approvisionnement)
    {
        $request->validate([
            'fournisseur' => 'required',
            'nomProduit' => 'required',
            'qteTotale' => 'required',
            'prixTotal' => 'required'
        ]);
        $approvisionnement->update($request->all());
        $fournisseur = $approvisionnement->fournisseur()->first()->id;
        return redirect()->route('fournisseurs.show', ['fournisseur' => $fournisseur])
            ->with('success', 'Approvisionnemment modifié avec succès !!!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        $approvisionnement->delete();
        $fournisseur = $approvisionnement->fournisseur()->first()->id;
        return redirect()->route('fournisseurs.show', ['fournisseur' => $fournisseur])
            ->with('success', 'Approvisionnement supprimé avec succès !!!');
    }
}
