@extends('layout.index')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Intervention</h2>
            </div>
        </div>
    </div>

    <form action="{{route('voitures.interventions.store',['voiture' => $voiture->id])}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Type intervention</strong>
                    <select name="type" value="" class="form-control" placeholder="Saisir type intervention...">
                        <option>Entretien</option>
                        <option>Réparation</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Début:</strong>
                    <input type="date" name="debut" value="" class="form-control" placeholder="Date de debut...">
                </div>
                 <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Fin</strong>
                    <input type="date" name="fin" value="" class="form-control" placeholder="Date de fin...">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <a class="btn btn-secondary" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}"><i class="fas fa-angle-left"></i> Retour</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>
    </form>
        
@endsection