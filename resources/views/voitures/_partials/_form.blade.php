
@php
	use App\Models\Liste;
$listes=Liste::select('marques')->orderBy('marques','asc')->distinct()->get();
							
@endphp


<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12 row">
  
    <div class="col-xs-6 col-sm-6 col-md-6">
      
      <div class="form-group">
        <strong>Proprietaire</strong>
        <select name="client_id" class="custom-select form-control  @error('client_id') is-invalid @enderror">
          @if(!empty($client->id))
            <option value="{{$client->id}}">{{$client->prenom.' '.$client->nom}}</option>
          @else   
          @foreach( $clients as $client ) 
            <option value="{{$client->id}}" {{$voiture->client_id == $client->id ? 'selected':'' }}>{{$client->prenom.' '.$client->nom}}</option>
          @endforeach 
            @endif
        </select>
        <div class="invalid-feedback">
          @if($errors->has('client_id'))
            Le champs client est obligatoire.
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 row">
    <div class="col-xs-6 col-sm-6 col-md-6">
      <div class="form-group">
        <strong>Matricule:</strong>
        <input type="text" name="matricule" value="{{ isset($voiture) ? $voiture->matricule :''}}" autocomplete="off" class="custom-select form-control @error('matricule') is-invalid @enderror" placeholder="Saisir matricule...">
        <div class="invalid-feedback">
            @if($errors->has('matricule'))
              {{ $errors->first('matricule') }}
            @endif
        </div>
      </div>
      <div class="form-group">
        <strong>Marque</strong>
        <select name="marque" id="marques" class="custom-select form-control @error('marque') is-invalid @enderror">
          <option value="">Marque</option>
          @foreach ($listes as $liste)
            <option value="{{$liste->marques}}">{{$liste->marques}}</option>
          @endforeach       
        </select>	
          <div class="invalid-feedback">
            @if($errors->has('marque'))
            {{ $errors->first('marque') }}
            @endif
          </div>		
      </div> 
      <div class="form-group">
        <strong>Modele</strong>
        <select name="model" id="lemodel" class="custom-select form-control @error('model') is-invalid @enderror">
          <option value="">Modèle</option>
        </select>
        <div class="invalid-feedback">
          @if($errors->has('model'))
          {{ $errors->first('model') }}
          @endif
        </div>			
      </div>
      <div class="form-group">
        <strong>Transmission</strong>
        <select name="transmission" id="latransmission" class="custom-select form-control @error('transmission') is-invalid @enderror">
          <option value="">Transmission</option>
          <option value="Manuel">Manuel</option>
          <option value="Automatique">Automatique</option>
          <option value="semi-automatique">Semi-Automatique</option>
        </select>
        <div class="invalid-feedback">
          @if($errors->has('transmission'))
          {{ $errors->first('transmission') }}
          @endif
        </div>			
      </div>
      </div> 
      <div class="col-xs-6 col-sm-6 col-md-6">
      <div class="form-group">
        <strong>Année</strong>
        <select name="annee" id="lannee" class="custom-select form-control @error('annee') is-invalid @enderror">
          <option value="">Année</option>
        </select>	
        <div class="invalid-feedback">
          @if($errors->has('annee'))
          {{ $errors->first('annee') }}
          @endif
        </div>		
      </div> 
      <div class="form-group">
        <strong>Carburant</strong>
        <select name="carburant" id="lecarburant" class="custom-select form-control @error('carburant') is-invalid @enderror">
          <option value="">Carburant</option>
          <option value="Essence">Essence</option>
          <option value="Gazoil">Gazoil</option>
        </select>	
        <div class="invalid-feedback">
          @if($errors->has('carburant'))
          {{ $errors->first('carburant') }}
          @endif
        </div>		
      </div> 
      <div class="form-group">
        <strong>Puissance</strong>
        <select name="puissance" id="lapuissance" class="custom-select form-control @error('puissance') is-invalid @enderror">
          <option value="">Puissance</option>
        </select>
        <div class="invalid-feedback">
          @if($errors->has('puissance'))
          {{ $errors->first('puissance') }}
          @endif
        </div>			
      </div>
      
      <div class="form-group">
        <strong>Kilométrage</strong>
        <input type="number" name="kilometrage" id="lekilometrage" class="custom-select form-control @error('transmission') is-invalid @enderror" autocomplete="off" placeholder="Kilometrage">
        <div class="invalid-feedback">
          @if($errors->has('kilometrage'))
          {{ $errors->first('kilometrage') }}
          @endif
        </div>			
      </div></div> 
  </div>
</div>

  <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
    <a class="btn btn-secondary" href="{{ route('voitures.index') }}"><i class="fas fa-angle-left"></i>  Retour</a>
    <button type="submit" class="btn btn-success">Enregistrer</button>
  </div>

</div>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
 <script>
$(document).ready(function() {
	$('select[name=marque]').change(function () {
		var model='<option value="">choisissez le model</option>'
    $.ajax({
          type: "GET",
          url: "/api/listes/"+ $('select[name=marque]').val(),
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
		var annee='<option value="">Choisissez son année</option>'
    $.ajax({
          type: "GET",
          url: "/api/listes/model/"+ $('select[name=model]').val(),
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

/*$(document).ready(function() {
	$('select[name=annee]').change(function () {
		var carburant='<option value="">Choisissez le carburant</option>'
    $.ajax({
          type: "GET",
          url: "/api/listes/annee/"+ $('select[name=annee]').val(),
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

});*/

$(document).ready(function() {
	$('select[name=carburant]').change(function () {
		var puissance='<option value="">Choisissez la puissance</option>'
    $.ajax({
          type: "GET",
          url: "/api/listes/carburant/"+ $('select[name=carburant]').val(),
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
