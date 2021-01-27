@extends('layout.index')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Tous les Clients</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-success" href="{{route('clients.create')}}">Enregistrer un Client</a>
			</div>
		</div>
	</div>
	<br>
	<br>

	@if($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{$message}}</p>
		</div>
	@endif

	<div class="row">
	<div class="col-md-12 margin-tb">
	<table class="table table-striped table-hover col-md-12">
		<thead class="thead-dark">
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Prénoms</th>
				<th>Genre</th>
				<th>Entreprise</th>
				<th>Téléphone</th>
				<th>Action</th>
			</tr>
		</thead>
		@foreach ($clients as $client)
		<tbody>
			<tr>
				<td>{{ $client->id }}</td>
				<td>{{ $client->nom }}</td>
				<td>{{ $client->prenom }}</td>
				<td style="text-transform: capitalize;">{{ $client->genre }}</td>
				<td>{{ $client->entreprise }}</td>
				<td>{{ $client->telephone }}</td>
				<td>
					<a class="btn btn-success" href="{{route('clients.show',$client->id)}}"><i class="fas fa-eye mr-2"></i></a>
					<a class="btn btn-primary" href="{{ route('clients.edit',$client->id)}}"><i class="fas fa-edit mr-2"></i></a>
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $client->id }}">
						<i class="fas fa-trash mr-2"></i>
					</button>

					<div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<h5>Voulez vous supprimer: <strong>{{ $client->nom }} {{ $client->prenom }}</strong>  ?</h5>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<form action="{{route('clients.destroy',$client->id)}}" method="POST">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger">Supprimer</button>
									</form>
							</div>
							</div>
						</div>
					</div>

				</td>
			</tr>
		</tbody>
        @endforeach
	</table>
	</div>
	</div>
  
    {!! $clients->links() !!}
      
@endsection
   
