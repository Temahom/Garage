@extends('layout.index')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Client</h2>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Attention!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('clients.update',$client->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom:</strong>
                <input type="text" name="nom" class="form-control" value="{{ $client->nom }}" placeholder="Nom">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prénoms:</strong>
                <input type="text" name="prenom" class="form-control" value="{{ $client->prenom }}" placeholder="Prenoms" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <strong>Genre:</strong>
                    <select class="form-control" name="genre" id="genre">
                        @if($client->genre=="homme")

                      <option style="text-transform: capitalize !important;" value="{{$client->genre}}" >
                        {{$client->genre}}</option>
                        <option value="femme">Femme</option>
                        @else
                        <option style="text-transform: capitalize !important;" value="{{$client->genre}}" >
                        {{$client->genre}}</option>
                      <option value="homme">Homme</option>
                      @endif
                    </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Entreprise:</strong>
                <input type="text" name="entreprise" value="{{ $client->entreprise }}" class="form-control" placeholder="Entreprise" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Téléphone:</strong>
                <input type="text" name="telephone" value="{{ $client->telephone }}" class="form-control" placeholder="telephone" >
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"> Retour</a>
              <button type="submit" class="btn btn-success">Modifier</button>
            </div>
        </div>
   
    </form>
@endsection