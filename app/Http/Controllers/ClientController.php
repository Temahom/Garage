<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $clients = Client::where([
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
  
        return view('clients.index', compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 15); 
             
    }

    /**f
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Client::class);
        return view('clients.create');
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
        'nom' => 'required',
        'prenom' => 'required',
        'telephone' => 'required|unique:clients',
        'email' => 'unique:clients',
        ]);
           
        $client = Client::create($request->all());
        $voiture =  $client->voitures()->get();
        return redirect()->route('clients.show', ['client' => $client])
        ->with('success','Client Enrégistré');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $voitures = $client->voitures()->paginate(3);
        return view('clients.show',compact('client','voitures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Client $client)
    {   
        $this->authorize('update', $client);
         $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'telephone' => 'required',
        ]);

         $client->update($request->all());

         return redirect()->route('clients.index')
        ->with('success','Client Modifié !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();

        return redirect()->route('clients.index')
        ->with('success','Client Supprimé !!');
    }
}
