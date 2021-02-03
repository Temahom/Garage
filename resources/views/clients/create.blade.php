@extends('layout.index')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Enregistrer un Client</h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Attention!</strong> Veuillez remplir les champs vides !!!<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('clients.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Nom :</strong>
                <input type="text" name="nom" class="form-control" placeholder="Nom" autocomplete="off">
            </div>

            <div class="form-group">
                <strong>Prénoms:</strong>
                <input type="text" name="prenom" class="form-control" placeholder="Prenoms" autocomplete="off">
            </div>
            
            <div class="form-group">
                    <strong>Sexe :</strong>
                    <select class="form-control" name="genre" id="genre" autocomplete="off">
                      <option value="" disabled selected hidden>Choisissez le sexe...</option>
                      <option value="homme">Homme</option>
                      <option value="femme">Femme</option>
                    </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Entreprise :</strong>
                <input type="text" name="entreprise" class="form-control" placeholder="Entreprise" autocomplete="off">
            </div>
            
            <div class="form-group">
                <strong>Téléphone :</strong>
                <input type="tel" name="telephone" class="form-control" placeholder="Exemple : 7X XXX XX XX" pattern="7[8,7,6,5,0][ ][0-9]{3}[ ][0-9]{2}[ ][0-9]{2}" autocomplete="off">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4 pull-right">
            <a class="btn btn-secondary" href="{{ route('clients.index') }}">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </div>
   
</form>
@endsection