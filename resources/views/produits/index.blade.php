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


<div class="row">
  <div >
<table class="table table-bordered  table-hover">
    <thead class="thead">
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Nom Produit</th>
            <th scope="col">Le Prix Unitaire</th>
            <th scope="col">Quantité</th>
      <!--  <th scope="col">Date d'Ajout</th>    -->
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($produits as $produit)
        <tr>
            <td scope="row">{{ ++$i }}</td>
            <td onclick="showProduit({{ $produit->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $produit->categorie }}</td>
            <td onclick="showProduit({{ $produit->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $produit->produit }}</td>
            <td onclick="showProduit({{ $produit->id }})" style="cursor: pointer; text-transform: capitalize;">{{number_format($produit->prix1 ,0, ",", " " )}} <sup>F CFA</sup> </td>
            <td onclick="showProduit({{ $produit->id }})" style="cursor: pointer; text-transform: capitalize;">{{ $produit->qte }}</td>
        <!--<td style="text-transform:capitalize;"> {{strftime("%A %d %B %Y", strtotime($produit->created_at))}}</td> -->
            <td>

           <!--    <a href="{{ route('produits.show', $produit->id) }}" title="show">  
                    <i class="fas fa-eye text-success  fa-lg"></i>    -->
                </a> 
             <!--        <button class="btn btn-primary btn-sm" onclick='getProducts("{{$produit->id}}","{{$produit->produit}}","{{$produit->prix1}}","{{$produit->qte}}")'><i class="fa fa-eye"></i> View</button>
               -->
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
                                    <div style="font-size: 14px;">Quantité Produit  : {{ $produit->qte}}</div>                    
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


<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    var dataToPush = [];
    var row;
    var produit_name;

    function getProducts(r, produit ,categorie , prix1, qte) {
        dataToPush = [];
        produit_name = produit;
        $.ajax({
            url: "http://127.0.0.1:8000/api/listespu/" + r,
            type: 'GET',
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response) {
                var t = $('#produit').DataTable();
                t.clear().draw();
                var invoiceDetailsOption =
                    ' <p class="alert " style="color:black; border:1px solid black;"> id <label id="display_ID" class="label" style="font-size:13px; color:red;border:1px solid black; border-radious: 10/8px;">' + r +
                    '</label>\n' +
                    '\n' +
                    '                                      <br><br>\n' +
                    '                                      <label  style="font-size:13px;">Supplier: </label>\n' +
                    '                                      <label id="display_customer" class="label " style="font-size:13px; color:black; "> ' + produit + ' </label><br>\n' +
                    '                                      <label style="font-size:13px;">Total Price: </label>\n' +
                    '                                      <label id="prix1" class="label label-warning" style="font-size:13px; color:black; "> ৳ ' + prix1 + ' </label><br>\n' +

                    '                                      <label style="font-size:13px;">Total Qty: </label>\n' +
                    '                                      <label id="display_price" class="label" style="font-size:13px; color:black; "> ' + qte + ' </label>\n' +
                    '                                  </p>\n' +
                    '\n' +
                    '\n' +
                    '                                 <button class="btn btn-danger" data-toggle="modal" data-target="#invoiceAdd" onclick="checkBoxID(' + r +
                    ')"><i class="fa fa-cart-plus"></i> Add new product to the invoice</button>';
                document.getElementById("contentInvoice").innerHTML = invoiceDetailsOption;



                $.each(response, function(i, data) {
                    //console.log(data);

                    var productInfo = {
                        invoiceID: r,
                        pID: data.ID,
                        pName: data.pName,
                        availableQty: data.availableQty,
                        Quantity: data.quantity,
                        salePrice: data.price,
                        size: data.size,
                        styleID: data.styleID,
                        styleName: data.styles.name,
                        brandName: data.brand.name,
                        color: data.color,
                    };
                    dataToPush.push(productInfo);

                    // Action Button
                    var btn = "<button data-toggle=\"modal\" data-target=\"#invoiceModal\" class='btn btn-sm btn-danger' onclick='getParticularSale(" +
                        dataToPush.length + ")'> <i class='fa fa-pencil'></i></button>";

                    t.row.add([
                        data.pName + " ×" + data.quantity,
                        data.availableQty,
                        data.styles.name,
                        data.brand.name,
                        data.price,
                        data.size,
                        data.color,
                        btn

                    ]).draw(true);


                });


            }
        });

    }
    function getParticularSale(index) {
            //console.log(product);
            index = index - 1;
            row = index;
            document.getElementById("IDinvoice").innerHTML = dataToPush[index].invoiceID;
            document.getElementById("productIN").value = dataToPush[index].pName;
            document.getElementById("priceIN").value = dataToPush[index].salePrice;
            document.getElementById("qtyIN").value = dataToPush[index].availableQty;
            document.getElementById("qtyINp").value = dataToPush[index].Quantity;
            document.getElementById("colorIN").value = dataToPush[index].color;
            document.getElementById("sizeIN").value = dataToPush[index].size;
            getStyle(index);

        }

        function checkValidation() {
            var availableQty = document.getElementById("qtyIN").value;
            var Purchase = document.getElementById("qtyINp").value;
            if (parseInt(Purchase) < parseInt(availableQty)) {
                alert("Available quantity can't be greater than purchase quantity");
                document.getElementById("qtyIN").value = dataToPush[row].availableQty;
            }

        }

        function saveData() {
            var pName = document.getElementById("productIN").value;
            var salePrice = document.getElementById("priceIN").value;
            var availableQty = document.getElementById("qtyIN").value;
            var Purchase = document.getElementById("qtyINp").value;

            var color = document.getElementById("colorIN").value;
            var size = document.getElementById("sizeIN").value;
            var style = document.getElementById("styleID").value;

            var productInfo = {
                invoiceID: dataToPush[row].invoiceID,
                pID: dataToPush[row].pID,
                pName: pName,
                Purchase: Purchase,
                saleQuantity: availableQty,
                salePrice: salePrice,
                size: size,
                style: style,
                color: color,
                oldQty: dataToPush[row].Quantity,
                oldPrice: dataToPush[row].salePrice
            };
            //console.log(productInfo);
            $.ajax({
                data: {
                    data: productInfo
                },
                url: "http://127.0.0.1:8000/api/listespu/",
                type: 'POST',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    window.location = "/stock-manage";

                }
            });
            //
        }
 
</script>

@endsection