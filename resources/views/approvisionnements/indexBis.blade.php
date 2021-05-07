@extends('layout.menu')
  
@section('content')
@section('css')
    <style>
        .titre{
                background-image: linear-gradient(to left, #268956, #332F30);
                color:#fff;
                border-radius:20px;
                padding:0 10px;
                padding:10px;
        }
        .label{
            margin-right: 5px;
        }
    </style>
    
@endsection

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="fas fa-list-ul label"></i>Liste Demandes Approvisionnements</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
    @can('create', App\Models\Client::class)
        <div class="pull-right" style="margin-bottom:5px">
            <a class="btn btn-rounded btn-dark" href="{{ route('approvisionnements.create') }}" title="Create a project" style="margin-top: 5px"> 
                <i class="fas fa-plus-circle"> Ajouter</i>
            </a>
        </div>
    @endcan


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">  
            <div class="col-xs-12 col-sm-12 col-md-12 "><br>    
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr style="background-color: #006680;">
                                        <th style="color: white">N°</th>
                                        <th style="color: white">Categorie</th>
                                        <th style="color: white">Nom Produit</th>
                                        <th style="color: white">Stock</th>
                                        <th style="color: white">Stock Alerte</th>
                                        <th style="color: white">Prix Min Dernier Appro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produits as $key=>$produit)
                                        <tr>
                                            <td  style="cursor: pointer; text-transform: capitalize;">{{ ++$key}}</td>
                                            <td  style="cursor: pointer; text-transform: capitalize;">{{ $produit->categorie}}</td>
                                            <td  style="cursor: pointer; text-transform: capitalize;">{{ $produit->produit }}</td>
                                            <td  style="cursor: pointer; text-transform: capitalize;">{{ $produit->qte }}</td>
                                            <td  style="cursor: pointer; text-transform: capitalize;">{{ $produit->quantite_alert}}</td>
                                            @php
                                                $produitFournisseurRecommande = $produit->approvisionnements;
                                                $tabPrix = [];
                                                foreach($produitFournisseurRecommande as $appro)
                                                {
                                                    $tabPrix[] = $appro->pivot->prix_achat;
                                                }
                                                if(count($tabPrix) >= 2)
                                                {
                                                    $prixMinimal = min($tabPrix);
                                                }
                                                else $prixMinimal= null;
                                                
                                            @endphp
                                            <td  style="cursor: pointer; text-transform: capitalize;">{{$prixMinimal}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>   
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>>
@section('javascript')
    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection
    

@endsection