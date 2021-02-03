@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste Voitures</h2>
            </div>
            <div class="pull-right py-3">
                @can('create', App\Models\Voiture::class)
                 <a class="btn btn-success" href="{{ route('voitures.create') }}">Ajouter Voiture</a>
                @endcan
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
            {{-- <form action="{{ route('voitures.destroy',$voiture->id) }}" method="POST">    --}}
                    <a class="btn btn-info" href="{{ route('voitures.show',$voiture->id) }}"><i class="fas fa-eye mr-2"></i></a>    
                
                    <a class="btn btn-primary" href="{{ route('voitures.edit',$voiture->id) }}"><i class="fas fa-edit mr-2"></i></a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                        <i class="fas fa-trash mr-2"></i>
                    </button> 
                    <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<h5>Voulez vous vraiment supprimer <strong>la {{ $voiture->marque }} de {{ $voiture->matricule }} de liste des voitures</strong>  ?</h5>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<form action="{{route('voitures.destroy',$voiture->id)}}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger">Supprimer</button>
									</form>
							</div>
						</div>
					</div>
                
            </td>
        </tr>
            
        @endforeach
    </table>
    </div>
    </div>
    <div class="row">
		<div class="col-md-12 mt-3 d-flex justify-content-center">
			{!! $voitures->links() !!}
		</div>
	</div>


@endsection