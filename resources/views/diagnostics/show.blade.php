@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Diagnostic</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('diagnostics.index') }}">Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Localisation de la panne:</strong>
                {{ $diagnostic->title }}
            </div>
            <div class="form-group">
                <strong>Appréciation:</strong>
                {{ $diagnostic->description }}
            </div>
        </div>
    </div>
    
@endsection