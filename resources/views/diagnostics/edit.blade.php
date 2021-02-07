@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier mon diagnostic</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Attention</strong>Veuillez vérifier vos saisies<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>   
    @endif

    <form action="{{ route('voitures.interventions.diagnostics.update',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'diagnostic' => $diagnostic->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Localisation de la panne:</strong>
                    <input class="form-control" style="height:280px" name="description" rows="30" placeholder="Entrer les observation issus du diagnostic"> {{ isset($diagnostic) ? $diagnostic->title :''}} />
                </div>
                <div class="form-group">
                    <strong>Appréciation:</strong>
                    <input class="form-control" style="height:280px" name="description" rows="30" placeholder="Entrer les observation issus du diagnostic"> {{ isset($diagnostic) ? $diagnostic->description :''}} />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </div>

    </form>
    
@endsection