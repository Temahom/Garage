@extends('layout.index')
  
@section('content')


<style>
	.row{
		overflow: hidden !important;
	}
</style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Enregistrer un Client</h2>
        </div>
    </div>
</div>
   
   
<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xs-6 col-sm-6 col-md-6">
            
            <div class="form-group">
                <strong>Prénoms:</strong>
                <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prenoms" autocomplete="off" value="{{ old('prenom') }}">
                <div class="invalid-feedback">
                    @if($errors->has('prenom'))
                    {{ $errors->first('prenom') }}
                    @endif
                </div>
            </div>

            <div class="form-group">
                <strong>Nom :</strong>
                <input type="text" name="nom" class="form-control  @error('nom') is-invalid @enderror" placeholder="Nom" autocomplete="off" value="{{ old('nom') }}">
                <div class="invalid-feedback">
                    @if($errors->has('nom'))
                    {{ $errors->first('nom') }}
                    @endif
                  </div>
            </div>
            
            <div class="form-group">
                    <strong>Sexe :</strong>
                    <select class="form-control" name="genre" id="genre" autocomplete="off">
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
                <input type="text" name="entreprise" class="form-control" placeholder="Entreprise" autocomplete="off"  value="{{ old('entreprise') }}">
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
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"  value="{{ old('email') }}">
                <div class="invalid-feedback">
                    @if($errors->has('email'))
                    {{ $errors->first('email') }}
                    @endif
                </div>
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4 pull-right">
            <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </div></div>
   
</form>

    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

@endsection