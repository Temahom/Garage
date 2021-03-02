<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devi;
use App\Models\Voiture;
use App\Models\Devi_produit;
use App\Models\Intervention;
use App\Models\listeproduit;

class DeviController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devi=Devi::all();

        return view('devis.index',['devi'=>$devi]);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Voiture $voiture, Intervention $intervention)
    {
        $this->authorize('create', Devi::class);
        $devi = Devi::find($intervention->devis_id);
        if($intervention->devi()->first())
        {
            $produits = $intervention->devi()->first()->produits()->get();
            return view('devis.create', compact('voiture', 'intervention', 'devi', 'produits'));
        }
        return view('devis.create', compact('voiture', 'intervention'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture, Intervention $intervention)
    { 
        $devi = new Devi();

        $devi->cout = $request->input('cout');
        $devi->date_expiration = $request->input('date_expiration');
        $devi->etat= 1;
        $devi->save();

        $intervention->devis_id = $devi->id;
        $intervention->statut = 3;
        $intervention->update();
        
        foreach ($request->produits as $key => $produit) {
            $devi_produit = new Devi_produit();
            $devi_produit->devi_id = $devi->id;
            $devi_produit->produit_id = $produit['id'];
            $devi_produit->quantite = $produit['quantite'];
            $devi_produit->save();
        }
        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id])->with('fait','Devis créer avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devi=Devi::findOrFail($id);

        return view('devis.show',['devi'=>$devi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture, Intervention $intervention, Devi $devi)
    {
        return view('devis.edit', compact('voiture', 'intervention', 'devi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voiture $voiture, Intervention $intervention, Devi $devi)
    {
        $this->authorize('update', $devi);
        $devi->update($request->all());
        return redirect()->route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id])->with('modifier','Devis Modifier avec succées');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devi $devi)
    {
        $this->authorize('delete', $devi );
        $devi->delete();
        return redirect('/devis')->with('Supprimer','Devis Supprimer avec succées');
    }

    //mis a jour du statut d'un devis suivant un etat actif vers une expiration
    public function etat(Request $request, Devi $devi)
    {
        $data = Devi::where('date_expiration','<',now())->get();
       
           foreach($data as $devi)
           {
               if($devi->etat !=2 && $devi->etat!=3){
                $devi->etat = 3;
                $devi->update();
                return $devi;
                }
           }    
      
        
        // return back();
    }
}
