@extends('layout.index')
@section('content')




@include('voitures._partials.carinformation')


	@can('create', App\Models\Intervention::class)
    <div class="row">
	
		<div class="col-lg-12 mt-4">
			
			<div class="pull-right">
				<a class="btn btn-secondary" href="{{route('voitures.interventions.create',['voiture' => $voiture->id])}}">
					<i class="fas fa-plus"></i> Ajouter une intervention
				</a>
			</div>
		</div>
	</div>
	@endcan
	<br>

	@if($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{$message}}</p>
		</div>
	@endif
    <!--liste voiture--->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
        <div class="col-xs-12 col-sm-12 col-md-12 "><br>
          
            <div class="card">
                <!--<div class="card-header">
                    <h3 class="mb-0 text-center">La Liste de clients</h3>
                    {{-- <p>This example shows FixedHeader being styled by the Bootstrap 4 CSS framework.</p> --}}
                </div>-->
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example4" class="table  table-striped table-bordered" style="width:100%">
						<thead class="" style="background-color: #4656E9;">
							<tr>
								<th style="color: white;">Type</th>
								<th style="color: white;">Début</th>
								<th style="color: white;">Fin</th>
								@can('create', App\Models\Intervention::class)
								<th style="color: white;">Action</th>
								@endcan
							</tr>
						</thead>
						<tbody>
				@foreach ($interventions as $intervention)
					<tr>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;"><i class="fas fa-cog"></i> {{ $intervention->type }}</td>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->debut }}</td>
						<td onclick="showIntervention({{ $intervention->voiture_id }} , {{ $intervention->id }})" style="cursor: pointer;">{{ $intervention->fin }}</td>
						@can('update', $intervention)
						<td>
							<a class="btn btn-primary  p-0 pr-2 pl-2" href="{{route('voitures.interventions.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id])}}"><i class="fas fa-edit"></i></a>
							@if (!($intervention->diagnostic_id ||  $intervention->devis_id || $intervention->summary_id))
								<button type="button" class="btn btn-danger  p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $intervention->id }}">
									<i class="fas fa-trash"></i>
								</button>
							@endif
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
	<br>
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