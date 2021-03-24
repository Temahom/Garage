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
                <h2>Ajout Acteur</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('actors.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
        @include('actors._partials._form')
        
    </form>
        
@endsection