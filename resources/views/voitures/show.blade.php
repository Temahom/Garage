@extends('layout.index')
@section('content')




<div class="row ml-1">
	<div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
		<div class="pull-left" style="text-align: center">
			<h2>Liste des interventions sur</h2>
		</div>
		<div class="row">

			<div class="col-md-2 col-sm-3 text-center pt-4">
				<img style="height: 50px;width: auto;" class="" src="/assets/images/car.png" alt="logo">
			</div>

			<div class="col-md-10 col-sm-10">

				<div style="font-size: 20px">
					<a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" style="color: #2EC551">
						{{ $voiture->matricule }}
					</a>
					<span style="font-size: 12px;">
						( De<a href="{{route('clients.show',['client'=>$voiture->client_id])}}" style="color: #2EC551">
							<i class="fas fa-user"></i>
							{{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}
						</a>)
					</span>

				</div>

				<div style="font-size: 14px;"> <i class="fas fa-hotel"></i> {{ $voiture->marque}} - {{ $voiture->model}} - {{ $voiture->annee}}</div>
				<div style="font-size: 14px;"> {{ $voiture->transmission}} <i class="fas fa-burn"></i> {{ $voiture->carburant}}</div>			
				<div style="font-size: 14px;"> <i class="fas fa-bolt"></i> {{ $voiture->puissance}} cheveaux    <i class="fab fa-algolia"></i> {{ $voiture->kilometrage}} km</div>		
				<div class="text-right" style="font-size: 12px;">
					<a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
					<button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
						Supprimer
					</button>
					<div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-body">
									<h5>Voulez vous supprimer: <strong>{{ $voiture->matricule }}</strong>  ?</h5>
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
					</div>	
				</div>

			</div>

		</div>
	</div>
</div>


	
    <div class="row">
	
		<div class="col-lg-12 mt-4">
			
			<div class="pull-right">
				<a class="btn btn-secondary" href="{{route('voitures.interventions.create',['voiture' => $voiture->id])}}">
					<i class="fas fa-plus"></i> Nouvelle intervention
				</a>
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
		<div class="col-xs-12 col-sm-12 col-md-12 row"><br>
          
            <table class="table table-striped table-hover col-md-12">
				<thead class="" style="background-color: #4656E9;">
					<tr>
						<th style="color: white;">Type</th>
						<th style="color: white;">Début</th>
						<th style="color: white;">Fin</th>
						<th style="color: white;">Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($interventions as $intervention)
					<tr>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;"><i class="fas fa-cog"></i> {{ $intervention->type }}</td>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->debut }}</td>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->fin }}</td>
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
<div class="row">
	<div class="col-md-12 mt-3 ml-3">
		<a class="btn btn-secondary" href="{{ route('clients.show', ['client' => $voiture->client_id]) }}"><i class="fas fa-angle-left"></i> Retour</a>
	</div>
</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script>
		function showIntervention(voiture_id, intervention_id)
		{
			window.location = voiture_id + '/interventions/' + intervention_id ;
		}
	</script>
      
@endsection