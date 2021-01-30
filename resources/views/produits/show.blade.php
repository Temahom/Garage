@extends('layout.index')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Les Détails du Produit  : {{ $produit->produit }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produits.index') }}" title="Go back"><span style="font-size:15px;">&#129060;</span> Retour </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>La Catégorie :</strong>
                {{ $produit->categorie }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Le Nom du Produit :</strong>
                {{ $produit->produit }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix : </strong>
                {{ $produit->prix }}<sup>F CFA</sup>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantite :</strong>
                {{ $produit->qte }}
            </div>
        </div>
    </div>
@endsection