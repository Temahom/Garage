@extends('layout.index')
   
@section('content')

<style>
	.row{
		overflow: hidden;
	}
</style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Le Fournisseur</h2>
            </div>
        </div>
    </div>
   
  
    <form action="{{ route('fournisseurs.update',$fournisseur->id) }}" method="POST">
        @csrf
        @method('PUT')
   
       
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Prénoms du Fournisseur:</strong>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ $fournisseur->prenom }}" placeholder="Prenoms du Fournisseur" >
                    <div class="invalid-feedback">
                        @if($errors->has('prenom'))
                        {{ $errors->first('prenom') }}
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <strong>Nom du Fournisseur:</strong>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ $fournisseur->nom }}" placeholder="Nom du Fournisseur">
                    <div class="invalid-feedback">
                        @if($errors->has('nom'))
                        {{ $errors->first('nom') }}
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <strong>Genre:</strong>
                    <select class="form-control" name="genre" id="genre">
                        @if($fournisseur->genre=="homme")

                      <option style="text-transform: capitalize !important;" value="{{$fournisseur->genre}}" >
                        {{$fournisseur->genre}}</option>
                        <option value="femme">Femme</option>
                        @else
                        <option style="text-transform: capitalize !important;" value="{{$fournisseur->genre}}" >
                        {{$fournisseur->genre}}</option>
                      <option value="homme">Homme</option>
                      @endif
                    </select>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Entreprise du Fournisseur:</strong>
                    <input type="text" name="entreprise" value="{{ $fournisseur->entreprise }}" class="form-control" placeholder="Entreprise du Fournisseur" >
                </div>

                <div class="form-group">
                    <strong>Téléphone du Fournisseur:</strong> 
                    <input type="text" name="telephone" value="{{ $fournisseur->telephone }}" pattern="7[8,7,6,5,0][0-9]{3}[0-9]{2}[0-9]{2}" autocomplete="off" class="form-control @error('telephone') is-invalid @enderror" placeholder="telephone du Fournisseur" >
                    <div class="invalid-feedback">
                        @if($errors->has('telephone'))
                        {{ $errors->first('telephone') }}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <strong>Email du Fournisseur:</strong>
                    <input type="email" name="email" value="{{ $fournisseur->email }}" class="form-control  @error('email') is-invalid @enderror" placeholder="Email du Fournisseur" >
                    @if($errors->has('email'))
                    {{ $errors->first('email') }}
                    @endif
                </div>
            </div>

            
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                <a class="btn btn-secondary" href="{{ route('fournisseurs.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>
</div>
    </form>

    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    
@endsection