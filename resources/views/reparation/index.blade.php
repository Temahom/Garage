
@extends('reparation.layout')

@section('content')


<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tableau de Réparation </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('reparation/create') }}" title="Enregistrer une réparation"> <i class="fas fa-plus-circle"></i>
                    Ajouter</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Date d'entrée</th>
            <th>Date de sortie</th>
            <th>Compte Rendu</th>
            <th width="270px">Action</th>
        </tr>
        @foreach ($reparation as $reparation)
            <tr>
                <td>{{ $reparation->id }}</td>
                <td>{{ $reparation->element_1 }}</td>
                <td>{{ $reparation->element_2 }}</td>
                <td>{{ $reparation->element_3}}</td>
                <td>
                    <form action="{{ url('reparation', $reparation->id) }}" method="POST">

                        <a href="{{ url('reparation', $reparation->id) }}" title="Voir">
                            <i class="fas fa-eye text-success  fa-lg"></i>Voir
                        </a>

                        <a href="{{ route('reparation.edit', $reparation->id) }}" title="Modifier">
                            <i class="fas fa-edit  fa-lg"></i>Modifier

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="Supprimer" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>Supprimer

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>





@endsection
