@extends('layout.index')

@section('content')

<style>
	.row{
		overflow: hidden;
	}
</style>

@include('voiture._partials.carinformation')
    
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