@extends('layout.index')
  
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter un approvisionnement</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
            </div>
        </div>
    </div>
</div>
<br>
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
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">    
                        <div class="form-group">
                            <strong>Fournisseur</strong>
                                <select name="fournisseur_id" class="custom-select form-control  @error('fournisseur_id') is-invalid @enderror" >
                                    @if(!empty($fournisseur->id))
                                        <option value="{{$fournisseur->id}}">{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                    @else   
                                        @foreach( $fournisseurs as $fournisseur ) 
                                            <option value="{{$fournisseur->id}}" {{ old('fournisseur_id') == ($fournisseur->id) ? 'selected' : '' }} {{$approvisionnement->fournisseur_id == $fournisseur->id ? 'selected':'' }}>{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                        @endforeach 
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                  @if($errors->has('fournisseur_id'))
                                    Le champs Fournisseur est obligatoire.
                                  @endif
                                </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Nom du produit:</strong>
                            <input class="form-control" name="nomProduit" placeholder="nom du produit">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Quantité Totale:</strong>
                                <input type="number" name="qteTotale" class="form-control" placeholder="qteTotale">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Prix Total:</strong>
                                <input type="number" name="prixTotal" class="form-control" placeholder="prixTotal">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
        </form>

<script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

@endsection