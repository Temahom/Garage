
@php
use App\Models\Liste;
$listes=Liste::select('marques')->orderBy('marques','asc')->distinct()->get();
							
@endphp
@extends('layout.index')
@section('content')


<style>
	/* .row{
		overflow: hidden;
	} */
  .titre{
          background-image: linear-gradient(to left, #161344, #332F30);
          color:#fff;
          border-radius:20px;
          padding:0 10px;
          padding:10px;
  }
  .label{
      margin-right: 5px;
  }
</style>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>
                  <span class="titre"><i class="fas fa-fw fa-car label"></i> Ajout Voiture</span>
              </h2>
          </div>
      </div>
  </div>
</div>
<br> 

    <form action="{{ route('voitures.store') }}" method="POST" id="form">
      @csrf
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 row">  
          <div class="col-xs-6 col-sm-6 col-md-6">      
            <div class="form-group">
              <strong>Proprietaire</strong>
              <select name="client_id" class="custom-select form-control  @error('client_id') is-invalid @enderror js-example-basic-single" >
                @if(!empty($client->id))
                  <option value="{{$client->id}}">{{$client->prenom.' '.$client->nom}}</option>
                @else   
                @foreach( $clients as $client ) 
                  <option value="{{$client->id}}" {{ old('client_id') == ($client->id) ? 'selected' : '' }} {{$voiture->client_id == $client->id ? 'selected':'' }}>{{$client->prenom.' '.$client->nom}}</option>
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
              <input type="text" name="matricule" value="{{old('matricule')}} " autocomplete="off" class="custom-select form-control @error('matricule') is-invalid @enderror" placeholder="Saisir matricule...">
              <div class="invalid-feedback">
                  @if($errors->has('matricule'))
                    {{ $errors->first('matricule') }}
                  @endif
              </div>
            </div>
            <div class="form-group">
              <strong>Marque</strong>
              <select name="marque" id="marques" class="custom-select form-control @error('marque') is-invalid @enderror js-example-basic-single"> 
                <option value="">Marque</option>
                @foreach ($listes as $liste)
                  <option value="{{$liste->marques}} " {{ old('marque') == ($liste->marques) ? 'selected' : '' }} >{{$liste->marques}}</option>
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
              <select name="model" id="lemodel" class="custom-select form-control @error('model') is-invalid @enderror js-example-basic-single">
                <option value="">Modèle</option>
              </select>
              <div class="invalid-feedback" id="modele">
                @if($errors->has('model'))
                {{ $errors->first('model') }}
                @endif
              </div>			
            </div>
      
            <div class="form-group">
              <strong>Transmission</strong>
              <select name="transmission" id="latransmission" class="custom-select form-control @error('transmission') is-invalid @enderror js-example-basic-single">
                <option value="">Transmission</option>
                <option value="Manuel" {{ old('transmission') == 'Manuel' ? 'selected' : '' }}>Manuel</option>
                <option value="Automatique" {{ old('transmission') == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                <option value="semi-automatique" {{ old('transmission') == 'semi-automatique' ? 'selected' : '' }}>Semi-Automatique</option>
              </select>
              <div class="invalid-feedback" id="transmission">
                @if($errors->has('transmission'))
                {{ $errors->first('transmission') }}
                @endif
              </div>			
            </div>
            </div> 
            <div class="col-xs-6 col-sm-6 col-md-6">
               <div class="form-group">
              <strong>Kilométrage</strong>
              <input type="number" name="kilometrage" value="{{old('kilometrage')}}" id="lekilometrage" class="custom-select form-control @error('kilometrage') is-invalid @enderror" autocomplete="off" placeholder="Kilometrage"  value="{{ old('kilometrage') }}">
              <div class="invalid-feedback" id="kilometrage">
                @if($errors->has('kilometrage'))
                {{ $errors->first('kilometrage') }}
                @endif
              </div>			
            </div>
            <div class="form-group">
              <strong>Année</strong>
              <select name="annee" id="lannee" class="custom-select form-control @error('annee') is-invalid @enderror js-example-basic-single">
               
                <option value="">Année</option>
              </select>	
              <div class="invalid-feedback" id="annee">
                @if($errors->has('annee'))
                {{ $errors->first('annee') }}
                @endif
              </div>		
            </div> 
            <div class="form-group">
              <strong>Carburant</strong>
              <select name="carburant" id="lecarburant" class="custom-select form-control @error('carburant') is-invalid @enderror js-example-basic-single">
               
                <option value="">Carburant</option>
                <option value="Essence" {{ old('carburant') == 'Essence' ? 'selected' : '' }}>Essence</option>
                <option value="Gazoil" {{ old('carburant') == 'Gazoil' ? 'selected' : '' }}>Gazoil</option>
              </select>	
              <div class="invalid-feedback" id="carburant">
                @if($errors->has('carburant'))
                {{ $errors->first('carburant') }}
                @endif
              </div>		
            </div> 
            <div class="form-group">
              <strong>Puissance</strong>
              <select name="puissance" id="lapuissance" class="custom-select form-control @error('puissance') is-invalid @enderror js-example-basic-single">
                
                <option value="">Puissance</option>
              </select>
              <div class="invalid-feedback" id="puissance">
                @if($errors->has('puissance'))
                {{ $errors->first('puissance') }}
                @endif
              </div>			
            </div>
            
          </div> 
        </div>
      </div>
      
        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
          <a class="btn btn-secondary" href="{{ route('voitures.index') }}"><i class="fas fa-angle-left"></i>  Retour</a>
          <a class="btn btn-success" onclick="formSend()" style="color:#ffffff">Enregistrer</a>
        </div>
      
      </div>
        
    </form>


    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
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
              {{ old('marque') == ($liste->marques) ? 'selected' : '' }}
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

    $(document).ready(function() {
        $('.js-example-basic-single').select2({
          class : "custom-select form-control"
        });
    });


    function formSend()
    {
      var modele = $('#lemodel').val()
      var annee = $('#lannee').val()
      var carburant = $('#lecarburant').val()
      var puissance = $('#lapuissance').val()
      var transmission = $('#latransmission').val()
      var tab=[]
      tab['modele']= modele
      tab['annee']= annee
      tab['carburant']= carburant
      tab['puissance']= puissance
      tab['transmission']= transmission

      for (const [key, value] of Object.entries(tab)) {
          // console.log(key, value);
          if(value==""){
            //  alert('le champ ' + key + ' ne pas pas etre vide')
            $("'#"+key+"'").html('<div class="invalid-feedback">champ vide </div>')
          }  
          else $('#form').submit()
        }

      // tab.map(element=>{
      //      if(element == ""){

      //      }
      //      else $('#form').submit()
      // })
      // if(modele == "" && annee =="" && carburant=="" && puissance=="" && transmission=="")
      //   {
      //     alert('champs manquant')
      //   }
      //   else
      //     $('#form').submit()
    }

</script>
        
@endsection