<?php
namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Commande_Produit;
use App\Models\Produit;
use App\Models\listeproduit;
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
      //  $this->authorize('create', Commande::class);
      //   $commande = Commande::all();
        if($commande->first())
        {
            $i = 0;
            $item_commandes = [];
           // $commande_produits = $commande()->first()->commande_produits()->get();
            $commande_produits = $commande_produits()->get();
            foreach($commande_produits as $commande_produit)
            {
                $produit = Produit::find($commande_produit->produit_id);
                $item_commandes[$i]['commande_produit'] = $commande_produit;
                $item_commandes[$i]['produit'] = $produit;
                $i++;
            }
            return view('commandes.create', compact('commande', 'item_commandes'));  
        }
        return view('commandes.create', compact('produit', 'commande'));  
    
    } 
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produit $produit)
    { 
        $commande = new Commande();

       // $commande->qteProduit = $request->input('qteProduit');
       // $commande->date_expiration = $request->input('date_expiration');
        $commande->etat= 1;
        $commande->save();

        //$intervention->devis_id = $devi->id;
       // $intervention->statut = 3;
       // $intervention->update();
        //$devis_id = $devi->id;
        if ($request->produits) {
            foreach ($request->produits as $key => $produit) {
                $commande_produit = new Commande_produit();
                $commande_produit->commande_id = $commande->id;
                $commande_produit->produit_id = $produit['id'];
                $commande_produit->quantite = $produit['quantite'];
                $commande_produit->save();
            }
        }
       
        return redirect()->route('commandes.show',['commande' => $commande->id])->with('fait','Commande créée avec succés');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commandes
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
       // return view('commandes.show', compact('commande'));
       $commande=Commande::findOrFail($id);

       return view('commandes.show',['commande'=>$commande]);
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
     //   $this->authorize('update', $commande);
     //   $commande->cout = $request->input('cout');
       // $commande->date_expiration = $request->input('date_expiration');
        $commande->update();
        $commande_produits = $commande->commande_produits()->get();
        foreach($commande_produits as $commande_produit)
        {
            $commande_produit->delete();
        }
        if ($request->produits)
        {
            foreach ($request->produits as $key => $produit) {
                $commande_produit = new Commande_produit();
                $commande_produit->commande_id = $commande->id;
                $commande_produit->produit_id = $produit['id'];
                $commande_produit->quantite = $produit['quantite'];
                $commande_produit->save();
            }
        }
        
        return redirect()->route('commandes.show')->with('modifier','Commande modifiée avec succées');
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
}
