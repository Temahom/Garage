@extends('layout.index')
  
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter un approvisionnement</h2>
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
<form action="{{ route('approvisionnements.store') }}" method="POST" >
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fournisseur:</strong>
                <input type="text" name="fournisseur" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom du produit:</strong>
                <input class="form-control" style="height:50px" name="nomProduit"placeholder="Introduction">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantité Totale:</strong>
                <input type="number" name="location" class="form-control" placeholder="qteTotale">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix Total:</strong>
                <input type="number" name="cost" class="form-control" placeholder="prixTotal">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </div>

</form>

<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

@endsection