@extends('reparations.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier le réparation</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('voitures.interventions.reparations.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'reparation' => $reparation->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date d'entrée:</strong>
                    <input type="date" name="element_1" value="{{$reparation->element_1}}" class="form-control" placeholder="date d'entree">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date de sortie:</strong>
                    <input type="date" name="element_2" value="{{$reparation->element_2}}" class="form-control" placeholder="date de sortie">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Compte Rendu:</strong>
                    <input type="LongText" name="element_3" value="{{$reparation->element_3}}" class="form-control" placeholder="Donner votre conclusion">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Editer</button>
            </div>
        </div>

    </form>
@endsection