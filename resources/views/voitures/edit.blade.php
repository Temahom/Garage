@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification Voiture</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('voitures.update', $voiture->id) }}" method="POST" >
        @csrf
        @method('PATCH')

        @include('voitures._partials._form')

    </form>
    
@endsection