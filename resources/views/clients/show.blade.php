@extends('layout.index')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Voir Client</h2>
            </div>
        </div>
    </div>
   
    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nom:</strong>
                {{ $client->nom }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prénoms:</strong>
                {{ $client->prenom }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="text-transform: capitalize;">
                    <strong>Genre:</strong>
                    {{ $client->genre }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Entreprise:</strong>
                {{ $client->entreprise }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Téléphone:</strong>
               {{ $client->telephone }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
           <table class="table table-striped table-hover col-md-12">
                <thead class="thead-dark">
                    <tr>
                        <th>Matricule</th>
                        <th>Marque</th>
                        <th>Model</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($voitures as $voiture)
                    <tr>
                         <td>{{$voiture->matricule}}</td>
                         <td>{{$voiture->marque}}</td>
                         <td>{{$voiture->model}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
         </div>
          <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"> Retour</a>
            </div>
           
    </div>
@endsection