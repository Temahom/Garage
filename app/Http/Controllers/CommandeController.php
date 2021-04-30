<?php
namespace App\Http\Controllers;

use App\Models\Devi;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Intervention;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes= Commande::latest()->get();
        //dd($commandes);
        //dd($commandes->produits;
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function create(Commande $commandes)
    {
        $produits=Produit::all();
        return view('commandes.create', compact('commandes', 'produits'));
    }        */
    public function create(Produit  $produit , Commande $commande)
    {
     
    } 
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produit $produit)
    { 

     
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commandes
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        $devi=Devi::find($commande->devi_id);
        $produits=$devi->produits()->get();
        return view('commandes.show', compact('commande','produits'));
        //dd($produits);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commandes
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        return view('commandes.edit', compact('commande'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commandes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        
    }
    public function passer_commande($id)
    {
      
        $intervention=Intervention::find($id);
        $commande=new Commande();
        if ($intervention->devis_id) {
            $commande->passer_par=auth()->user()->id;
            $commande->devi_id=$intervention->devis_id;
            $commande->etat=1;
            $commande->save();
            return redirect()->back()->with('commande_reusie','Votre commande a été passer avec succés');
         
        }else{
            return redirect()->back()->with('commande_error','Vous ne pouvez pas passer une commande vide');

        }
    }
    public function valider_commande($id)
    {
        $commande=Commande::find($id);
        $devi=Devi::find($commande->devi_id);
        $produits=$devi->produits()->get();
        /**
         * Decrementer sr les produits de 
         */
        foreach ($produits as $produit) {
            if ($produit->qte < $produit->pivot->quantite) {
                return redirect()->back()->with('valide_error','Vous ne pouvez pas valider la commande car un ou plusieurs produits sont en rupture de stock');
            }
            
        }
        foreach ($produits as $produit) {
            $produit->qte=$produit->qte-$produit->pivot->quantite;
            $produit->save();
        }
        $commande->valide_par=auth()->user()->id;
        $commande->etat=2;
        $commande->save();
        return redirect()->back()->with('valider','Votre commande a été valider avecc succées');
    }
}
