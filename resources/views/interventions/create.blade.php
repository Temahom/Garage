@extends('layout.index')

@section('content')

<style>
	.row{
		overflow: hidden;
	}
</style>

<div class="row ml-1">
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
				@can('update', $voiture)
				<div class="text-right" style="font-size: 12px;">
					<a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
					<button type="button" class="text-danger hide_delete" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
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
				@endcan

			</div>

		</div>
	</div>
</div>
    
<br>
    <form action="{{route('voitures.interventions.store',['voiture' => $voiture->id])}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 row">
                <div class="form-group col-xs-8 col-sm-8 col-md-8">
                    <strong>Type intervention:</strong>
                    <select name="type" class="form-control @error('type') is-invalid @enderror">
						<option value="">Choisir le type intervention...</option>
                        <option value="Entretien" {{ old('type') == 'Entretien' ? 'selected' : '' }}>Entretien</option>
                        <option value="Reparation" {{ old('type') == 'Reparation' ? 'selected' : '' }}>Réparation</option>
                    </select>
					<div class="invalid-feedback">
						@if($errors->has('type'))
						{{ $errors->first('type') }}
						@endif
					</div>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 row">
                <div class="form-group col-xs-4 col-sm-4 col-md-4">
                    <strong>Début:</strong>
                    <input type="date" name="debut" class="form-control @error('debut') is-invalid @enderror" value="{{ old('debut') }}">
					<div class="invalid-feedback">
						@if($errors->has('debut'))
						{{ $errors->first('debut') }}
						@endif
					</div>
                </div>
                 <div class="form-group col-xs-4 col-sm-4 col-md-4">
                    <strong>Fin</strong>
                    <input type="date" name="fin" value="{{ old('fin') }}" class="form-control">
                </div>
            </div>
			<div class="col-xs-8 col-sm-8 col-md-8 row">
                <div class="form-group col-xs-8 col-sm-8 col-md-8">
                    <strong>Chef d'Operation</strong>
                    <select name="technicien" class="form-control @error('technicien') is-invalid @enderror">
						<option value="">Assigné un technicien...</option>
						@foreach ($techniciens as $technicien)
						<option value="{{$technicien->id}}">{{$technicien->name}} ({{$technicien->role()->first()->role}}) </span></option>
						@endforeach
                    </select>
					<div class="invalid-feedback">
						@if($errors->has('technicien'))
						{{ $errors->first('technicien') }}
						@endif
					</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                    <a class="btn btn-secondary" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}"><i class="fas fa-angle-left"></i> Retour</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>
    </form>
	
@endsection