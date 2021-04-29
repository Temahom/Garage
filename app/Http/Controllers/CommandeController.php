<?php
namespace App\Http\Controllers;

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
        
        $commandes= Commande::all();
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
        $commande->passer_par=auth()->user()->id;
        $commande->devi_id=$intervention->devis_id;
        $commande->etat=1;
        $commande->save();
        return redirect()->back()->with('commande_reusie','Votre commande a été passer avec succés');
       // dd($intervention->devis_id);
    }
    public function valider_commande($id)
    {
        $intervention=Intervention::find($id);
        dd($intervention);
    }
}
