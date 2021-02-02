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
        <strong>Attention!</strong> Please check your input code<br><br>
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
                <strong>Nom:</strong>
                <input type="text" name="nom" class="form-control" placeholder="Nom">
            </div>

            <div class="form-group">
                <strong>Prénoms:</strong>
                <input type="text" name="prenom" class="form-control" placeholder="Prenoms" >
            </div>
            
            <div class="form-group">
                    <strong>Sexe:</strong>
                    <select class="form-control" name="genre" id="genre">
                      <option value="" disabled selected hidden>Choisissez le sexe...</option>
                      <option value="homme">Homme</option>
                      <option value="femme">Femme</option>
                    </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Entreprise :</strong>
                <input type="text" name="entreprise" class="form-control" placeholder="Entreprise" >
            </div>
            
            <div class="form-group">
                <strong>Téléphone:</strong>
                <input type="text" name="telephone" class="form-control" placeholder="telephone" >
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4 pull-right">
            <a class="btn btn-secondary" href="{{ route('clients.index') }}">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </div>
   
</form>
@endsection