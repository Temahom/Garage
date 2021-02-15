
@extends('layout.index')
@php
	use App\Models\listeproduit;
    $listes=listeproduit::select('categorie')->orderBy('categorie','asc')->distinct()->get();
							
@endphp

@section('content')

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
    <div class="row ml-1">
        <div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
         
            <div class="row">
    
                <div class="col-md-2 col-sm-3 text-center pt-4">
                    <img style="height: 50px;width: auto;" class="" src="/assets/images/car.png" alt="logo">
                </div>
    
                <div class="col-md-10 col-sm-10">
    
                    <div style="font-size: 20px">
                        <a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" style="color: #2EC551">
                            {{ $voiture->matricule }}
                        </a>
                        <span style="font-size: 12px;">
                            ( De<a href="{{route('clients.show',['client'=>$voiture->client_id])}}" style="color: #2EC551">
                                <i class="fas fa-user"></i>
                                {{ $voiture->client()->first()->prenom.' '.$voiture->client()->first()->nom}}
                            </a>)
                        </span>
    
                    </div>
    
                    <div style="font-size: 14px;"> {{ $voiture->marque}} - {{ $voiture->model}} - {{ $voiture->annee}}</div>
                    <div style="font-size: 14px;"> {{ $voiture->transmission}} - {{ $voiture->carburant}}</div>			
                    <div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux - {{ $voiture->kilometrage}} km</div>		
                <div class="text-right" style="font-size: 12px;">
                    <a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
                    <button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                        Supprimer
                    </button>
                    <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5>Voulez vous supprimer : <strong>{{ $voiture->matricule }}</strong>  ?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="{{route('voitures.destroy',$voiture->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                            </div>
                            </div>
                        </div>
                    </div>	
                </div>

            </div>

        </div>
    </div>
</div> <br>
<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8">
		<h2>Devis</h2>
	</div>
    <div class="col-xs-12 col-sm-12 col-md-12 row">
          
            <div class="form-group col-xs-12 col-sm-12 col-md-12">
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
            </div>  
            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                
                <table class="table table-bordered table-responsive-lg">
                    <tr style="background-color: rgb(172, 187, 187)">
                        <th>Catégorie du Produit</th>
                        <th>Nom du Produit</th>
                        <th>Quantité Voulue</th>
                        <th>Prix à payer</th>
                    </tr>
                       <tbody id="tableau">  
    
                      </tbody>
                </table>
            </div>      
        </div>
    </div>
</div>
<div class="form-group col-xs-12 col-sm-12 col-md-12">
    <div class="form-group col-xs-12 col-sm-12 col-md-12">
        <form action="{{ route('voitures.interventions.devis.store',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}" method="POST">
            <div class="row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="cout" class="col-form-label">Coût de Réparation</label>
                    <input id="cout" type="number" name="cout" required class="form-control" placeholder="Coût de réparation">
                </div>
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <label for="expiration_expiration" class="col-form-label">Date Expiration</label>
                    <input id="expiration" type="date" name="date_expiration" required class="form-control" placeholder="Date expiration...">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
</div>


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
                    tcom+=`
                        <tr>
                            <td>${data.catProduit}</td>
                            <td>${data.nomProduit}</td>
                            <td>${data.qteProduit}</td>
                            <td>${100*data.qteProduit}</td>
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