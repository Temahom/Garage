@extends('layout.index')

@php
	use App\Models\listeproduit;
    $listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp



@section('titre')
<h1>Creer un Devis</h1>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" title="Go back"><span style="font-size:15px;">&#129060;</span> Retour</a>
            </div>
        </div>
    </div><br>

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
    <form action="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST" >
        @csrf
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Categorie :</strong>
                    <select name="categorie" id="categorie" class="custom-select form-control @error('categorie') is-invalid @enderror">
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
                <select name="produit" id="leproduit" class="custom-select form-control @error('produit') is-invalid @enderror">
                    
                </select>	
                </div>		
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Quantité :</strong>
                    <input type="number" name="qte" class="custom-select form-control @error('qte') is-invalid @enderror"  placeholder="Entrer la Quantite">
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="cout" class="col-form-label">Coût de Réparation</label>
                    <input id="cout" type="number" name="cout" required class="custom-select form-control" placeholder="Coût de réparation">
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-success">Créer</button>
            </div>        
        </div>
    </form>
</div>


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