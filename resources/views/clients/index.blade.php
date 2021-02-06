@extends('layout.index')

@section('content')
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Tous les Clients</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-secondary" href="{{route('clients.create')}}">Nouveau Client</a>
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
	<div class="col-md-12 col-lg-11">
	<table class="table table-striped table-hover">
		<thead class="" style="background-color: #4656E9;">
			<tr>
				<th style="color: white;">Prénoms</th>
				<th style="color: white;">Genre</th>
				<th style="color: white;">Entreprise</th>
				<th style="color: white;">Téléphone</th>
				<th style="color: white;">Email</th>
				<th style="color: white;">Action</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($clients as $client)
		
			<tr>
				<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;"><i class="fas fa-user"></i> {{ $client->prenom }} {{ $client->nom }}</td>
				<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $client->genre }}</td>
				<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $client->entreprise }}</td>
				<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $client->telephone }}</td>
				<td onclick="showClient({{ $client->id }})" style="cursor: pointer;">{{ $client->email }}</td>
				<td>
					<a class="btn btn-primary p-0 pr-2 pl-2" href="{{ route('clients.edit',$client->id)}}"><i class="fas fa-edit"></i></a>
					<button type="button" class="btn btn-danger p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $client->id }}">
						<i class="fas fa-trash"></i>
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
		
		@endforeach
		</tbody>
	</table>
	</div>
	</div>
	<div class="row">
		<div class="col-md-12 mt-3 d-flex justify-content-center">
			{!! $clients->links() !!}
		</div>
	</div>
	
	


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showClient(id)
		{
			window.location = 'clients/' + id ;
		}
	</script>
      
@endsection
   
