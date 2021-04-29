@extends('layout.menu')
  
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div>
        <div class="pull-left">
            <h2>  Details Approvisionnement N<sup>o</sup> {{$approvisionnement->id}} de la journee du {{$approvisionnement->date_approvisionnement}}</h2>
        </div>
        
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead style="background-color: #4656E9;">
            <tr>
                <th scope="col" style="color: #ffffff; text-align:center;" >Numero </th>
                <th scope="col" style="color: #ffffff;text-align:center;" >Produit</th>
                <th scope="col" style="color: #ffffff;text-align:center;" >Quantite</th>
                <th scope="col" style="color: #ffffff;text-align:center;" >PU Achat</th>
                <th scope="col" style="color: #ffffff;text-align:center;" >Prix Total</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($approvisionnement->produits as $key=>$produit)
                    <tr>
                        <td style="text-align: center">{{++$key}}</td>
                        <td style="text-align: center">{{$produit->produit}}</td>
                        <td style="text-align: center">{{$produit->pivot->quantite}}</td>
                        <td style="text-align: center">{{$produit->pivot->prix_achat}}</td>
                        <td style="text-align: center">{{$produit->pivot->prix_achat * $produit->pivot->quantite}}</td>
                        
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
                          <td style="text-align: center">{{$prix_tt}}</td>
                       
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:end">Fournisseur</td>
                        <td colspan="4">
                            {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->prenom}}
                            {{App\Models\Fournisseur::find($approvisionnement->fournisseur_id)->nom}}
                        
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    
@endsection