@extends('reparations.layout')

@section('content')

@include('voitures._partials.carinfosup')


<br><br>


<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8">
		<h2>Maintenance / Réparation</h2>
	</div>
	<div class="col-xs-8 col-sm-8 col-md-8 row">
		<div class="form-group col-xs-8 col-sm-8 col-md-8">
			<form action="{{ route('voitures.interventions.reparations.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST" >
				@csrf
				<input type="hidden" name="intervention_id" value="{{ $intervention->id }}">
				<div class="row">					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Compte Rendu:</strong>
							<textarea type="LongText" name="element_3" class="form-control @error('element_3') is-invalid @enderror" placeholder="" autofocus></textarea>
							<div class="invalid-feedback">
								@if($errors->has('element_3'))
								  Le champs est obligatoire.
								@endif
							</div>
						</div>
					</div>					
					<div class="col-xs-12 col-sm-12 col-md-12 mt-3">
						<a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
						<button type="submit" class="btn btn-success">Enregistrer</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection