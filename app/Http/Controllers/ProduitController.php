<?php

namespace App\Http\Controllers;

use App\Models\Produit;
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
       public function index(Request $request)  //Request $request
      {         
         $produits = Produit::where([
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('produit', 'LIKE' , '%' . $term . '%')->get();
                }
               }] 
            ])
                ->orderBy("id","asc")
                ->paginate(15);
  
        return view('produits.index', compact('produits'))
            ->with('i', (request()->input('page', 1) - 1) * 15); 
             
        }      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $request->validate([
            'categorie' => 'required',
            'produit' => 'required',
            'prix1' => 'required',
            'qte' => 'required'
        ]);

        Produit::create($request->all());

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
     * @param  int  $id
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


