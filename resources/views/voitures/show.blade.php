@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Voiture</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('voitures.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Matricule:</strong>
                {{ $voiture->matricule }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Marque:</strong>
                {{ $voiture->marque }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Modele:</strong>
                {{ $voiture->model }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Annee:</strong>
                {{ $voiture->annee }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Carburant:</strong>
                {{ $voiture->carburant }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Puissance:</strong>
                {{ $voiture->puissance}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>proprietaire:</strong>
                {{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}
            </div>
        </div>
        
    </div>

    <div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>Toutes les interventions</h2>
			</div>
			<div class="pull-right">
				<a class="btn btn-success" href="{{route('voitures.interventions.create',['voiture' => $voiture->id])}}">Ajouter une intervention</a>
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
  
    
@endsection