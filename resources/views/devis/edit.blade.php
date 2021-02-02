@extends('layout.index')

@section('titre')
<h1>Modifier un Devis</h1>
@endsection
@section('content')

<div class="card-body">
    <form action="{{ route('voitures.interventions.devis.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'devi' => $devi->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cout" class="col-form-label">Coût de Réparation</label>
            <input id="cout" type="number" name="cout" value="{{$devi->cout}}" required class="form-control" placeholder="Coût de réparation">
        </div>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-success">Modifier</button>
            </div>
        </div>
    </form>
</div>
@endsection