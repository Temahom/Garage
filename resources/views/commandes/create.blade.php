@extends('layout.index')
@php
    $devis=App\Models\Devi::all();
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
							@foreach ($produits as $produit)
								<option value="{{$produit->categorie}}">{{$produit->categorie}}</option>
							@endforeach
					</select>		 

                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                <strong>Nom du produit :</strong>
                <select name="produit_id" id="leproduit" class="custom-select form-control @error('produit') is-invalid @enderror">
                    
                </select>	
                </div>		
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Quantité Voulue:</strong>
                    <input type="number" name="qteProduit" class="custom-select form-control">
                </div>
            </div>
            <select name="devis_id" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror">
                <option value=""></option>
                    @foreach ($devis as $devi)
                        <option value="{{$devi->id}}">{{$devi->id}}</option>
                    @endforeach
            </select>	
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
            <th>Catégorie</th>
            <th>Libellé</th>
            <th>Prix Unitaire</th>
            <th>Quantité</th>
            <th>Prix total</th>
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
                url: "/api/produit/"+ $('select[name=catProduit]').val(),
                dataType: 'json',
                success: function(data) {
                    var produits= data;
                    produits.map(p=>{
                    produit+='<option value="'+ p.id+'">'+p.produit+'</option>'
                    
                    })
                    $('#leproduit').html(produit)
                }
                });
            });
            var tcom ="";
            $('#btn').click(function (e) {
                e.preventDefault()
                var produit=$('select[name=produit_id]');
               var devis=$('select[name=devis_id]');
                var qte=$('input[name=qteProduit]');
                
                $.ajax({
                type: "POST",
                url: "/api/commandes/",
                dataType: 'json',
                data:{"produit_id":produit.val(),"qteProduit":qte.val(),"devi_id":devis.val()},
                success: function(data) {
                    console.log(data);
                    tcom+=`<tr>
                            <td>${data.id}</td>
                            <td>${data.produit_id}</td>
                            <td>${data.devi_id}</td>
                            <td>${data.qteProduit}</td>
                            <td>${data.qteProduit}</td>
                          </tr>`;   
            $('#tableau').html(tcom);
            $('select[name=produit_id]').val("");
            $('input[name=qteProduit]').val("");
                }
                    });            
                });    
        }); 
   </script>
  
@endsection