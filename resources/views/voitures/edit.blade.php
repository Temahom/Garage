@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier Voiture</h2>
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

    <form action="{{ route('voitures.update', $voiture->id) }}" method="POST">
        @csrf
        @method('PATCH')

        @include('voitures._partials._form')

    </form>
    
@endsection