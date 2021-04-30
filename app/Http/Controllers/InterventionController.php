<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Devi;
use App\Models\User;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Summary;
use App\Models\Voiture;
use App\Models\Commande;
use App\Models\Diagnostic;
use App\Models\Reparation;
use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $interventions = Intervention::where([
            [function ($query) use ($request){
                if (($term = $request->term)) {
                    $query->orWhere('statut', 'LIKE' , '%' . $term . '%')->get();
                    $query->orWhere('type', 'LIKE' , '%' . $term . '%')->get();
                    $query->orWhere('technicien', 'LIKE' , '%' . $term . '%')->get();
                    
                }
               }] 
            ])->orderBy("id","asc")->paginate(15);
            $user = Auth::id(); 
        $interventionAssignees = Intervention::where('technicien','=',$user)->get();
        
        $diagnostics = Intervention::where('diagnostic_id','!=',null)->paginate(15);
        $devis = Intervention::where('devis_id','!=',null)->paginate(15);
        $summaries = Intervention::where('summary_id','!=',null)->paginate(15);
        $factures = Intervention::where('facture_id','!=',null)->paginate(15);
        return view('interventions.index', compact('interventions','diagnostics','devis','summaries','factures'));
    }


    public function index_mois()
    {
        
        $interventions = Intervention::whereYear('created_at', Carbon::now()->year)
                                      ->whereMonth('created_at', Carbon::now()->month)->paginate(10);
        $diagnostics = Intervention::where('diagnostic_id','!=',null)->whereYear('created_at', Carbon::now()->year)
                                                                     ->whereMonth('created_at', Carbon::now()->month)
                                                                     ->paginate(10);
        $devis = Intervention::where('devis_id','!=',null)->whereYear('created_at', Carbon::now()->year)
                                                            ->whereMonth('created_at', Carbon::now()->month)
                                                            ->paginate(10);
        $summaries = Intervention::where('summary_id','!=',null)->whereYear('created_at', Carbon::now()->year)
                                                                ->whereMonth('created_at', Carbon::now()->month)
                                                                ->paginate(10);
        $factures = Intervention::where('facture_id','!=',null)->whereYear('created_at', Carbon::now()->year)
                                                                ->whereMonth('created_at', Carbon::now()->month)
                                                                ->paginate(10);
        // dd($factures);
        return view('interventions.index_mois', compact('interventions','diagnostics','devis','summaries','factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Voiture $voiture, Intervention $intervention)
    {
        $this->authorize('create', Intervention::class);
        $techniciens = User::where('role_id','=',3)->get();
        return view('interventions.create', compact('voiture', 'techniciens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Voiture $voiture, Commande $commande)
    {
        $request->validate([
            'type' => 'required',
            'debut' => 'required',
            'technicien' => 'required'
        ]);

        $user = Auth::id();
        $intervention = new Intervention();
        $intervention->voiture_id = $voiture->id;
        $intervention->type = $request->input('type');
        $intervention->debut = $request->input('debut');
        $intervention->fin = $request->input('fin');
        $intervention->user_id = $user;
        $intervention->technicien = $request->input('technicien');
        $intervention->statut = 1;
        $intervention->save();
        $techniciens = User::find($intervention->technicien);
        $url=env('APP_URL');
        $url .='voitures/'.$voiture->id.'/interventions/'.$intervention->id;
        $mail=new MailSend();

        $mail->notification_operation($techniciens,$url);
        return redirect('/voitures/'.$voiture->id.'/interventions/'.$intervention->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function show(Voiture $voiture, Intervention $intervention, Commande $commande)
    {
        $data['voiture'] = $voiture;
        $data['intervention'] = $intervention;
        if($intervention->diagnostic_id)
        {
            $diagnostic = Diagnostic::find($intervention->diagnostic_id);
            $data['diagnostic'] = $diagnostic;
            $data['diagnostic']['defauts'] = $diagnostic->defauts()->get();
        }
        if($intervention->summary_id)
        {
            $summary = Summary::find($intervention->summary_id);
            $data['summary'] = $summary;
        }
        if($intervention->devis_id && isset($intervention->devis_id))
        {
           // $commande=Commande::where('devi_id',$intervention->devis_id)->get();
            $i = 0;
            $item_devis = [];
            $devi = Devi::find($intervention->devis_id);
            $commande=$devi->commandes;
            $data['commande'] = $commande;
            $data['devi'] = $devi;
            $devi_produits = $intervention->devi()->first()->devi_produits()->get();
            foreach($devi_produits as $devi_produit)
            {
                $produit = Produit::find($devi_produit->produit_id);
                $item_devis[$i]['devi_produit'] = $devi_produit;
                $item_devis[$i]['produit'] = $produit;
                $i++;
            }
            $data['devi']['item_devis'] = $item_devis;
        }
        if($intervention->facture_id) {
            $facture=Facture::find($intervention->facture_id);
                if ($facture) {
                    $data['facture']=$facture;
                }
            

        }
      //  dd($facture);
        return view('interventions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function edit(Voiture $voiture, Intervention $intervention)
    {
        $techniciens = User::where('role_id','=',3)->get();
        return view('interventions.edit', compact('voiture','intervention', 'techniciens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
   /* public function update(Request $request, Intervention $intervention)
    {
        //   
    }    */

    
  /*  public function update(Request $request, Voiture $voiture)
     {  
        $intervention = new Intervention();
        $intervention->voiture_id = $voiture->id;
        $intervention->type = $request->input('type');
        $intervention->debut = $request->input('debut');
        $intervention->fin = $request->input('fin');
         dd($intervention);
          $intervention->update($request->all()); 
          return redirect('/voitures/'.$voiture->id);
     }  */
      /*   $request->validate([
            'type' => 'required',
            'debut' => 'required',
            'fin' => 'required'
        ]);
        $intervention->update($request->all());

        //  $intervention->save();
       // $intervention->update($request->all());
        return redirect('/voitures/'.$voiture->id.'/interventions/'.$intervention->id);
    } */

    public function update(Request $request, Voiture $voiture, Intervention $intervention)
    {  
        $request->validate([
            'type' => 'required',
            'debut' => 'required',
            'technicien' => 'required',
        ]);

        $this->authorize('update', $intervention);

        $intervention->type = $request->input('type');
        $intervention->debut = $request->input('debut');
        $intervention->fin = $request->input('fin');
        $intervention->technicien = $request->input('technicien');
        $intervention->update(); 
        return redirect('/voitures/'.$voiture->id);
    }  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervention $intervention)
    {
        //
    }
}
