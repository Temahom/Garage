<?php
namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;
use DB;

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

    public function indexBis()
    {
        $produits = Produit::where('etat','=',1)->get();
        return view('approvisionnements.indexBis', compact('produits'));
    }

    public function demande()
    {
        $produits = Produit::where('qte','<=','quantite_alert')->
                             where('etat','=',0)->get();
        return view('approvisionnements.demande', compact('produits'));
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
            $produit = Produit::find($value['produit_id']);
            $quantiteStock = 0;
            foreach ($produit->approvisionnements as $appro)
            {
                $quantiteStock += $appro->pivot->quantite;
                $quantiteStock += $produit->qte;
                DB::table('produits')->where('id',$produit->id)->update(['qte'=>$quantiteStock]);
            }
             
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
      * Methode permettant d'envoyer
      *une requete d'approvisionnement
      *en mettant à jour l'etat de la table produit à 1
      *qui signifie que le produit doit etre commander
      */

    public function storeBis(Request $request)
    {
        $tabDemandeAppro = $request['produit'];
        foreach($tabDemandeAppro as $produit_id)
        {
            DB::table('produits')->where('id',$produit_id)->update(['etat'=>1]);
        }
        return redirect('/demande-appro-liste');
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
        $fournisseurs = Fournisseur::all();
        $produits= Produit::all();
        $approvisionnements = Approvisionnement::all();
        return view('approvisionnements.edit', compact('approvisionnement', 'produits', 'produit', 'fournisseurs'));
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
        $table_keys_product = [];
        $table_keys_pivot = [];

        /**
         * Recuperation des cles de table pivot
         * de l'approvisionnement courant
         */
       foreach($approvisionnement->produits as $product)
        {
            $table_keys_pivot[] = $product->id;
        }
        
        $table_keys_pivot = $table_keys_pivot;
        // dd($table_keys_pivot);
        /**
         * fin
         */

         /**
         * Recuperation des cles du formulaire
         * de l'approvisionnement courant a modifier
         */
        foreach ($request->plusdechamps as $key => $value)
        {
            // dd($value['produit_id']);
            $table_keys_product[] = $value['produit_id'];
        }
        $table_keys_product = $table_keys_product ;
        // dd($table_keys_product);
        /**
         * fin
         */

        /**
         * MaJ ou creation de produit
         * suivant l'existence de la id
         * du produit dans la table pivot
         */
        foreach ($request->plusdechamps as $key => $value)
        {
            $approvisionnement->produits()->detach($value['produit_id']);

            $approvisionnement->produits()->attach([$value['produit_id']=>['quantite'=>$value['qteAppro'],'prix_achat'=>$value['prixAchat'] ]]);   
            DB::table('produits')->where('id',$value['produit_id'])->update(['qte'=> $value['qteAppro'] + Produit::find($value['produit_id'])->qte]);   
            
        }    
        /**
         * fin
         */
        $fournisseur = $approvisionnement->fournisseur()->first()->id;
        return redirect()->route('approvisionnements.show', ['approvisionnement' => $approvisionnement]);
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
        $approvisionnement->produits()->detach($approvisionnement->id);
        
        $fournisseur = $approvisionnement->fournisseur()->first()->id;
        return redirect()->route('fournisseurs.show', ['fournisseur' => $fournisseur])
            ->with('success', 'Approvisionnement supprimé avec succès !!!');
    }
}
