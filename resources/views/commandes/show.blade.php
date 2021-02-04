@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Go back"> <i class="fas fa-backward "></i>  Retour</a>
            </div>
        </div>
    </div>
        <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Catégorie :</strong>
                {{ $commande->catProduit }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du produit :</strong>
                {{ $commande->nomProduit }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantité voulue:</strong>
                {{ $commande->qteProduit }}
            </div>
        </div>
    </div>
@endsection