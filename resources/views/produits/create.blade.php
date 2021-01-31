@extends('layout.index')
@php
	use App\Models\listeproduit;
$listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ajouter Un Nouveau Produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produits.index') }}" title="Go back"><span style="font-size:15px;">&#129060;</span> Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a eu des problèmes avec votre entrée.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('produits.store') }}" method="POST" >
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categorie :</strong>
                    <select name="categorie" id="categorie" class="custom-select form-control">
						<option value=""></option>
							@foreach ($listes as $liste)
								<option value="{{$liste->categorie}}">{{$liste->categorie}}</option>
							@endforeach
					</select>		 

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Nom du produit :</strong>
                <select name="produit" id="leproduit" class="custom-select form-control">
                    
                </select>	
                </div>		
            </div>
         <!--   <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Nom du produit :</strong>
                <input type="text" name="libelle" class="form-control" placeholder="Entrer le nom du produit">	
                </div>		
            </div>  -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Prix :</strong>
                    <input type="number" name="prix" class="form-control" placeholder="Entrer le Prix">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantité :</strong>
                    <input type="number" name="qte" class="form-control" placeholder="Entrer la Quantite">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Commander</button>
            </div>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script>
   
        $(document).ready(function() {
            $('select[name=categorie]').change(function () {
                var produit='<option value="">Nos Produits dispo</option>'
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/api/listesp/"+ $('select[name=categorie]').val(),
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
        });
        
   
   </script>

@endsection