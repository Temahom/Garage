@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="color: #2EC551">Voiture</h2>
            </div>
        </div>
	</div>

<style>
	a:hover{
		color: #21AE41;
	}
</style>

	<table>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Proprietaire:</label>
            </td>
            <td>
                <a style="font-size: 20px;" href="{{ route('clients.show', ['client' => $voiture->client_id] ) }}">&nbsp&nbsp&nbsp{{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}</a>
            </td>
        </tr>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Matricule:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $voiture->matricule }}</label>
			</td>
			
			<td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Année:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $voiture->annee }}</label>
			</td>
			
        </tr>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Marque:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $voiture->marque }}</label>
			</td>
			<td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Carburant:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $voiture->carburant }}</label>
            </td>
		</tr>
		<tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Model:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $voiture->model }}</label>
			</td>
			<td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Puissance:</label>
            </td>
            <td>
                <label style="font-size: 20px;">&nbsp&nbsp&nbsp{{ $voiture->puissance }}</label>
            </td>
		</tr>
	</table>
	<br><br>
	
    <div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Toutes les interventions</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-primary" href="{{route('voitures.interventions.create',['voiture' => $voiture->id])}}">Ajouter une intervention</a>
			</div>
		</div>
	</div>
	<br>

	@if($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{$message}}</p>
		</div>
	@endif
    <!--liste voiture--->
	<div class="row">
		<div class="col-md-12 margin-tb">
			<table class="table table-striped table-hover col-md-12">
				<thead class="thead-dark">
					<tr>
						<th>Id</th>
						<th>Début</th>
						<th>Fin</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($interventions as $intervention)
					<tr>
						<td>{{ $intervention->id }}</td>
						<td>{{ $intervention->debut }}</td>
						<td>{{ $intervention->fin }}</td>
						<td style="text-transform: capitalize;">{{ $intervention->type }}</td>
						<td>
							<a class="btn btn-success" href="{{route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id])}}"><i class="fas fa-eye mr-2"></i></a>
							<a class="btn btn-primary" href="{{route('voitures.interventions.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id])}}"><i class="fas fa-edit mr-2"></i></a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $intervention->id }}">
								<i class="fas fa-trash mr-2"></i>
							</button>

							<div class="modal fade" id="exampleModal{{ $intervention->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<h5>Voulez vous supprimer  cette intervention</h5>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
											<form action="{{route('voitures.interventions.destroy',['voiture' => $voiture->id, 'intervention' => $intervention->id])}}" method="POST">
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
	<br>

	<div class="pull-right">
		<a class="btn btn-secondary" href="{{ route('voitures.index') }}">Retour</a>
	</div>
    
@endsection