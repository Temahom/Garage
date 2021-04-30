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
        $commandes= Commande::where('etat',1)->get();
        //dd($commandes);
        //dd($commandes->produits;
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Commande $commandes)
    {
        $produits=Produit::all();
        return view('commandes.create', compact('commandes', 'produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->plusdechamps as $key => $value) {
            $commande = new Commande();
            $commande->produit_id = $request->input('produit_id');
            $commande->categorie =  $value['catProduit'];
            $commande->produit =  $value['produit_id'];
            $commande->qteProduit =  $value['qteProduit'];
            $commande->cout =  $value['cout'];
            $commande->date_expiration = $request->input('date_expiration');
            $commande->etat= 1;
            $commande->save();
        }

        $produit= $commande->produit()->first()->id;
        return redirect()->route('produits.show', ['produit' => $produit])
        ->with('Commande Enrégistrée avec succes');   

    /*    $request->validate([
            'id_produit' => 'required',
            'qteProduit' => 'required',
        ]);

        Commande::create($request->all());

        return redirect()->route('commandes.create')
            ->with('success', 'Produit ajouté avec succès');  */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commandes
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
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
    public function update(Request $request, Commande $commande, Produit $produit)
    {
      //  $this->authorize('update', $commande);        
        
        foreach ($request->plusdechamps as $key => $value) {
            $commande = new Approvisionnement();
            $commande->fournisseur_id = $request->input('produit_id');
            $commande->categorie =  $value['catProduit'];
            $commande->produit =  $value['produit_id'];
            $commande->qteProduit =  $value['qteProduit'];
            $commande->cout =  $value['cout'];
            $commande->date_expiration = $request->input('date_expiration');
            $commande->save();
        }

        $produit = $commande->produit()->first()->id;
        return redirect()->route('produits.show', ['produit' => $produit])
            ->with('success', 'commande modifié avec succès !!!');
    }
   /* public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'catProduit' => 'required',
            'nomProduit' => 'required',
            'qteProduit' => 'required',
        ]);
        $commande->update($request->all());

        return redirect()->route('commandes.index')
            ->with('success', 'Produit modifié avec succès');
    } */
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
            }else{
                $produit->qte=$produit->qte-$produit->pivot->quantite;
                 $produit->save();

            }
            
        }
        $commande->valide_par=auth()->user()->id;
        $commande->etat=2;
        $commande->save();
        return redirect()->back()->with('valider','Votre commande a été valider avecc succées');
    }
}
