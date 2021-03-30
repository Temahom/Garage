@extends('layout.index')
@php
use Carbon\Carbon;
@endphp
@section('content')

<style>
	.row{
		overflow: hidden !important;
	}
</style>

<link rel="stylesheet" href="/assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste Acteurs</h2>
            </div>
            @can('create', App\Models\User::class)
            <div class="pull-right py-3">
                 <a class="btn btn-success" href="{{ route('actors.create') }}">Ajouter Acteur</a>
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
                            <a href="{{ route('actors.show',$actor->id) }}">{{ $actor->name}} {{"@".$actor->role()->first()->role}} </a>
                            </h3>
                        <h6 class="card-subtitle text-muted mb-3">{{ $actor->email}}  </h6>
                        <p>
                            <a href="{{ route('actors.show',$actor->id) }}" class="btn btn-primary circle">Voir Profile
                          <i class="fa fa-arrow-right ml-2"></i>
                                </a>
                        </p>
                    </div>
                    <!-- /.card-body -->
                    <!-- .card-footer -->
                    <footer class="card-footer row p-0">
                        <!-- .card-footer-item -->
                        <div class="card-footer-item card-footer-item-bordered">
                            <!-- .metric -->
                            <div class="metric">
                                <h6 class="metric-value"> {{$interventions=\App\Models\Intervention::where("user_id","=" ,$actor->id)->count()}} </h6>
                                <p class="metric-label"> Taches </p>
                            </div>
                            <!-- /.metric -->
                        </div>
                        <!-- .card-footer-item -->
                        <!-- /.card-footer-item -->
                        <div class="card-footer-item card-footer-item-bordered">
                            <!-- .metric -->
                            <div class="metric">
                                <h6 class="metric-value"> {{$interventionsAchevee=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('statut','=',3)->where("user_id","=" ,$actor->id)->count()}} </h6>
                                <p class="metric-label"> Completées </p>
                            </div>
                            <!-- /.metric -->
                        </div>
                        <!-- .card-footer-item -->
                        <!-- /.card-footer-item -->
                        <div class="card-footer-item card-footer-item-bordered">
                            <!-- .metric -->
                            <div class="metric">
                                <h6 class="metric-value"> {{$interventionsInachevee=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('statut','!=',3)->where("user_id","=" ,$actor->id)->count()}} </h6>
                                <p class="metric-label"> En Cours </p>
                            </div>
                            <!-- /.metric -->
                        </div>
                        <!-- /.card-footer-item -->
                    </footer>
                    <!-- /.card-footer -->
                </div>
            </div>
        {{-- </div> --}}
          
        
                   
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
                