@extends('layout.index')
  
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Modifier Approvisionnements</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
        </div>
    </div>
</div>

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

<form action="{{ route('approvisionnements.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fournisseur:</strong>
                <input type="text" name="name" value="{{ $approvisionnement->fournisseur }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du Produit:</strong>
                <input type="text" name="name" value="{{ $approvisionnement->nomProduit }}" class="form-control" placeholder="Name">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantité Totale</strong>
                <input type="number" name="location" class="form-control" placeholder="{{ $approvisionnement->qteTotale }}" value="{{ $approvisionnement->qteTotale }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix Total</strong>
                <input type="number" name="cost" class="form-control" placeholder="{{ $approvisionnement->prixTotal }}" value="{{ $approvisionnement->prixTotal }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>


@endsection