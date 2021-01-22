@extends('layout.index')

@section('titre')
<h1>Creer un Devis</h1>
@endsection
@section('content')

<div class="card-body">
    <form action="/devis" method="POST">
        @csrf
        <div class="form-group">
            <label for="cout" class="col-form-label">Coût de Réparation</label>
            <input id="cout" type="number" name="cout" required class="form-control" placeholder="Coût de réparation">
        </div>
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Créer</button>
        </div>
    </form>
</div>
@endsection