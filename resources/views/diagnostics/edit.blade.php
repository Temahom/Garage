@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier mon diagnostic</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>warning</strong>Veuillez vérifier vos saisies<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>   
    @endif

    <form action="{{ route('voitures.interventions.diagnostics.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'diagnostic' => $diagnostic->id]) }}" method="POST">
        @csrf
        @method('PUT')

        @include('diagnostics.partials._form');

    </form>
    
@endsection