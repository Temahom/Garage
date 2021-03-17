@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifiez L'intervention</h2>
            </div>
        </div>
    </div>

    
    <form action="{{route('voitures.interventions.update',['voiture' => $voiture->id , 'intervention' => $intervention->id] )}}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 row">
                <div class="form-group col-xs-8 col-sm-8 col-md-8">
                    <strong>Type intervention:</strong>
                    <select name="type" class="form-control @error('type') is-invalid @enderror">
                        @if($intervention->type=="Entretien")
                      <option style="text-transform: capitalize !important;" value="{{$intervention->type}}" >
                        {{$intervention->type}}</option>
                        <option value="Réparation">Réparation</option>
                        @else
                        <option style="text-transform: capitalize !important;" value="{{$intervention->type}}" >
                        {{$intervention->type}}</option>
                      <option value="Entretien">Entretien</option>
                      @endif
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
                    <input type="date" name="debut" class="form-control @error('debut') is-invalid @enderror" value="{{ old('debut') }} {{$intervention->debut}}">
					<div class="invalid-feedback">
						@if($errors->has('debut'))
						{{ $errors->first('debut') }}
						@endif
					</div>
                </div>
                 <div class="form-group col-xs-4 col-sm-4 col-md-4">
                    <strong>Fin</strong>
                    <input type="date" name="fin" value="{{ old('fin') }} {{$intervention->fin}}" class="form-control">
                </div>
            </div>
			<div class="col-xs-8 col-sm-8 col-md-8 row">
                <div class="form-group col-xs-8 col-sm-8 col-md-8">
                    <strong>Chef d'Operation</strong>
                    <select name="technicien" class="form-control @error('technicien') is-invalid @enderror">
						<option value="">Assigné un technicien...</option>
						@foreach ($techniciens as $technicien)
                            <option value="{{$technicien->id}}" {{ $technicien->id == $intervention->technicien ? 'selected' : '' }}>
                                {{$technicien->name}} ({{$technicien->role()->first()->role}})
                            </option>
						@endforeach
                    </select>
					<div class="invalid-feedback">
						@if($errors->has('technicien'))
						{{ $errors->first('technicien') }}
						@endif
					</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <a class="btn btn-secondary" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}"><i class="fas fa-angle-left"></i> Retour</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>

    </form>

@endsection