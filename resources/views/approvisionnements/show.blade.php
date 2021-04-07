@extends('layout.index')
  
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>  {{ $approvisionnement->name }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Fournisseur :</strong>
            {{ $approvisionnement->fournisseur }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nom du Produit :</strong>
            {{ $approvisionnement->nomProduit }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Quantité Totale :</strong>
            {{ $approvisionnement->qteTotale }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Prix Total :</strong>
            {{ $approvisionnement->prixTotal }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date d'entrée :</strong>
            {{ date_format($approvisionnement->created_at, 'jS M Y') }}
        </div>
    </div>
</div>
@endsection