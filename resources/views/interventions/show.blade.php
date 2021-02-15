@extends('layout.index')

@section('content')
<div class="row">
	<div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">

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

				<div style="font-size: 14px;"> {{ $voiture->marque}} - {{ $voiture->model}} - {{ $voiture->annee}}</div>
				<div style="font-size: 14px;"> {{ $voiture->transmission}} - {{ $voiture->carburant}}</div>			
				<div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux - {{ $voiture->kilometrage}} km</div>		
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

		<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
			<div class="col-md-6 p-3">
					<h2>Debut</h2>{{ $intervention->debut }}
			</div>
			<div class="col-md-3 p-3">
				<h2>Fin</h2>{{ $intervention->fin }}
			</div>
		</div>

<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
    <div class="col-md-6 p-3">
        <p><h2>Diagnostic</h2></p>
        @if ( $intervention->diagnostic_id )
            <p>{{ $diagnostic->description }}</p>
            <a class="btn btn-warning" href="{{ route('voitures.interventions.diagnostics.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'diagnostic' => $intervention->diagnostic_id]) }}" title="Modifier">Modifier</a>
        @else
            <a class="btn btn-primary" href="{{ route('voitures.interventions.diagnostics.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Ajouter">Ajouter</a>
        @endif
    </div>
</div>

<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
    <div class="col-md-6 p-3">
        <p><h2>Devis</h2></p>
        @if ( $intervention->devis_id )
            <p>{{number_format($devi->cout,0, ",", " " )}} <sup>F CFA</sup></p>
            <a class="btn btn-warning" href="{{ route('voitures.interventions.devis.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'devi' => $intervention->devis_id]) }}" title="Modifier">Modifier</a>
        @else
            <a class="btn btn-primary" href="{{ route('voitures.interventions.devis.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Ajouter">Ajouter</a>
        @endif
    </div>
</div>
<div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
    <div class="col-md-6 p-3">
        <p><h2>Maintenance/Réparation</h2></p>
        @if ( $intervention->reparation_id )
            <p>{{ $reparation->element_3 }}</p>
            <a class="btn btn-warning" href="{{ route('voitures.interventions.reparations.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'reparation' => $intervention->reparation_id]) }}" title="Go back">Modifier</a>
        @else
            <a class="btn btn-primary" href="{{ route('voitures.interventions.reparations.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back">Ajouter</a>
        @endif
    </div>
</div>
<div class="row">
    <a class="btn btn-secondary mt-3" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}" title="Go back"><i class="fas fa-angle-left"></i>  Retour</a>
</div>
    @endsection