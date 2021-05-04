@extends('layout.index')
@php
use Carbon\Carbon;
@endphp
@section('content')

<style>
	/* .row{
		overflow: hidden !important;
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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                    <span class="titre"><i class="fas fa-list-ul label"></i>Liste des Acteurs</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br>
<link rel="stylesheet" href="/assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            @can('create', App\Models\User::class)
                <div class="col-xs-9 col-sm-9 col-md-9">     
                    <div class="form-group">
                        <a class="btn btn-secondary" href="{{ route('actors.create') }}">Ajouter <i class="icon-people"></i></a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <style>
        svg{
            display: none;
        }
    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">  
       
            @foreach ($actors as $actor)
                {{-- <div onclick="showActor({{ $actor->id }})" class="card d-flex justify-content-center mr-2" style="width: 18rem; justify-content: center; text-align: center; cursor: pointer;"> --}}
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">      
                    <div class="card card-fluid">
                        <!-- .card-body -->
                        <div class="card-body text-center">
                            <!-- .user-avatar -->

                            <td>
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle  card-drop" data-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item "> Taches <span class="badge badge-dark">  {{$interventions=\App\Models\Intervention::where("user_id","=" ,$actor->id)->count()}}</span> </a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">En Cours <span class="badge badge-dark"> {{$interventionsInachevee=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('statut','!=',3)->where("user_id","=" ,$actor->id)->count()}}</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Completées <span class="badge badge-dark">  {{$interventionsAchevee=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('statut','=',3)->where("user_id","=" ,$actor->id)->count()}}</a>
                                    </div>
                                </div>
                            </td>

                            <a href="{{ route('actors.edit',$actor->id)  }}" class="user-avatar user-avatar-xl my-3">
                                @if(isset($actor->image))
                                    <img  src="{{asset('images/'.$actor->image)}}" alt="{{ $actor->name}}" class="rounded-circle user-avatar-xl">
                                @else
                                    <img src="https://ui-avatars.com/api/?background=random&color=fff&name={{ $actor->name}}"  alt="{{ $actor->name}}" class="rounded-circle user-avatar-xl">
                                @endif
                                @can('update', $actor)
                                    <span class="avatar-badge has-indicator online" style="width: 30px; height: 30px;">
                                        <i style="font-size: 20px !important;font-weight: bold;" class="icon-note" ></i>
                                    </span>
                                @endcan    
                            </a>
                            <!-- /.user-avatar -->
                            <h3 class="card-title mb-2 text-truncate">
                                <a href="{{ route('actors.show',$actor->id) }}">{{ $actor->name}} </a>
                                <h3> <span class="badge badge-dark"> {{"@".$actor->role()->first()->role}} </span> </h3>
                            <h6 class="card-subtitle text-muted mb-3">{{ $actor->email}}  </h6>
                            <p>
                                <a href="{{ route('actors.show',$actor->id) }}" class="btn btn-primary circle">Voir Profile
                                    <i class="fa fa-arrow-right ml-2"></i>
                                </a>
                            </p>
                        </div>
                        <!-- /.card-body -->
                        <!-- .card-footer -->
                        
                        <!-- /.card-footer -->
                    </div>
                </div>

            @endforeach  
  
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">  
            <div class="col-md-12 mt-3 d-flex justify-content-center">
                {!! $actors->links() !!}
            </div>
        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
    function showActor(id)
    {
        window.location = 'actors/' + id ;
    }
</script>

@endsection      
                