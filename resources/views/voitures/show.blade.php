@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voiture</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('voitures.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Matricule:</strong>
                {{ $voiture->matricule }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marque:</strong>
                {{ $voiture->marque }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modele:</strong>
                {{ $voiture->model }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Annee:</strong>
                {{ $voiture->annee }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Carburant:</strong>
                {{ $voiture->carburant }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Puissance:</strong>
                {{ $voiture->puissance}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>proprietaire:</strong>
                {{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}
            </div>
        </div>
        
    </div>
    
@endsection