@extends('layout.index')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Client</h2>
            </div>
        </div>
    </div>
   
  
    <form action="{{ route('clients.update',$client->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Prénoms:</strong>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ $client->prenom }}" placeholder="Prenoms" >
                    <div class="invalid-feedback">
                        @if($errors->has('prenom'))
                        {{ $errors->first('prenom') }}
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <strong>Nom:</strong>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ $client->nom }}" placeholder="Nom">
                    <div class="invalid-feedback">
                        @if($errors->has('nom'))
                        {{ $errors->first('nom') }}
                        @endif
                    </div>
                </div>
                
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

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Entreprise:</strong>
                    <input type="text" name="entreprise" value="{{ $client->entreprise }}" class="form-control" placeholder="Entreprise" >
                </div>

                <div class="form-group">
                    <strong>Téléphone:</strong>
                    <input type="text" name="telephone" value="{{ $client->telephone }}" class="form-control @error('telephone') is-invalid @enderror" placeholder="telephone" >
                    <div class="invalid-feedback">
                        @if($errors->has('telephone'))
                        {{ $errors->first('telephone') }}
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $client->email }}" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" >
                    @if($errors->has('email'))
                    {{ $errors->first('email') }}
                    @endif
                </div>
            </div>

            
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>
    </form>
@endsection