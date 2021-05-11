@extends('layout.menu')
  
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
                    <span class="titre"><i class="fas fa-tag label"></i>Ajout d'un Fournisseur</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br> 
   
   
<form action="{{ route('fournisseurs.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">  
            <div class="col-xs-6 col-sm-6 col-md-6">
                
                <div class="form-group">
                    <strong>Prénoms:</strong>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prenoms du Fournisseur" autocomplete="off" value="{{ old('prenom') }}">
                    <div class="invalid-feedback">
                        @if($errors->has('prenom'))
                        {{ $errors->first('prenom') }}
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <strong>Nom :</strong>
                    <input type="text" name="nom" class="form-control  @error('nom') is-invalid @enderror" placeholder="Nom du Fournisseur" autocomplete="off" value="{{ old('nom') }}">
                    <div class="invalid-feedback">
                        @if($errors->has('nom'))
                        {{ $errors->first('nom') }}
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <strong>Sexe :</strong>
                    <select class="form-control @error('genre') is-invalid @enderror" name="genre" id="genre" autocomplete="off">
                        <option value="" disabled selected hidden>Choisissez le sexe...</option>
                        <option value="homme" {{ old('genre') == 'homme' ? 'selected' : '' }}>Homme</option>
                        <option value="femme" {{ old('genre') == 'femme' ? 'selected' : '' }}>Femme</option>
                    </select>
                </div>
                <div class="invalid-feedback">
                    @if($errors->has('genre'))
                    {{ $errors->first('genre') }}
                    @endif
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Entreprise :</strong>
                    <input type="text" name="entreprise" class="form-control @error('entreprise') is-invalid @enderror" placeholder="Entreprise du Fournisseur" autocomplete="off"  value="{{ old('entreprise') }}">
                </div>
                <div class="invalid-feedback">
                    @if($errors->has('entreprise'))
                    {{ $errors->first('entreprise') }}
                    @endif
                </div>
                
                <div class="form-group">
                    <strong>Téléphone :</strong>
                    <input type="tel" name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Exemple : 7XXXXXXXX" pattern="7[8,7,6,5,0][0-9]{3}[0-9]{2}[0-9]{2}" autocomplete="off"  value="{{ old('telephone') }}">
                    <div class="invalid-feedback">
                        @if($errors->has('telephone'))
                        {{ $errors->first('telephone') }}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <strong>Email :</strong>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email du Fournisseur"  value="{{ old('email') }}">
                    <div class="invalid-feedback">
                        @if($errors->has('email'))
                        {{ $errors->first('email') }}
                        @endif
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-12 pl-0 py-4 ml-4">
                    <a class="btn btn-rounded btn-secondary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-angle-left "></i> Retour</a>
                    <button class="btn btn-rounded btn-success" type="submit" style="color: white; margin-left: 6px; ">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
   
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

@endsection