@extends('layout.index')

@section('content')

    <style>
        .row{
            overflow: hidden;
        }
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification Acteur</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('actors.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @include('actors._partials._form')

    </form>


@endsection