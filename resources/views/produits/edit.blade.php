@extends('layout.menu')

@php
    use App\Models\listeproduit;
$listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();	
@endphp

@section('content')

<style>
	.row{
		overflow: hidden;
	}
</style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifiez Le Produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('produits.index') }}" title="Go back"><span style="font-size:15px;">&#129060;</span> Retour </a><br>
            </div>
        </div>
    </div>

    <br>
    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    Catégorie : <h3>{{ $produit->categorie }}</h3>
                    Libellé :<h3>{{ $produit->produit }}</h3>	
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group" >
                        <strong>Prix Unitaire :</strong>
                        <input style="border-color: red !important" name="prix1" type="number" min="0" value="{{ $produit->prix1 }}" class="custom-select form-control" id="leprix" autocomplete="off" placeholder="Mettre le prix du produit" value="{{ old('prix1')}}"/>
                        <div class="invalid-feedback">
                            @if($errors->has('prix1'))
                            {{ $errors->first('prix1') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Quantité:</strong>
                        <input type="number" min="0" name="qte" value="<?php
                        $quantiteStock = 0;
                            foreach ($produit->approvisionnements as $product)
                            {
                                $quantiteStock +=$product->pivot->quantite;
                            }
                            echo $quantiteStock+$produit->qte; 
                        ?>" class="form-control @error('qte') is-invalid @enderror" style="border-color: red !important" placeholder="Entrer la quantite" >
                        <div class="invalid-feedback">
                            @if($errors->has('qte'))
                            {{ $errors->first('qte') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="col-xs-3 col-sm-3 col-md-3 text-center">
                <br><button type="submit" class="btn btn-danger">Enregistrer</button>
            </div>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script>
   
   $(document).ready(function() {
	$('select[name=categorie]').change(function () {
		var produit='<option value="">Nos Produits</option>'
    $.ajax({
          type: "GET",
          url: "/api/listesp/"+ $('select[name=categorie]').val(),
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
            url: "/api/listespu/"+ $('select[name=produit]').val(),
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
    });

</script>
<script>
    function change()
        {
            var doc = document.getElementById("categorie");
            var val = doc.options[doc.selectedIndex].value;
            var input1 = document.getElementById("inpuTxt1");
            var input2 = document.getElementById("inpuTxt2");
            var input3 = document.getElementById("inpuTxt3");
            var input4 = document.getElementById("leprix");
            var input6 = document.getElementById("leproduit");
            var input7 = document.getElementById("categorie");
            
            if(val=="* Ajouter")
            {
                input1.style.display="none";
                input2.style.display="block";
                input3.style.display="block";  
                input4.style.display="none";
                input6.style.display="none";
            }
            else
            {
                input1.style.display="none";
                input2.style.display="none";
                input3.style.display="none";
                input4.style.display="block";
                input6.style.display="block";
                
            }
        }
</script>


@endsection