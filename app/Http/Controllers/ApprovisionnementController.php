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
    public function store(Request $request)
    {

            $approvisionnement = new Approvisionnement();

            foreach ($request->plusdechamps as $key => $value) {
               
                $approvisionnement->fournisseur_id = $request->input('fournisseur_id');    
                           
                $approvisionnement->produit_id =  $value['produit_id'];
                $approvisionnement->qteAppro =  $value['qteAppro'];
                $approvisionnement->prixAchat =  $value['prixAchat'];
                // dd(intval($value['produit_id']));
                $approvisionnement->save();
                $approvisionnement->produits()->sync([$approvisionnement->produit_id=>['quantite'=>$value['qteAppro']]]);
            }

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
    public function edit(Approvisionnement $approvisionnement, Produit $produit)
    {
        $produits= Produit::all();
        $approvisionnements = Approvisionnement::all();

        return view('approvisionnements.edit', compact('approvisionnement', 'produits'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvisionnement $approvisionnement, Fournisseur $fournisseur)
    {
        $request->validate([
            'fournisseur_id' => 'required',
            'produit_id' => 'required',
            'qteAppro' => 'required',
            'prixAchat' => 'required',
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
