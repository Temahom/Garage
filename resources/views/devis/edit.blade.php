@extends('layout.index')

@section('titre')
<h1>Modifier un Devis</h1>
@endsection
@section('content')

<div class="card-body">
    <form action="/devis/{{$devi->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cout" class="col-form-label">Coût de Réparation</label>
            <input id="cout" type="number" name="cout" value="{{$devi->cout}}" required class="form-control" placeholder="Coût de réparation">
        </div>
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</div>
@endsection