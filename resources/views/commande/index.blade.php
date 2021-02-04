@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Commande </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('commandes.create') }}" title="Create a project"> <i class="fas fa-plus-circle"> Ajouter une nouvelle commande</i>
                    </a>
            </div>
        </div>
    </div><br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Catégorie du Produit</th>
            <th>Nom du Produit</th>
            <th>Quantité de Produit</th>
            <th width="280px" text-align="center">Action</th>
        </tr>
        @foreach ($commandes as $commande)
            <tr>
                <td>{{ $commande->id }}</td>
                <td>{{ $commande->catProduit }}</td>
                <td>{{ $commande->nomProduit}}</td>
                <td>{{ $commande->qteProduit }}</td>
                <td>
                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST">

                        <a href="{{ route('commandes.show', $commande->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>Afficher
                        </a>
                        <a href="{{ route('commandes.edit', $commande->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>Modifier
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>Supprimer
                        </button>                    
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $commandes->links() !!}

@endsection
