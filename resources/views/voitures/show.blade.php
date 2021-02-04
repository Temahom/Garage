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
		color: #2142ae;
	}
</style>

	<table>
        <tr>
            <td>
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Proprietaire:</label>
            </td>
            <td>
                <a style="font-size: 20px;color:#81A3D4;" href="{{ route('clients.show', ['client' => $voiture->client_id] ) }}">&nbsp&nbsp&nbsp{{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}</a>
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
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Année:</label>
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
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Carburant:</label>
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
                <label style="font-size: 20px; font-weight:bold;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Puissance:</label>
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
				<a class="btn btn-secondary" href="{{route('voitures.interventions.create',['voiture' => $voiture->id])}}">Nouvelle intervention</a>
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
		<div class="col-md-12 col-lg-11 margin-tb">
			<table class="table table-striped table-hover col-md-12">
				<thead class="" style="background-color: #4656E9;">
					<tr>
						<th style="color: white;">Début</th>
						<th style="color: white;">Fin</th>
						<th style="color: white;">Type</th>
						<th style="color: white;">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($interventions as $intervention)
					<tr>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->debut }}</td>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->fin }}</td>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->type }}</td>
						<td>
							<a class="btn btn-primary  p-0 pr-2 pl-2" href="{{route('voitures.interventions.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id])}}"><i class="fas fa-edit"></i></a>
							<button type="button" class="btn btn-danger  p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $intervention->id }}">
								<i class="fas fa-trash"></i>
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
</div>
</div>
<div class="row">
	<div class="col-md-12 mt-3 d-flex justify-content-center">
		{!! $interventions->render() !!}
	</div>
</div>

	<div class="pull-right">
		<a class="btn btn-secondary" href="{{ route('clients.show', ['client' => $voiture->client_id]) }}">Retour</a>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script>
		function showIntervention(voiture_id, intervention_id)
		{
			window.location = voiture_id + '/interventions/' + intervention_id ;
		}
	</script>
      
@endsection