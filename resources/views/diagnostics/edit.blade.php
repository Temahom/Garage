@extends('layout.index')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier diagnostic</h2>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Attention!</strong> veillez remplir tous les champs<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('diagnostics.update',$diagnostic->id) }}" method="POST">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Locaisation de la panne:</strong>
                    <input type="text" name="nom" class="form-control" value="{{ $diagnostic->title }}" placeholder="Nom">
                </div>
                
                <div class="form-group">
                    <strong>Appréciation:</strong>
                    <input type="text" name="prenom" class="form-control" value="{{ $diagnostic->description }}" placeholder="Prenoms" >
                </div>
                
                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                <a class="btn btn-secondary" href="{{ route('diagnostics.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>

        </div>
    </form>
@endsection