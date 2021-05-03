@extends('layout.index')

@section('content')

@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
@endphp
<style>
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
					<span class="titre"><i class="fas fa-list-ul label"></i>Listes des Clients</span>
				</h2>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
  	<div class="col-xs-12 col-sm-12 col-md-12 row">  
		<div class="col-lg-12 margin-tb">
			<div class="col-xs-12 col-sm-12 col-md-12 row">
				@can('create', App\Models\Client::class)
                <div class="col-xs-9 col-sm-9 col-md-9">     
                    <div class="form-group">
						<a class="btn btn-secondary" href="{{route('clients.create')}}"><i class="fas fa-user-plus"></i> Nouveau Client</a>
					</div>
				</div>
				@endcan
			<!--	<div class="col-xs-3 col-sm-3 col-md-3">     
					<div class="form-group">
						<form action="{{ route('clients.index') }}" method="GET" role="search">
							<div class="d-flex">
								<input type="text" class="form-control mr-2" name="term" placeholder="Rechercher ici " id="term" autocomplete="off">
								<button class="btn btn-info t" type="submit" title="recherche un client">
									<span class="fas fa-search"></span>
								</button>
							</div>
						</form><br>
					</div>
				</div> -->
			</div>

			@if($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{$message}}</p>
				</div>
			@endif
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<!--<div class="card-header">
							<h3 class="mb-0 text-center">La Liste de clients</h3>
							{{-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> --}}
						</div>-->
						<div class="card-body">
							<div class="table-responsive">
								<table id="example4" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr style="background-color: #4656E9;">
											<th style="color: white">Prénoms</th>
											<th style="color: white">NOM</th>
											<th style="color: white">Genre</th>
											<th style="color: white">Entreprise</th>
											<th style="color: white">Téléphone</th>
											<th style="color: white">Email</th>
											<th style="color: white">Periode Enregistrement</th>
											@can('create', App\Models\Client::class)
											<th style="color: white">Action</th>
											@endcan
										</tr>
									</thead>
									<tbody>
					@foreach ($clients as $client)
		
							<tr>
								<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;"><i class="fas fa-user"></i> {{ $client->prenom }}</td>
								<td onclick="showClient({{ $client->id }})" style="text-transform: uppercase;" style="cursor: pointer; text-transform: capitalize;">{{ $client->nom }}</td>
								<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $client->genre }}</td>
								<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $client->entreprise }}</td>
								<td onclick="showClient({{ $client->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $client->telephone }}</td>
								<td onclick="showClient({{ $client->id }})" style="cursor: pointer;">{{ $client->email }}</td>
								<td onclick="showClient({{ $client->id }})" style="cursor: pointer;text-transform: capitalize;">{{ strftime('%B %Y', strtotime($client->created_at)) }}</td>
								@can('create', App\Models\Client::class)
								<td>
									<a class="btn btn-primary p-0 pr-2 pl-2" href="{{ route('clients.edit',$client->id)}}"><i class="fas fa-edit"></i></a>
									
									<button type="button" class="btn btn-danger p-0 pr-2 pl-2 hide_delete" data-toggle="modal" data-target="#exampleModal{{ $client->id }}" onclick="OnOff();">
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
								@endcan
							</tr>
							@endforeach

									</tbody>
									{{-- <tfoot>
										<tr>
											<th >Prénoms</th>
											<th >Genre</th>
											<th>Entreprise</th>
											<th >Téléphone</th>
											<th >Email</th>
											<th >Action</th>
										</tr>
									</tfoot> --}}
								</table>
							</div>
						</div>
					</div>
				</div>  
			</div>
			
		</div>
	</div>
</div>
	
	


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showClient(id)
		{
			window.location = 'clients/' + id ;
		}
	</script>

<script>
/*
    const compare = (ids, asc) => (row1, row2) => {
        const tdValue = (row, ids) => row.children[ids].textContent;
        const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
        return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
    };
        const tbody = document.querySelector('tbody');
		const thx = document.querySelectorAll('th');
		const trxb = tbody.querySelectorAll('tr');

		thx.forEach(th => th.addEventListener('click', () => {
			let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
			classe.forEach(tr => tbody.appendChild(tr));
		}));
*/
</script>


@endsection
   
