@extends('layout.menu')
  
@section('content')


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier l'Approvisionnement</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
            </div>
        </div>
    </div>
</div>
<br>

<form action="{{ route('approvisionnements.update', $approvisionnement->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Fournisseur:</strong>
                    <input type="text" name="fournisseur_id" value="{{ $approvisionnement->fournisseur_id }}" class="form-control" placeholder="fournisseur" onFocus="this.blur()">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <strong>Nom Produit</strong>
                <select name="produit_id" class="custom-select form-control" >
                        @foreach( $produits as $produit ) 
                            <option value="{{$produit->id}}" {{ $produit->produit_id ? 'selected' : '' }}>{{ $approvisionnement->produit_id }} (produit_id)</option>
                        @endforeach 
                </select>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Quantité Totale</strong>
                        <input type="number" name="qteAppro" class="form-control" value="{{ $approvisionnement->qteAppro }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Prix Total</strong>
                        <input type="number" name="prixAchat" class="form-control" value="{{ $approvisionnement->prixAchat }}">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
    </div>

</form>


<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection