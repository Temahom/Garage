@extends('layout.index')
@section('content')

<style>
	/* .row{
		overflow: hidden;
	} */
    .titre{
            background-image: linear-gradient(to left, #161344, #332F30);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:10px;
    }
    .label{
        margin-right: 5px;
    }
</style>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="fas fa-tag label"></i>Ajout Acteur</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br> 

    <form action="{{ route('actors.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
        @include('actors._partials._form')
        
    </form>
        
@endsection