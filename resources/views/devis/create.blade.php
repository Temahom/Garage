@extends('layout.index')

@extends('layout.index')
@php
	use App\Models\listeproduit;
    $listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Go back"> Aller au panier</a>
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
                    <button type="submit" class="custom-select form-control btn btn-primary">Ajouter</button>
                </div>
            </div>
        </div>

    </form>


    <div class="card-body">
        <form action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cout" class="col-form-label">Coût de Réparation</label>
                <input id="cout" type="number" name="cout" required class="form-control" placeholder="Coût de réparation">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3 p-0">
                <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script>
   
        $(document).ready(function() {
            $('select[name=catProduit]').change(function () {
                var produit='<option value="">Nos Produits dispo</option>'
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/api/listesp/"+ $('select[name=catProduit]').val(),
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