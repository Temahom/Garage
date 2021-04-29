@extends('layout.menu')
  
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-secondary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-angle-left "></i> Retour</a>
            </div><br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">  
                    <div class="col-md-3"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 text-center pt-4">
                                @if ($fournisseur->genre == "homme")
                                    <img style="height: 50px;width: auto;" class="" src="/assets/images/masculin.png" alt="logo">
                                @else
                                    <img style="height: 50px;width: auto;" class="" src="/assets/images/feminin.png" alt="logo">
                                @endif
                            </div>
        
                            <div class="col-md-8 col-sm-5">
                                <div style="font-size: 20px; color: #2EC551"><a href="" style="color: #2EC551">{{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->prenom}}  {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->nom}}</a></div>
                                <div style="font-size: 14px;"><i class="fas fa-home"></i> {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->entreprise}}</div>
                                <div style="font-size: 14px;"><i class="fas fa-phone"></i> {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->telephone}}</div>
                                <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->email}}</div>
                                @can('update', $fournisseur)
                                <div class="text-right" style="font-size: 12px;">
                                    <a class="text-primary mr-1" href="{{ route('fournisseurs.edit', App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->id)}}">Modifier</a> 
                                    <button type="button" class="text-danger" id="hide_fournisseurs" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->id}}">
                                        Supprimer
                                    </button>
                
                                            <div class="modal fade" id="exampleModal{{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h5>Voulez vous supprimer: <strong>{{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->nom}} {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->prenom}}</strong>  ?</h5>;
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <form action="{{route('fournisseurs.destroy', App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                            </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                @endcan
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div><br>

<div style="font-size: 20px; text-align: center"><em>Date d'approvisionnement: {{date("d-m-Y", strtotime($approvisionnement->date_approvisionnement))}}</em></div><br>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <table class="table table-bordered">
            <thead style="background-color: #4656E9;">
            <tr>
                <th scope="col" style="color: #ffffff; text-align:center; width: 5%" >Numero </th>
                <th scope="col" style="color: #ffffff;text-align:center;" >Produit</th>
                <th scope="col" style="color: #ffffff;text-align:center; width: 20%" >Quantite</th>
                <th scope="col" style="color: #ffffff;text-align:center; width: 20%" >PU Achat</th>
                <th scope="col" style="color: #ffffff;text-align:center; width: 20%" >Prix Total</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($approvisionnement->produits as $key=>$produit)
                    <tr>
                        <td style="text-align: center">{{++$key}}</td>
                        <td style="text-align: center">{{$produit->produit}}</td>
                        <td style="text-align: center">{{$produit->pivot->quantite}}</td>
                        <td style="text-align: center">{{$produit->pivot->prix_achat}}</td>
                        <td style="text-align: center;">{{$produit->pivot->prix_achat * $produit->pivot->quantite}}</td>
                        
                    </tr>
                    
                @endforeach
                    <tr>
                        <td colspan="4" style="text-align: end;">Prix TT</td>
                      @php
                        $prix_tt= 0;
                          foreach ($approvisionnement->produits as $produit) {
                              $prix_tt += $produit->pivot->prix_achat*$produit->pivot->quantite;
                          }
                          $prix_tt;
                      @endphp    
                          <td style="text-align: center; background-color: rgba(148, 136, 136, 0.431)"><b>{{$prix_tt}} <sup>FCFA</sup></b></td>
                       
                    </tr>
                   <!-- <tr>
                        <td colspan="2" style="text-align:end">Fournisseur</td>
                        <td colspan="4">
                            {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->prenom}}
                            {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->nom}}
                        
                        </td>
                    </tr>-->
            </tbody>
        </table>
    </div>
</div>

<script>
    function showAppro(id)
    {
        window.location = '/approvisionnements/' + id ;
    }
</script>


    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    
@endsection