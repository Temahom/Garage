@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter un Nouveau diagnostic</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('voitures.interventions.diagnostics.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
        {{ csrf_field() }}
        @include('diagnostics.partials._form');
    </form>
        
@endsection