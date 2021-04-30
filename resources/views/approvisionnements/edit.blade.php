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
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                   <span class="titre"> <i class="far fa-edit label"></i>Modification Approvisionnement</span> 
                </h2>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 25px;">
        <form action="{{ route('approvisionnements.update', $approvisionnement->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <strong>Nom Produit</strong>
                        <select name="produit_id" class="custom-select form-control" >
                                @foreach( $produits as $product ) 
                                    <option value="{{$product->id}}" {{ $product->produit_id ? 'selected' : '' }}>{{$product->produit }} </option>
                                @endforeach 
                        </select>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Quantité</strong>
                                <input type="number" name="qteAppro" class="form-control" value="{{$approvisionnement->produits[$produit->id-1]->pivot->quantite}}">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Prix</strong>
                                <input type="number" name="prixAchat" class="form-control" value="{{$approvisionnement->produits[$produit->id-1]->pivot->prix_achat}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                        <a class="btn btn-rounded btn-light" href="" title="Go back"> Retour</a>
                        <button type="submit" class="btn btn-rounded btn-warning">Modifier</button>
                    </div>
                </div>
            </div>
        
        </form>
    </div>
</div>
<br>




<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection