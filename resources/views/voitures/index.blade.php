@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste Voitures</h2>
            </div>
            <div class="pull-right py-3">
<<<<<<< HEAD
                @can('create', App\Models\Voiture::class)
                 <a class="btn btn-success" href="{{ route('voitures.create') }}">Ajouter Voiture</a>
                @endcan
=======
                <a class="btn btn-primary" href="{{ route('voitures.create') }}">Ajouter Voiture</a>
>>>>>>> 872cf8551a8c01f7e7495454e2606096039b590d
            </div>
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
    <div class="col-lg-12 margin-tb">
    <table class="table table-bordered">
        <tr>
            <th>Matricule</th>
            <th>Marque</th>
            <th>Model</th>
            <th>Annee</th>
            <th>Carburant</th>
            <th>Puissance</th>
            <th width='275px'>Action</th>
        </tr>
        @foreach ($voitures as $voiture)
        <tr>
            <td>{{ $voiture->matricule}}</td>
            <td>{{ $voiture->marque}}</td>
            <td>{{ $voiture->model}}</td>
            <td>{{ $voiture->annee}}</td>
            <td>{{ $voiture->carburant}}</td>
            <td>{{ $voiture->puissance}}</td>
            <td>
            <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">   
<<<<<<< HEAD
                    <a class="btn btn-info" href="{{ route('voitures.show',$voiture->id) }}"><i class="fas fa-eye mr-2"></i></a>    
                @can('raf')
                <a class="btn btn-primary" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit mr-2"></i></a>
                @endcan
                      
=======
                    <a class="btn btn-success" href="{{ route('voitures.show',$voiture->id) }}"><i class="fas fa-eye mr-2"></i></a>    
                    <a class="btn btn-info" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit mr-2"></i></a>   
>>>>>>> 872cf8551a8c01f7e7495454e2606096039b590d
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i></button>
                </form>
            </td>
        </tr>
            
        @endforeach
    </table>
    </div>
    </div>



@endsection