@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifiez L'intervention</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a eu des problèmes avec votre entrée.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    
    <form action="{{route('voitures.interventions.store',['voiture' => $voiture->id] )}}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Type d' Intervention</strong>
                    <select name="type" value="" class="form-control" placeholder="Saisir type intervention...">
                        <option>Entretien</option>
                        <option>Réparation</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Date Début : </strong>
                    <input type="date" name="debut" value="" class="form-control" placeholder="Date de debut...">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Date Fin : </strong>
                    <input type="date" name="fin" value="" class="form-control" placeholder="Date de fin...">
                </div>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-3 text-center">
                    <a class="btn btn-secondary" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}">Retour</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>

    </form>

@endsection