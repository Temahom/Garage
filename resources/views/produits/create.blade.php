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
    </div><br><br>

    
    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="row"><br>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Categorie :</strong>
                    <select name="categorie" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror" onchange="change();">
                        <option value=""></option>
						<option value="autres">---Autres---</option>
							@foreach ($listes as $liste)
								<option value="{{$liste->categorie}}" {{ old('categorie') == ($liste->categorie) ? 'selected' : '' }}>{{$liste->categorie}}</option>
							@endforeach
					</select><br>
                    <input type="text" class="custom-select form-control" id="inpuTxt1" style="display:none;" value=""/>
                    <div class="invalid-feedback">
                        @if($errors->has('categorie'))
                        {{ $errors->first('categorie') }}
                        @endif
                    </div>	 

                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <strong>Nom du produit :</strong>
             
                <select name="produit" id="leproduit" class="custom-select form-control @error('produit') is-invalid @enderror" onchange="change();">
                    
                </select><br>
                <input name="produit" type="text" class="custom-select form-control" id="inpuTxt2" style="display:none;" placeholder="Mettre le nom du produit"/>
                <div class="invalid-feedback">
                    @if($errors->has('produit'))
                    {{ $errors->first('produit') }}
                    @endif
                </div>	
                </div>		
            </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <strong>Le Prix Unitaire :</strong>
                <input name="prix1" type="number" class="custom-select form-control" id="inpuTxt3" style="display:none;" autocomplete="off" placeholder="Mettre le prix du produit"/>
                <select  name="prix1" id="leprix" class="custom-select form-control @error('prix1') is-invalid @enderror" onchange="change();">
                   
                </select><br>

                <div class="invalid-feedback">
                    @if($errors->has('prix1'))
                    {{ $errors->first('prix1') }}
                    @endif
                </div>	
                </div>		
            </div>
        
             <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Quantité :</strong>
                    <input jsaction="input:trigger.Wtqxqe" type="number" name="qte" class="form-control @error('qte') is-invalid @enderror"  placeholder="Entrer la Quantite" value="{{ old('qte') }}">
                    <div class="invalid-feedback">
                        @if($errors->has('qte'))
                        {{ $errors->first('qte') }}
                        @endif
                    </div>
                </div>
<<<<<<< HEAD
            </div>  -->
=======
            </div>          
>>>>>>> e1056e6ceaefbe2cd32f7b0e0c5a1aff8c020530
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Commander</button>
            </div>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

        
    <script>
        $(document).ready(function() {
            $('select[name=categorie]').change(function () {
                var produit='<option value="">Nos Produits Disponibles</option>'
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
            
            if(val=="autres")
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