@extends('reparations.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>  Reparation</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="/reparations" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date d'entrée:</strong>
                {{ $reparation->element_1 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date de sortie:</strong>
                {{ $reparation->element_2 }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Compte Rendu:</strong>
                {{ $reparation->element_3 }}
            </div>
        </div>
       

        <a href="/reparations/{{$reparation->id }}/edit" title="Modifier">
                            <i class="fas fa-edit  fa-lg"></i>Modifier

                        </a>                        
    </div>
@endsection