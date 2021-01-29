
@php
	use App\Models\Liste;
$listes=Liste::select('marques')->orderBy('marques','asc')->distinct()->get();
							
@endphp


<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Matricule:</strong>
                    <input type="text" name="matricule" value="{{ isset($voiture) ? $voiture->matricule :''}}" class="custom-select form-control" placeholder="Saisir matricule...">
                </div>

				<div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Marque de la voiture :</strong>
                    <select name="marque" id="marques" class="custom-select form-control">
						<option value=""></option>
							@foreach ($listes as $liste)
								<option value="{{$liste->marques}}">{{$liste->marques}}</option>
							@endforeach
					</select>			
                </div> 

				<div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Modele de la voiture :</strong>
                    <select name="model" id="lemodel" class="custom-select form-control">
						
					</select>			
                </div>
		
				<div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Année de la voiture :</strong>
                    <select name="annee" id="lannee" class="custom-select form-control">
						
					</select>			
                </div>
		
				<div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Type de carburant de la voiture :</strong>
                    <select name="carburant" id="lecarburant" class="custom-select form-control">
						
					</select>			
                </div>
		
				<div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Puissance de la voiture :</strong>
                    <select name="puissance" id="lapuissance" class="custom-select form-control">
						
					</select>			
				</div>
				
				<div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Proprietaire</strong>
                    <select name="client_id" class="custom-select form-control">
                       <option value="{{ isset($client_default) ? $client_default->id:''}}">{{ isset ($client_default) ? $client_default->prenom.' '.$client_default->nom:''}}</option>
                      @foreach( $clients as $client ) 
                       <option value="{{$client->id}}">{{$client->prenom.' '.$client->nom}}</option>
                      @endforeach 
                    </select>
                </div>
                @if($errors->has('client_id'))
                    <p>{{ $errors->first('client_id') }}</p>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ route('voitures.index') }}">Retour</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

 </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
 <script>
$(document).ready(function() {
	$('select[name=marque]').change(function () {
		var model='<option value="">M-O-D-E-L-E</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/"+ $('select[name=marque]').val(),
          dataType: 'json',
          success: function(data) {
			var models= data;
            models.map(m=>{
              model+='<option value="'+ m.lemodel+'">'+ m.lemodel+'</option>'
            
            })
            $('#lemodel').html(model)
          }
          });

	});

});

$(document).ready(function() {
	$('select[name=model]').change(function () {
		var annee='<option value="">A-N-N-E-E</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/model/"+ $('select[name=model]').val(),
          dataType: 'json',
          success: function(data) {
			var annees= data;
            annees.map(a=>{
              annee+='<option value="'+ a.lannee+'">'+a.lannee+'</option>'
            
            })
            $('#lannee').html(annee)
          }
          });

	});

});

$(document).ready(function() {
	$('select[name=annee]').change(function () {
		var carburant='<option value="">C-A-R-B-U-R-A-N-T</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/annee/"+ $('select[name=annee]').val(),
          dataType: 'json',
          success: function(data) {
			var carburants= data;
            carburants.map(c=>{
              carburant+='<option value="'+ c.lecarburant+'">'+c.lecarburant+'</option>'
            
            })
            $('#lecarburant').html(carburant)
          }
          });

	});

});

$(document).ready(function() {
	$('select[name=carburant]').change(function () {
		var puissance='<option value="">P-U-I-S-S-A-N-C-E</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/carburant/"+ $('select[name=carburant]').val(),
          dataType: 'json',
          success: function(data) {
			var puissances= data;
            puissances.map(p=>{
              puissance+='<option value="'+ p.lapuissance+'">'+p.lapuissance+'</option>'
            
            })
            $('#lapuissance').html(puissance)
          }
          });

	});

});






</script>
