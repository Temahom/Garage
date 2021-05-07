@extends('layout.menu')
@php
	use App\Models\Produit;
$listes=Produit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp


@section('content')

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

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="far fa-edit label"></i></i>Modification Produit</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br><br>

    
    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">  
                <div class="col-xs-6 col-sm-6 col-md-6">      
                    <div class="form-group">
                        <strong>Categorie :</strong>
                       <!--<select name="categorie" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror" onchange="change();">
                            <option value="">catégorie</option>
                                @foreach ($listes as $liste)
                                        <option value="{{$liste->categorie}}" {{ old('categorie') == ($liste->categorie) ? 'selected' : '' }}>{{$liste->categorie}}</option>
                          
                                @endforeach
                        </select>-->
                        <input name="categorie" value="{{$produit->categorie}}" type="text" class="custom-select form-control @error('categorie') is-invalid @enderror" id="categorie" autocomplete="off" placeholder="Entrer une nouvelle catégorie"/>
                        <div class="invalid-feedback">
                            @if($errors->has('categorie'))
                            {{ $errors->first('categorie') }}
                            @endif
                        </div>	 
                    </div>
                    <div class="form-group">
                        <strong>Nom du produit </strong> 
                            <input type="text" name="produit" value="{{$produit->produit}}" class="custom-select form-control @error('produit') is-invalid @enderror" id="leproduit" placeholder="Mettre le nom du produit" autocomplete="off"/>  
                            <div class="invalid-feedback">
                                @if($errors->has('produit'))
                                {{ $errors->first('produit') }}
                                @endif
                            </div>	
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">      
                    <div class="form-group">
                        <strong>Le Prix Unitaire </strong>
                        <input name="prix1" value="{{$produit->prix1}}" type="number" class="custom-select form-control @error('prix1') is-invalid @enderror" min="0" id="leprix" autocomplete="off" placeholder="Mettre le prix du produit"/>
                        
                        <div class="invalid-feedback">
                            @if($errors->has('prix1'))
                            {{ $errors->first('prix1') }}
                            @endif
                        </div>	
                    </div>	
                    <div class="form-group">
                        <strong> Quantité </strong>
                            <input jsaction="input:trigger.Wtqxqe" type="number" value="{{$produit->qte}}" min="0" name="qte" class="custom-select form-control @error('qte') is-invalid @enderror"  placeholder="Entrer la Quantite" value="{{ old('qte') }}">
                            <div class="invalid-feedback">
                                @if($errors->has('qte'))
                                {{ $errors->first('qte') }}
                                @endif
                            </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">      
                    <div class="form-group">
                        <strong>Quantite Alerte</strong>
                        <input name="quantite_alert" type="number" value="{{$produit->quantite_alert}}" class="custom-select form-control @error('quantite_alert') is-invalid @enderror" min="0" placeholder="Definir une quantite alerte"/>
                        <div class="invalid-feedback">
                            @if($errors->has('quantite_alert'))
                            {{ $errors->first('quantite_alert') }}
                            @endif
                        </div>	
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pl-0 py-4 ml-4">
                    <a class="btn btn-rounded btn-secondary" href="{{ route('produits.index') }}" title="Go back"><i class="fas fa-angle-left"></i> Retour</a>
                    <button style="color: white; margin-left: 6px; " type="submit" class="btn btn-rounded btn-success">Créer produit</button>
                </div>
            </div>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>



@endsection