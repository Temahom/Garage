@extends('layout.index')
@php
	use App\Models\listeproduit;
$listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Creer Un Nouveau Produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-warning" href="{{ route('produits.index') }}" title="Go back"><span style="font-size:15px;">&#129060;</span> Retour</a>
            </div>
        </div>
    </div><br><br>

    
    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Categorie :</strong>
                    <select name="categorie" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror">
						<option value=""></option>
							@foreach ($listes as $liste)
								<option value="{{$liste->categorie}}" {{ old('categorie') == ($liste->categorie) ? 'selected' : '' }}>{{$liste->categorie}}</option>
							@endforeach
					</select>
                    <div class="invalid-feedback">
                        @if($errors->has('categorie'))
                        {{ $errors->first('categorie') }}
                        @endif
                    </div>	 

                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Nom du produit :</strong>
                <input type="text" name="produit" class="form-control @error('produit') is-invalid @enderror"  placeholder="Saisir le produit" value="{{ old('produit') }}">
                   
                <div class="invalid-feedback">
                    @if($errors->has('produit'))
                    {{ $errors->first('produit') }}
                    @endif
                </div>	
                </div>		
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Le Prix Unitaire :</strong>
                <input type="number" name="prix1" class="form-control @error('qte') is-invalid @enderror"  placeholder="Saisir le prix" value="{{ old('prix1') }}">
                   <div class="invalid-feedback">
                    @if($errors->has('prix1'))
                    {{ $errors->first('prix1') }}
                    @endif
                </div>	
                </div>		
            </div>
         <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Quantité :</strong>
                    <input type="number" name="qte" class="form-control @error('qte') is-invalid @enderror"  placeholder="Saisir la Quantite" value="{{ old('qte') }}">
                    <div class="invalid-feedback">
                        @if($errors->has('qte'))
                        {{ $errors->first('qte') }}
                        @endif
                    </div>
                </div>
            </div>          -->
            <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                <button type="submit" class="btn btn-danger">Enregistrer</button>
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

<script>
   
   $(document).ready(function() {
        $('select[name=produit]').change(function () {
           var prix1='<option value="">Le prix du Produit </option>'
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/api/listespu/"+ $('select[name=produit]').val(),
            dataType: 'json',
            success: function(data) {
                var prix1s= data;
                prix1s.map(pu=>{
                 prix1+='<option value="'+ pu.prix1+'">'+pu.prix1+'</option>'

                })
                $('#leprix').html(prix1)
            }
            });
        });
    });  */

</script>


@endsection