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
       $approvisionnement = Approvisionnement::find();
       if($fournisseur->approvisionnement()->first())
       {
           $i = 0;
           $item_approvisionnements = [];
           $approvisionnement_produits = $fournisseur->approvisionnement()->first()->approvisionnement_produits()->get();
           foreach($approvisionnement_produits as $approvisionnement_produit)
           {
               $produit = Produit::find($approvisionnement_produits->produit_id);
               $item_approvisionnements[$i]['approvisionnement_produit'] = $approvisionnement_produit;
               $item_approvisionnements[$i]['produit'] = $produit;
               $i++;
           }
           return view('approvisionnements.create', compact('fournisseur', 'approvisionnement', 'item_approvisionnements'));
       }
       return view('approvisionnements.create', compact('fournisseur'));
    
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $approvisionnement = new Approvisionnement;
            $approvisionnement->fournisseur_id = $request->input('fournisseur_id');
            $approvisionnement->save();

            foreach ($request->plusdechamps as $key => $value) {
                $approvisionnement = new Approvisionnement();
                $approvisionnement->nomProduit =  $value['nomProduit'];
                $approvisionnement->qteTotale =  $value['qteTotale'];
                $approvisionnement->prixTotal =  $value['prixTotal'];
                $approvisionnement->save();
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
        $this->authorize('update', $approvisionnement);
        $approvisionnement->fournisseur_id = $request->input('fournisseur_id');
        $approvisionnement->update();

        foreach ($request->plusdechamps as $key => $value) {
            $approvisionnement = new Approvisionnement();
            $approvisionnement->nomProduit =  $value['nomProduit'];
            $approvisionnement->qteTotale =  $value['qteTotale'];
            $approvisionnement->prixTotal =  $value['prixTotal'];
            $approvisionnement->save();
        }

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
