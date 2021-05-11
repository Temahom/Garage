@extends('layout.menu')

@section('content')

@php
setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
@endphp
<style>
    .titre{
            background-image: linear-gradient(to left, #268956, #332F30);
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
                    <span class="titre"><i class="fas fa-list-ul label"></i>Liste des Fournisseurs</span>
                </h2>
            </div>
        </div>
    </div>
</div>
<br>
@if($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{$message}}</p>
	</div>
@endif
@can('create', App\Models\Client::class)
	<div class="pull-right" style="margin-bottom:5px">
		<a class="btn btn-rounded btn-dark" href="{{route('fournisseurs.create')}}" title="Ajouter fournisseur" style="margin-top: 5px"> 
			<i class="fas fa-plus-circle"> Ajouter</i>
		</a>
	</div>
@endcan


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xs-12 col-sm-12 col-md-12 "><br>
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="example4" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr style="background-color: #006680;">
									<th style="color: white">Prénoms</th>
									<th style="color: white">NOM</th>
									<th style="color: white">Genre</th>
									<th style="color: white">Entreprise</th>
									<th style="color: white">Téléphone</th>
									<th style="color: white">Email</th>
									@can('create', App\Models\Client::class)
										<th style="color: white; text-align: center">Action</th>
									@endcan
								</tr>
							</thead>
							<tbody>
								@foreach ($fournisseurs as $fournisseur)

									<tr>
										<td onclick="showFournisseur({{ $fournisseur->id }})" style="cursor: pointer; text-transform: capitalize;"><i class="fas fa-user"></i> {{ $fournisseur->prenom }}</td>
										<td onclick="showFournisseur({{ $fournisseur->id }})" style="text-transform: uppercase;" style="cursor: pointer; text-transform: capitalize;">{{ $fournisseur->nom }}</td>
										<td onclick="showFournisseur({{ $fournisseur->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $fournisseur->genre }}</td>
										<td onclick="showFournisseur({{ $fournisseur->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $fournisseur->entreprise }}</td>
										<td onclick="showFournisseur({{ $fournisseur->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $fournisseur->telephone }}</td>
										<td onclick="showFournisseur({{ $fournisseur->id }})" style="cursor: pointer;">{{ $fournisseur->email }}</td>
										@can('create', App\Models\Client::class)
											<td style="text-align: center">
												<a class="btn btn-succes p-0 pr-2 pl-2" href="{{ route('fournisseurs.edit',$fournisseur->id)}}"><i class="fas fa-edit"></i></a>
												
												<button type="button" class="btn btn-danger p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $fournisseur->id }}" onclick="OnOff();">
													<i class="fas fa-trash"></i>
												</button>

												<div class="modal fade" id="exampleModal{{ $fournisseur->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-body">
																<h5>Voulez vous supprimer: <strong>{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</strong>  ?</h5>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
																<form action="{{route('fournisseurs.destroy',$fournisseur->id)}}" method="POST">
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
						</table>
					</div>
				</div>  
			</div>
		</div>
	</div>
</div>


	<div class="row">
		<div class="col-md-12 mt-3 d-flex justify-content-center">
			{!! $fournisseurs->links() !!}
		</div>
	</div>
	
	


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showFournisseur(id)
		{
			window.location = '/fournisseurs/' + id ;
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
   
