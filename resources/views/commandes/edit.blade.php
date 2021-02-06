@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier la commande</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Aller au panier">Aller au panier</a>
            </div>
        </div>
    </div><br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Catégorie :</strong>
                    <input type="text" name="catProduit" value="{{ $commande->catProduit }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nom du produit :</strong>
                    <input type="text" name="nomProduit" value="{{ $commande->nomProduit }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Quantité Voulue :</strong>
                    <input type="number" name="qteProduit" value="{{ $commande->qteProduit }}" class="form-control">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>

    </form>
@endsection