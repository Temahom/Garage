
@php
use App\Models\Liste;
$listes=Liste::select('marques')->orderBy('marques','asc')->distinct()->get();
							
@endphp
@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification Voiture</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('voitures.update', $voiture->id) }}" method="POST" >
        @csrf
        @method('PATCH')

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
                  <input type="text" name="matricule" value="{{ isset($voiture) ? $voiture->matricule : old('matricule')}}  " autocomplete="off" class="custom-select form-control @error('matricule') is-invalid @enderror" placeholder="Saisir matricule...">
                  <div class="invalid-feedback">
                      @if($errors->has('matricule'))
                        {{ $errors->first('matricule') }}
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <strong>Marque</strong>
                  <input type="hidden" value={{$voiture->id}} id="vehicule">
                  <select name="marque" id="marques" class="custom-select form-control @error('marque') is-invalid @enderror js-example-basic-single">
                   
                    @foreach ($listes as $liste)
                     @if($liste->marques == $voiture->marque)
                      <option value="{{$liste->marques}}" {{ old('marque') == ($liste->marques) ? 'selected' : '' }} selected>{{$liste->marques}}</option>
                     @else
                      <option value="{{$liste->marques}}" {{ old('marque') == ($liste->marques) ? 'selected' : '' }} >{{$liste->marques}}</option>
                     @endif
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
                  <div class="invalid-feedback">
                    @if($errors->has('model'))
                    {{ $errors->first('model') }}
                    @endif
                  </div>			
                </div>
          
                <div class="form-group">
                  <strong>Transmission</strong>
                  <select name="transmission" id="latransmission" class="custom-select form-control @error('transmission') is-invalid @enderror js-example-basic-single">
                    @if(!empty($voiture->transmission))
                    <option value="{{$voiture->transmission}}">{{$voiture->transmission}}</option>
                     @endif
                    <option value="">Transmission</option>
                    <option value="Manuel" {{ old('transmission') == 'Manuel' ? 'selected' : '' }}>Manuel</option>
                    <option value="Automatique" {{ old('transmission') == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                    <option value="semi-automatique" {{ old('transmission') == 'semi-automatique' ? 'selected' : '' }}>Semi-Automatique</option>
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
                  <strong>Kilométrage</strong>
                  <input type="number" name="kilometrage" value="{{isset($voiture->kilometrage)?$voiture->kilometrage:''}}" id="lekilometrage" class="custom-select form-control @error('kilometrage') is-invalid @enderror" autocomplete="off" placeholder="Kilometrage"  value="{{ old('kilometrage') }}">
                  <div class="invalid-feedback">
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
                  <div class="invalid-feedback">
                    @if($errors->has('annee'))
                    {{ $errors->first('annee') }}
                    @endif
                  </div>		
                </div> 
                <div class="form-group">
                  <strong>Carburant</strong>
                  <select name="carburant" id="lecarburant" class="custom-select form-control @error('carburant') is-invalid @enderror js-example-basic-single">
                   
                    <option value="">Carburant</option>
                    @if($voiture->carburant== "Essence")
                    <option value="Essence" {{ old('carburant') == 'Essence' ? 'selected' : '' }} selected>Essence</option>
                    @else
                    <option value="Essence" {{ old('carburant') == 'Essence' ? 'selected' : '' }}>Essence</option>
                    @endif
                    @if($voiture->carburant== "Gazoil")
                    <option value="Gazoil" {{ old('carburant') == 'Gazoil' ? 'selected' : '' }} selected>Gazoil</option>
                    @else
                    <option value="Gazoil" {{ old('carburant') == 'Gazoil' ? 'selected' : '' }}>Gazoil</option>
                    @endif
                  </select>	
                  <div class="invalid-feedback">
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
                  <div class="invalid-feedback">
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
              <button type="submit" class="btn btn-success">Enregistrer</button>
            </div>
          
          </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
 <script>
$(document).ready(function() {
    var vehicule = $('#vehicule').val();
    $.ajax({
        type: "GET",
        url:"/api/vehicule/"+vehicule,
        success: function(data){
            var voiture_data= data
        var mo=""
        
        $.ajax({
            type:'GET',
            url: "/api/listes/"+ $('select[name=marque]').val(),
            dataType: 'json',
          success: function(data) {
			    console.log(data);
            data.map(m=>{
                if(voiture_data.model === m.lemodel){
                mo+='<option value="'+ voiture_data.model +'" selected>'+ m.lemodel+'</option>'
                }
                else{
                mo+='<option value="'+ m.lemodel +'">'+ m.lemodel+'</option>'
                }
            })
            $('#lemodel').html(mo)

            var annee=''
                $.ajax({
                      type: "GET",
                      url: "/api/listes/model/"+ $('select[name=model]').val(),
                      dataType: 'json',
                      success: function(data) {
                  var annees= data;
                        annees.map(a=>{
                          if(voiture_data.annee === a.lannee){
                          annee+='<option value="'+ voiture_data.annee+'" selected>'+a.lannee+'</option>'
                          }
                          else
                          annee+='<option value="'+ a.lannee+'">'+a.lannee+'</option>'
                        })
                        $('#lannee').html(annee)
                     
                        var puissance=''
                             $.ajax({
                                  type: "GET",
                                  url: "/api/listes/carburant/"+ $('select[name=carburant]').val(),
                                  dataType: 'json',
                                  success: function(data) {
                                var puissances= data;
                                    puissances.map(p=>{
                                      if(voiture_data.puissance == p.lapuissance )
                                      puissance+='<option value="'+ voiture_data.puissance+'" selected>'+p.lapuissance+'</option>'
                                      else
                                      puissance+='<option value="'+ voiture_data.puissance+'" >'+p.lapuissance+'</option>'
                                    })
                                    $('#lapuissance').html(puissance)
                                  }
                              });

                  }
                });
            } 
        })

     }
    })

    })
  
</script>
    
@endsection