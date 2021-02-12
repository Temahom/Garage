@extends('layout.index')
   
@section('content')

<div class="row ml-1">
	<div class="col-md-7 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
		<div class="row" style="text-align: center">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2>Diagnostique</h2>
				</div>
			</div>
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

				<div style="font-size: 14px;"> {{ $voiture->marque}} {{ $voiture->model}} {{ $voiture->annee}}</div>
				<div style="font-size: 14px;"> {{ $voiture->carburant}}</div>
				<div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux</div>
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
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Modifier diagnostic</h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Attention!</strong> veillez remplir tous les champs<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('voitures.interventions.diagnostics.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'diagnostic' => $diagnostic->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Locaisation de la panne:</strong>
                <input type="text" name="nom" class="form-control" value="{{ $diagnostic->title }}" placeholder="Nom">
            </div>
            
            <div class="form-group">
                <strong>Appréciation:</strong>
                <input type="text" name="prenom" class="form-control" value="{{ $diagnostic->description }}" placeholder="Prenoms" >
            </div>
            
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
            <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}"><i class="fas fa-angle-left"></i> Retour</a>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>

    </div>
</form>
@endsection