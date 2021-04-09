<?php

namespace App\Http\Controllers;
use App\Models\Fournisseur;
use App\Models\Approvisionnement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        
        $fournisseurs = Fournisseur::latest()->paginate(20);

        return view('fournisseurs.index', compact('fournisseurs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
   
    /*    $fournisseurs = Fournisseur::where([
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('nom', 'LIKE' , '%' . $term . '%')->get();
                    $query->orWhere('prenom', 'LIKE' , '%' . $term . '%')->get();
                    $query->orWhere('genre', 'LIKE' , '%' . $term . '%')->get();
                    $query->orWhere('entreprise', 'LIKE' , '%' . $term . '%')->get();
                    $query->orWhere('email', 'LIKE' , '%' . $term . '%')->get();
                }
               }] 
            ])
                ->orderBy("id","asc")
                ->paginate(15);
  
        return view('fournisseurs.index', compact('fournisseurs'))
            ->with('i', (request()->input('page', 1) - 1) * 15); 
       
            */ }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        //$this->authorize('create', Fournisseur::class);
        return view('fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {   //ingcapital.sn()
            $request->validate([
                'nom' => 'required',
                'prenom' => 'required',
                'genre' => 'required',
                'entreprise' => 'max:200',
                'telephone' => 'required|unique:fournisseurs',
                'email' => 'unique:fournisseurs'
            ]);
    
           // Fournisseur::create($request->all());
    
          /*  $data = request()->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'entreprise' => 'max:200',
            'telephone' => 'required|unique:fournisseurs',
            'email' => 'unique:fournisseurs'
            ]); */
            $fournisseur = new Fournisseur();
            $fournisseur->nom = $request->input('nom');
            $fournisseur->prenom = $request->input('prenom');
            $fournisseur->genre = $request->input('genre');
            $fournisseur->entreprise = $request->input('entreprise'); 
            $fournisseur->telephone = $request->input('telephone');
            $fournisseur->email = $request->input('email');  
           // $fournisseur->user_id= $user_id;
            $fournisseur->save();
            return redirect()->route('fournisseurs.show', ['fournisseur' => $fournisseur])
            ->with('success','Fournisseur Enrégistré');   
              }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur, Approvisionnement $approvisionnement)
    {
        $approvisionnements = $fournisseur->approvisionnements()->get();
        return view('fournisseurs.show',compact('fournisseur','approvisionnements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit',compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Fournisseur $fournisseur)
    {   
      //  $this->authorize('update', $fournisseur);
       $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'genre' => 'required',
        'entreprise' => 'max:200',
        'telephone' => ['required', Rule::unique('fournisseurs')->ignore($fournisseur->id)],
        'email' => [Rule::unique('fournisseurs')->ignore($fournisseur->id)]
        ]);

        $fournisseur->update($request->all());

         return redirect()->route('fournisseurs.index')
        ->with('success','Fournisseur Modifié !!');            
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $this->authorize('delete', $fournisseur);
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')
        ->with('success','Fournisseur Supprimé !!');
    }
}
