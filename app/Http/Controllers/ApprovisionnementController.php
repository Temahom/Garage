<?php
namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Fournisseur;
use App\Models\Produit;
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
        $approvisionnements = Approvisionnement::all();

        return view('approvisionnements.index', compact('approvisionnements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fournisseur $fournisseur, Approvisionnement $approvisionnement, Produit $produit)
    {
       //$this->authorize('create', Approvisionnement::class);
       $fournisseurs= Fournisseur::all();
       $produits= Produit::all();
       return view('approvisionnements.create',compact('fournisseurs','fournisseur', 'approvisionnement', 'produits', 'produit'));
    
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fournisseur $fournisseur, Approvisionnement $approvisionnement)
    { 
        request()->validate([
            'fournisseur_id' => 'required',
            'date_approvisionnement' => 'required',
        ]);
        $approvisionnement->fournisseur_id = $request->input('fournisseur_id'); 
        $approvisionnement->date_approvisionnement =  $request->input('date_approvisionnement');
        $approvisionnement->save();
        foreach ($request->plusdechamps as $key => $value) {
            $approvisionnement->produits()->attach([$value['produit_id']=>['quantite'=>$value['qteAppro'],'prix_achat'=>$value['prixAchat'] ]]);
        }
        if(!isset($fournisseur->id)){
            return redirect()->route('approvisionnements.show', ['approvisionnement'=>$approvisionnement])
            ->with('success','Approvisionnement Enrégistré');  
        }
        else
            return redirect()->route('fournisseurs.approvisionnements.show', ['fournisseur' => $fournisseur, 'approvisionnement'=>$approvisionnement])
            ->with('success','Approvisionnement Enrégistré');   
    }
   
           
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show( Fournisseur $fournisseur, Approvisionnement $approvisionnement)
    {
        return view('approvisionnements.show', compact('approvisionnement', 'fournisseur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit, Approvisionnement $approvisionnement )
    {
        //dd($produit->id-1);
        dd($approvisionnement->produits[$produit->id-1]);
        $produits= Produit::all();
        $approvisionnements = Approvisionnement::all();
        return view('approvisionnements.edit', compact('approvisionnement', 'produits', 'produit'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit, Approvisionnement $approvisionnement)
    {
        $request->validate([
            'fournisseur_id' => 'required',
            'produit_id' => 'required',
            'qteAppro' => 'required',
            'prixAchat' => 'required',
            ]);
        $approvisionnement->update($request->all());


        $fournisseur = $approvisionnement->fournisseur()->first()->id;
        return redirect()->route('approvisionnements.show', ['approvisionnement' => $produit])
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
