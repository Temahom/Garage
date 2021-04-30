@extends('layout.menu')
  
@section('content')

<style>
    .titre{
            background-image: linear-gradient(to left, #268956, #332F30);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:15px;
    }
    .label{
        margin-right: 5px;
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="fas fa-list-ul label"></i>Liste approvisionnements</span>
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

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="pull-right" style="margin-bottom:5px">
        <a class="btn btn-rounded btn-success" href="{{ route('approvisionnements.create') }}" title="Create a project" style="margin-top: 5px"> 
            <i class="fas fa-plus-circle"> Ajouter</i>
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example4" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr style="background-color: #4656E9;">
                            <th style="color: white">N°</th>
                            <th style="color: white">Fournisseur</th>
                            <th style="color: white">Date Approvisionnement</th>
                            <th style="color: white">Nombre D'articles</th>
                            <th style="color: white">Coût Facture</th>
                            {{-- <th style="color: white; text-align: center">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvisionnements as $approvisionnement)
                            <tr>
                                <td onclick="showAppro({{ $approvisionnement->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $approvisionnement->id }}</td>
                                <td onclick="showAppro({{ $approvisionnement->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $approvisionnement->fournisseur()->first()->prenom }} {{ $approvisionnement->fournisseur()->first()->nom }}</td>
                                <td onclick="showAppro({{ $approvisionnement->id }})"style="cursor: pointer; text-transform: capitalize;">{{ $approvisionnement->date_approvisionnement }}</td>
                                <td onclick="showAppro({{ $approvisionnement->id }})" style="cursor: pointer; text-transform: capitalize;">{{ count($approvisionnement->produits) }}</td>
                                @php
                                    $prix_tt= 0;
                                    foreach ($approvisionnement->produits as $produit) {
                                        $prix_tt += $produit->pivot->prix_achat*$produit->pivot->quantite;
                                    }
                                    $prix_tt;
                                @endphp
                                <td style="cursor: pointer; text-transform: capitalize;">{{$prix_tt}} <sup>FCFA</sup> </td>
                                {{-- <td style="color: white; text-align: center">
                                    <form action="{{ route('approvisionnements.destroy', $approvisionnement->id) }}" method="POST">
                                        <a href="{{ route('approvisionnements.edit', $approvisionnement->id) }}">
                                            <i class="fas fa-edit  fa-lg"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger p-0 pr-2 pl-2 " data-toggle="modal" data-target="#exampleModal{{ $approvisionnement->id }}" onclick="OnOff();">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                                <div class="modal fade" id="exampleModal{{ $approvisionnement->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5>Voulez vous supprimer </h5>
                                                                <h5>l'Approvisionnement de <strong>{{ $approvisionnement->nomProduit}}</strong></h5>
                                                                <h5>Quantité Totale : <strong>{{ $approvisionnement->qteTotale}}</strong> | Prix Total : <strong>{{ $approvisionnement->prixTotal}} cfa</strong></h5>
                                                                <h5> du fournisseur <strong>{{ $approvisionnement->fournisseur()->first()->prenom }} {{ $approvisionnement->fournisseur()->first()->nom }}</strong>  ?</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                <form action="{{route('approvisionnements.destroy',$approvisionnement->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>   
                </table>
            </div>
        </div>
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