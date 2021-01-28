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
            <table class="table table-bordered">
                <tr>
                    <th>Matricule</th>
                    <th>Marque</th>
                    <th>Model</th>
                    <th>Annee</th>
                    <th>Carburant</th>
                    <th>Puissance</th>
                    <th width='275px'>Action</th>
                </tr>
                @foreach ($voitures as $voiture)
                <tr>
                    <td>{{ $voiture->matricule}}</td>
                    <td>{{ $voiture->marque}}</td>
                    <td>{{ $voiture->model}}</td>
                    <td>{{ $voiture->annee}}</td>
                    <td>{{ $voiture->carburant}}</td>
                    <td>{{ $voiture->puissance}}</td>
                    <td>
                    <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">   
                            <a class="btn btn-info" href="{{ route('voitures.show',$voiture->id) }}"><i class="fas fa-eye mr-2"></i></a>    
                            <a class="btn btn-primary" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit mr-2"></i></a>   
                            @csrf
                            @method('DELETE')      
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i></button>
                        </form>
                    </td>
                </tr>
                    
                @endforeach
            </table>
         </div>
          <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"> Retour</a>
            </div>
           
    </div>
@endsection