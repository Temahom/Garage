@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
@endphp
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
 
<div>  
</div>
  
<!--    <div class="d-flex">
        <div class="mx-auto">
    <form class="form-inline my-2 my-lg-0" action="/produits/index" methode="GET">
    <input class="form-control mr-sm-2" name="query"  type="search" placeholder="Rechercher Produit">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">REchercher</button>
    </form>
    </div>
    </div>  -->
    
  <div class="d-flex">
    <div class="mx-auto">
        <form action="{{ route('produits.index') }}" method="GET" role="search">

            <div class="d-flex">

                <button class="btn btn-info t" type="submit" title="recherche produits">
                    <span class="fas fa-search"></span>
                </button>
                <input type="text" class="form-control mr-2" name="term" placeholder="Rechercher produits" id="term">
                <a href="{{ route('produits.index') }}" class="">
                    <button class="btn btn-danger" type="button" title="Actualiser page">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>  

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered  table-hover">
    <thead class="thead">
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Nom Produit</th>
            <th scope="col">Le Prix</th>
            <th scope="col">Prix</th>
            <th scope="col">Quantité</th>
      <!--  <th scope="col">Date d'Ajout</th>    -->
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($produits as $produit)
        <tr>
            <td scope="row">{{ ++$i }}</td>
            <td>{{ $produit->categorie }}</td>
            <td>{{ $produit->produit }}</td>
            <td>{{ $produit->prix1 }}</td>
            <td>{{number_format($produit->prix ,0, ",", " " )}}  <sup>F CFA</sup></td>
            <td>{{ $produit->qte }}</td>
        <!--<td style="text-transform:capitalize;"> {{strftime("%A %d %B %Y", strtotime($produit->created_at))}}</td> -->
            <td>

                <a href="{{ route('produits.show', $produit->id) }}" title="show">
                    <i class="fas fa-eye text-success  fa-lg"></i>
                </a>

                <a href="{{ route('produits.edit', $produit->id) }}">
                    <i class="fas fa-edit  fa-lg"></i>

                </a>
                <a data-toggle="modal" id="smallButton{{$produit->id}}" data-target="#smallModal{{$produit->id}}" data-attr="{{ route('produits.destroy', $produit->id) }}" title="Supprimer Produit">
                    <i class="fas fa-trash text-danger  fa-lg"></i>
                </a>
  <!-- small modal -->
         <div class="modal fade" id="smallModal{{$produit->id}}" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here    <form action="/produits/{{$produit->id}}" method="POST"> --> 
                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <h5 class="text-center">Etes-vous sûr que vous voulez supprimer le Produit :{{ $produit->produit }} ? </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  title="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit"  title="delete" class="btn btn-danger">Oui,Supprimer</button>
                    </div>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>
 </div>

    </td>
        </tr>
        @endforeach
    </tbody>

</table>

{!! $produits->links() !!}



<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    }); 

</script>

@endsection