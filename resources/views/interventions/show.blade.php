@extends('layout.index')

@section('content')
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white ">
        <div class="col-md-6 p-3">
            <p><h2>Debut</h2>{{ $intervention->debut }}</p>
        </div>
        <div class="col-md-6 p-3">
            <p><h2>Fin</h2>{{ $intervention->fin }}</p>
        </div>
    </div>
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
        <div class="col-md-6 p-3">
            <p><h2>Diagnostic</h2></p>
            @if ( $intervention->diagnostic_id )
                <p>{{ $diagnostic->description }}</p>
                <a class="btn btn-success" href="{{ route('voitures.interventions.diagnostics.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'diagnostic' => $intervention->diagnostic_id]) }}" title="Go back">Modifier</a>
            @else
                <a class="btn btn-success" href="{{ route('voitures.interventions.diagnostics.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back">Ajouter</a>
            @endif
        </div>
    </div>
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
        <div class="col-md-6 p-3">
            <p><h2>Devis</h2></p>
            @if ( $intervention->devis_id )
                <p>{{ $devi->cout }}</p>
                
                <a class="btn btn-success" href="{{ route('voitures.interventions.devis.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'devi' => $intervention->devis_id]) }}" title="Go back">Modifier</a>
            @else
                <a class="btn btn-success" href="{{ route('voitures.interventions.devis.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back">Ajouter</a>
            @endif
        </div>
    </div>
    <div class="row" style="border: 1px solid #aaa; width: 100%; background-color: white; margin-top: 20px ">
        <div class="col-md-6 p-3">
            <p><h2>Maintenance/Réparation</h2></p>
            @if ( $intervention->reparation_id )
                <p>{{ $reparation->element_3 }}</p>
                <a class="btn btn-success" href="{{ route('voitures.interventions.reparations.edit',['voiture' => $voiture->id, 'intervention' => $intervention->id, 'reparation' => $intervention->reparation_id]) }}" title="Go back">Modifier</a>
            @else
                <a class="btn btn-success" href="{{ route('voitures.interventions.reparations.create',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back">Ajouter</a>
            @endif
        </div>
    </div>
    <div class="row">
        <a class="btn btn-primary mt-3" href="{{ route('voitures.show',['voiture' => $voiture->id]) }}" title="Go back">Retour</a>
    </div>
    @endsection