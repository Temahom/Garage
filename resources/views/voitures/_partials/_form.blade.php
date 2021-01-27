
@php
	use App\Models\Liste;
@endphp
<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Matricule:</strong>
                    <input type="text" name="matricule" value="{{ isset($voiture) ? $voiture->matricule :''}}" class="custom-select form-control" placeholder="Saisir matricule...">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Marque de la voiture :</strong>
                    <select name="marques" id="marques" class="custom-select form-control">
							@php
								$listes=Liste::select('marques')->orderBy('marques','asc')->distinct()->get();
							@endphp
							@foreach ($listes as $liste)
								<option value="{{$liste->marques}}">{{$liste->marques}}</option>
							@endforeach
					</select>			
                </div>
            </div>     

			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Modele de la voiture :</strong>
                    <select name="lemodel" id="lemodel" class="custom-select form-control">
						
					</select>			
                </div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Année de la voiture :</strong>
                    <select name="lannee" id="lannee" class="custom-select form-control">
						
					</select>			
                </div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type de carburant de la voiture :</strong>
                    <select name="lecarburant" id="lecarburant" class="custom-select form-control">
						
					</select>			
                </div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Puissance de la voiture :</strong>
                    <select name="lapuissance" id="lapuissance" class="custom-select form-control">
						
					</select>			
                </div>
            </div>
		

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
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
	$('select[name=marques]').change(function () {
		var model='<option value="">M-O-D-E-L-E</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/"+ $('select[name=marques]').val(),
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
	$('select[name=lemodel]').change(function () {
		var annee='<option value="">A-N-N-E-E</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/model/"+ $('select[name=lemodel]').val(),
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
	$('select[name=lannee]').change(function () {
		var carburant='<option value="">C-A-R-B-U-R-A-N-T</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/annee/"+ $('select[name=lannee]').val(),
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
	$('select[name=lecarburant]').change(function () {
		var puissance='<option value="">P-U-I-S-S-A-N-C-E</option>'
    $.ajax({
          type: "GET",
          url: "http://127.0.0.1:8000/api/listes/carburant/"+ $('select[name=lecarburant]').val(),
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
