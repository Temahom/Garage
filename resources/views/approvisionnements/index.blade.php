@extends('layout.index')
  
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Approvisionnement</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('approvisionnements.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
                </a>
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
        <th>N°</th>
        <th>Fournisseur</th>
        <th>Nom du Produit</th>
        <th>Quantité Totale</th>
        <th>Prix Total</th>
        <th>Date d'entée</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($approvisionnements as $approvisionnement)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $approvisionnement->fournisseur }}</td>
            <td>{{ $approvisionnement->nomProduit }}</td>
            <td>{{ $approvisionnement->qteTotale }}</td>
            <td>{{ $approvisionnement->prixTotal }}</td>
            <td>{{ date_format($approvisionnement->created_at, 'jS M Y') }}</td>
            <td>
                <form action="{{ route('approvisionnements.destroy', $approvisionnement->id) }}" method="POST">

                    <a href="{{ route('approvisionnements.show', $approvisionnement->id) }}" title="show">
                        <i class="fas fa-eye text-success  fa-lg"></i>
                    </a>

                    <a href="{{ route('approvisionnements.edit', $project->id) }}">
                        <i class="fas fa-edit  fa-lg"></i>

                    </a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" title="delete" style="border: none; background-color:transparent;">
                        <i class="fas fa-trash fa-lg text-danger"></i>

                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{!! $approvisionnements->links() !!}

@endsection