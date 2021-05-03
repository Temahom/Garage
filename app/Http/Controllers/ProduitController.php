<?php

namespace App\Http\Controllers;

use App\Models\Produit;

use App\Models\Approvisionnement;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
   /*    public function index()
    {
        $produits = Produit::latest()->paginate(15);

        return view('produits.index', compact('produits'))
            ->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function search()
    {
        $search_text = $_GET['query'];
        $produits = Produit::where('libelle','LIKE', '%'.$search_text.'%')->get();
           
        return view('produits.index', compact('produits'))
            ->with('i', (request()->input('page', 1) - 1) * 15);  
    }
       */
       public function index(Request $request, Approvisionnement $approvisionnement)  //Request $request
      {    
          
        $approvisionnement = Approvisionnement::all();
         $produits = Produit::where('qte','>',0)->get();
  
        return view('produits.index', compact('produits','approvisionnement'));
             
        }      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Produit::class);
        return view('produits.create');
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creer()
    {
        
        return view('produits.creer');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request->produit1)&& isset($request->prix)){
            $prod=new Produit();
            $prod->categorie=$request->categorie1;
            $prod->prix1=$request->prix;
            $prod->produit=$request->produit1;
            $prod->qte=$request->qte;
            $prod->save();
        }else{
            $request->validate([
                'categorie' => 'required',
                'produit' => 'required',
                'prix1' => 'required',
                'qte' => 'required'
            ]);
    
            $prod=new Produit();
            $prod->categorie=$request->categorie;
            $prod->prix1=$request->prix1;
            $prod->produit=$request->produit;
            $prod->qte=$request->qte;
            $prod->save();
        }
        

        return redirect()->route('produits.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idcl
     * @return \Illuminate\Http\Response
     */
   
        public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Produit $produit)
    {
        $this->authorize('update', $produit);
        $request->validate([
            'categorie' => 'required',
            'produit' => 'required',
            'prix1' => 'required',
           'qte' => 'required'
        ]);
        $produit->update($request->all());

        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        // $this->authorize('delete', $produit);
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé avec succès');
    }
    
    //////////////
   
    
  /*  public function commanderproduit()
    {
        $produits = Produit::latest()->paginate(15); 
        return view('produits.commanderproduit', compact('produit'));
            ->with('i', (request()->input('page', 1) - 1) * 15);
  
    } */

}


