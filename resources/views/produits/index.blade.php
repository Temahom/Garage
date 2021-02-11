@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
@endphp
@section('content')
<div class="row" >
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Les Produits </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('produits.create') }}" title="Crear un produit"> <i class="fas fa-plus-circle"></i>
                  Ajouter Un Produit </a>
            </div>
     
    <div class="d-flex" style="width: 100%">
     <div class="mx-auto">
        <form action="{{ route('produits.index') }}" method="GET" role="search">

            <div class="d-flex">

                <button class="btn btn-info t" type="submit" title="recherche un produit">
                    <span class="fas fa-search"></span>
                </button>
                <input type="text" class="form-control mr-2" name="term" placeholder="Rechercher un produit" id="term">
                <a href="{{ route('produits.index') }}" class="">
                    <button class="btn btn-danger" type="button" title="Actualiser page">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>  

</div>
</div><br><br>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif



<table class="table table-bordered table-responsive-lg">

        <tr>
            <th>N°</th>
            <th>Catégorie</th>
            <th>Nom Produit</th>
            <th>Le Prix Unitaire</th>
            <th>Quantité</th>
      <!--  <th scope="col">Date d'Ajout</th>    -->
            <th width="280px" text-align="center">Action</th>
        </tr>
    <tbody>

        @foreach ($produits as $produit)
        <tr>
            <td>{{ ++$i }}</td>
            <td onclick="showProduit({{ $produit->id }})">{{ $produit->categorie }}</td>
            <td>{{ $produit->produit }}</td>
            <td>{{number_format($produit->prix1 ,0, ",", " " )}} <sup>F CFA</sup> </td>
            <td>{{ $produit->qte }}</td>
        <!--<td style="text-transform:capitalize;"> {{strftime("%A %d %B %Y", strtotime($produit->created_at))}}</td> -->
            <td>

           <!--    <a href="{{ route('produits.show', $produit->id) }}" title="show">  
                    <i class="fas fa-eye text-success  fa-lg"></i>    -->
            
               <button type="button" class="btn btn-succes p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $produit->id }}">
                <i class="fas fa-eye text-success  fa-lg"></i>
            </button>

                    <div class="modal fade" id="exampleModal{{ $produit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body ">
                                    <div style="font-size: 20px; ">Produit : <a href="{{route('produits.index',['produit'=>$produit->id])}}" style="color: #2EC551">{{ $produit->produit}} </a></div>
                                    <div style="font-size: 14px; ">Catégorie  : <a href="{{route('produits.index',['produit'=>$produit->id])}}" style="color: #750439">{{ $produit->categorie}} </a></div>
                                    <div style="font-size: 14px;" >Prix Unitaire  : <a href="" class="badge badge-success"> {{ $produit->prix1}} <sup>F CFA</sup> </a> </div>
                                    <div style="font-size: 14px;">Quantité Produit  : <a href="" style="color: #17028a">{{ $produit->qte}} </a> </div>                    
                                </div>
                                <div class="modal-footer">
                            </div>
                            </div>
                        </div>
                    </div>

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
 </div>
</div>



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
<script>
    function showProduit(id)
    {
        window.location = 'produits/' + id ;
    }
</script>



@endsection