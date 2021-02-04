@extends('layout.index')

@section('titre')
<h1>Creer un Devis</h1>
@endsection
@section('content')

<div class="card-body">
    <form action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cout" class="col-form-label">Coût de Réparation</label>
            <input id="cout" type="number" name="cout" required class="form-control" placeholder="Coût de réparation">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3 p-0">
            <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>
@endsection