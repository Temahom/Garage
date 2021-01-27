@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Les Produits </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('produits.create') }}" title="Crear un produit"> <i class="fas fa-plus-circle"></i>
                  Ajouter Un Produit </a>
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
            <th>Libellé</th>
            <th>prix</th>
            <th>Quanté</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($produits as $produit)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $produit->libelle }}</td>
                <td>{{ $produit->prix }}</td>
                <td>{{ $produit->qte }}</td>
                <td>
                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">

                        <a href="{{ route('produits.show', $produit->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('produits.edit', $produit->id) }}">
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
    
    {!! $produits->links() !!}

@endsection

