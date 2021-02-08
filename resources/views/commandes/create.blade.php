@extends('layout.index')
@php
	use App\Models\listeproduit;
    $listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Aller au panier"> Aller au panier</a>
            </div>
        </div>
    </div><br>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('commandes.store') }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Categorie :</strong>
                    <select name="catProduit" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror">
						<option value=""></option>
							@foreach ($listes as $liste)
								<option value="{{$liste->categorie}}">{{$liste->categorie}}</option>
							@endforeach
					</select>		 

                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                <strong>Nom du produit :</strong>
                <select name="nomProduit" id="leproduit" class="custom-select form-control @error('produit') is-invalid @enderror">
                    
                </select>	
                </div>		
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Quantité Voulue:</strong>
                    <input type="number" name="qteProduit" class="custom-select form-control">
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 text-center">
                <div class="form-group">
                    <strong>Panier</strong>
                    <button type="submit"  id="btn"class="custom-select form-control btn btn-primary">Ajouter un produit</button>
                </div>
            </div>
        </div>

    </form>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Code</th>
            <th>Catégorie du Produit</th>
            <th>Nom du Produit</th>
            <th>Quantité Voulue</th>
        </tr>
        <tbody id="tableau">
            
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script>   
        $(document).ready(function() {
            $('select[name=catProduit]').change(function () {
                var produit='<option value="">Nos Produits dispo</option>'
            $.ajax({
                type: "GET",
                url: "/api/listesp/"+ $('select[name=catProduit]').val(),
                dataType: 'json',
                success: function(data) {
                    var produits= data;
                    produits.map(p=>{
                    produit+='<option value="'+ p.produit+'">'+p.produit+'</option>'
                    
                    })
                    $('#leproduit').html(produit)
                }
                });
            });
            var tcom ="";
            $('#btn').click(function (e) {
                e.preventDefault()
                var cate=$('select[name=catProduit]');
                var nomp=$('select[name=nomProduit]');
                var qte=$('input[name=qteProduit]');
                
                $.ajax({
                type: "POST",
                url: "/api/commandes",
                dataType: 'json',
                data:{"catProduit":cate.val(),"nomProduit":nomp.val(),"qteProduit":qte.val()},
                success: function(data) {
                    tcom+=`<tr>
                            <td>${data.id}</td>
                            <td>${data.catProduit}</td>
                            <td>${data.nomProduit}</td>
                            <td>${data.qteProduit}</td>
                          </tr>`;   
            $('#tableau').html(tcom);
            $('select[name=catProduit]').val("");
            $('select[name=nomProduit]').val("");
            $('input[name=qteProduit]').val("");
                }
                    });            
                });    
        }); 
   </script>
  
@endsection