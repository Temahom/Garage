@extends('layout.index')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voiture</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('voitures.store') }}" method="POST">
        {{ csrf_field() }}
        @include('voitures._partials._form');
        
    </form>
        
@endsection