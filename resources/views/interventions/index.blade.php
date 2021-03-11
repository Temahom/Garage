@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Historique Interventions</h2>
            </div>
        </div>
    </div>
    <style>
        svg{
            display: none;
        }
         /* @import url("https://fonts.googleapis.com/css?family=Lato"); */
        

          .tabs {
            width: 100%;
            float: none;
            list-style: none;
            position: relative;
            margin: 30px 0 0 10px;
            text-align: left;
          }
          .tabs li {
            float: left;
            display: block;
          }
          .tabs input[type="radio"] {
            position: absolute;
            top: 0;
            left: -9999px;
          }
          .tabs label {
            display: block;
            padding: 14px 21px;
            border-radius: 2px 2px 0 0;
            font-size: 20px;
            font-weight: normal;
            text-transform: uppercase;
            background: #ffffff;
            cursor: pointer;
            position: relative;
            top: 4px;
            -moz-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
          }
          .tabs label:hover {
            background-image: linear-gradient( to top,#58575f, #51505c);
            color: white;
          }
          .tabs .tab-content {
            z-index: 2;
            display: none;
            overflow: hidden;
            width: 100%;
            font-size: 17px;
            line-height: 25px;
            padding: 25px;
            position: absolute;
            top: 53px;
            left: 0;
            background: #FFFFFF;
          }
          .tabs [id^="tab"]:checked + label {
            top: 0;
            padding-top: 10px;
            background-image: linear-gradient( to top,#2b2a34, #0E0C28);
            color:#ffffff;
          }
          .tabs [id^="tab"]:checked ~ [id^="tab-content"] {
            display: block;
          }

          p.link {
            clear: both;
            margin: 380px 0 0 15px;
          }
          p.link a {
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            color: #fff;
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #612e76;
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
          }
          p.link a:hover {
            background-color: #522764;
          
          }

          .nav-link_1.active,
          .nav-pills .show>.nav-link{
           background-color:#138496!important;
           color:#ffffff;
           
           padding: 10px;
           border-radius:0 20% 0 20%;
           text-align: center;
           font-size: 16px;
          }
          .nav-link_1.active:hover,
          .nav-pills .show>.nav-link:hover{
           background-color:#138496!important;
           color:#ffffff;
           padding: 10px;
           border-radius:0 20% 0 20%;
           text-align: center;
           font-size: 16px;
          }

    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif

        <div class="row" style="margin-top: 30px">
          <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" >
              <a class="nav-link_1 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Resume</a>
              <a class="nav-link_1" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Details</a>
            </div>
          </div>
          <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-xs-3 col-sm-3 col-md-3" style="margin-left: 75%">     
                  <div class="form-group">
                    <form action="/interventions-list" method="GET" role="search">
                      <div class="d-flex">
                        <input type="text" class="form-control mr-2" name="term" placeholder="Rechercher ici " id="term" autocomplete="off">
                        <button class="btn btn-info t" type="submit" title="recherche une intervention">
                          <span class="fas fa-search"></span>
                        </button>
                      </div>
                    </form><br>
                  </div>
                </div>  
                <table class="table table-borderless">
                      <thead>
                        <tr style="background-image: linear-gradient( to top,#2b2a34, #0E0C28); text-align: center">
                          <th scope="col" style= "color:#ffffff" > #</th>
                          <th scope="col" style= "color:#ffffff" > Type</th>
                          <th scope="col" style= "color:#ffffff" > Etat</th>
                          <th scope="col" style= "color:#ffffff" >Voiture</th>
                          <th scope="col" style= "color:#ffffff" >Date Enregistrement </th>
                          <th scope="col" style= "color:#ffffff" >Chargé Enregistrement</th>
                          <th scope="col" style= "color:#ffffff" >Chargé Operation</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($interventions as $key=>$intervention)
                        <tr style="cursor: pointer; text-align: center">
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$intervention->type}}</td>
                          @switch($intervention->statut)
                              @case(1)
                              <td>Demande de Services</td>
                                  @break
                              @case(2)
                              <td>Diagnostic Realisé</td>
                                  @break
                                  @case(3)
                              <td>Devis Etablis</td>
                                  @break
                              @default
                              <td>Reparation en cours</td> 
                          @endswitch
                          <td title="{{$intervention->voiture()->first()->marque}} {{$intervention->voiture()->first()->model}}">{{$intervention->voiture()->first()->matricule}}</td>
                          <td>{{date_format($intervention->created_at, 'd m Y | H:i:s')}}</td>
                          <td>{{$intervention->user()->first()->name}}</td>
                          <td>{{App\Models\User::find($intervention->technicien)->name}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
              </div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 row">
                      
                      <ul class="tabs" role="tablist">
                          <li>
                            <input type="radio" name="tabs" id="tab1" checked />
                            <label for="tab1" 
                                    role="tab" 
                                    aria-selected="true" 
                                    aria-controls="panel1" 
                                    tabindex="0">Diagnostics <sup><span class="badge badge-warning">{{App\Models\Diagnostic::count()}}</span></sup></label>
                            <div id="tab-content1" 
                                  class="tab-content" 
                                  role="tabpanel" 
                                  aria-labelledby="diagnostics" 
                                  aria-hidden="false">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                    
                                    <table class="table table-striped table-hover col-md-12">
                                      <thead class="" style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);"> 
                                    <tr style="text-align: center">
                                        <th style="color: white;">#</th>
                                        <th style="color: white;">Constat</th>
                                        <th style="color: white;">Date Edition</th>
                                        <th style="color: white;">Voiture </th>
                                        <th style="color: white;">Proprietaire </th>
                                    </tr>
                                        </thead>
                                    @foreach ($diagnostics as $key=>$diagnostic)
                                    <tr style="text-align: center">
                                        <td onclick="showDiagnostic({{ $diagnostic->id }})" style="cursor: pointer; text-transform: capitalize;">{{$key+1}}</td>
                                        <td onclick="showDiagnostic({{ $diagnostic->id}})" style="cursor: pointer; text-transform: capitalize;">{{$diagnostic->diagnostic()->first()->constat}}</td>
                                        <td onclick="showDiagnostic({{ $diagnostic->id }})" style="cursor: pointer; text-transform: capitalize;">{{date_format($diagnostic->diagnostic()->first()->created_at, 'd m Y | H:i:s')}}</td>
                                        <td onclick="showDiagnostic({{ $diagnostic->id}})" style="cursor: pointer; text-transform: capitalize;">{{$diagnostic->voiture()->first()->marque.' '.$diagnostic->voiture()->first()->model}}</td>
                                        <td onclick="showDiagnostic({{ $diagnostic->id}})" style="cursor: pointer; text-transform: capitalize;">{{$diagnostic->voiture()->first()->client()->first()->prenom.' '.$diagnostic->voiture()->first()->client()->first()->nom}}</td>
                                    </tr>
                                    @endforeach
                                      <div class="col-md-12 mt-3 d-flex justify-content-center">
                                        {!! $diagnostics->links() !!}
                                      </div>
                                </table>
                            </div>
                          </li>
          
                          <li>
                            <input type="radio" name="tabs" id="tab2" />
                            <label for="tab2"
                                    role="tab" 
                                    aria-selected="false" 
                                    aria-controls="panel2" 
                                    tabindex="0">Devis <sup><span class="badge badge-primary">{{App\Models\Devi::count()}}</span></sup></label>
                            <div id="tab-content2" 
                                  class="tab-content"
                                  role="tabpanel" 
                                  aria-labelledby="devis" 
                                  aria-hidden="true">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                  <table class="table table-striped table-hover col-md-12">
                                    <thead class="" style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);">
                                    <tr style="text-align: center">
                                        <th style="color: white;">#</th>
                                        <th style="color: white;">Date Edition</th>
                                        <th style="color: white;">Date Expiration</th>
                                        <th style="color: white;">Coût</th>
                                        <th style="color: white;">Client</th>
                                        <th style="color: white;">Etat</th>
                                    </tr>
                                        </thead>
                                    @foreach ($devis as $key=>$devi)
                                    <tr style="text-align: center">
                                        <td onclick="showVoiture({{ $devi->id }})" style="cursor: pointer; text-transform: capitalize;">{{$key+1}}</td>
                                        <td onclick="showVoiture({{ $devi->id }})" style="cursor: pointer; text-transform: capitalize;">{{date_format($devi->devi()->first()->created_at, 'd-m-Y | H:i:s')}}</td>
                                        <td onclick="showVoiture({{ $devi->id }})" style="cursor: pointer; text-transform: capitalize;">{{date("d-m-Y", strtotime($devi->devi()->first()->date_expiration))}}</td>
                                        <td onclick="showVoiture({{ $devi->id }})" style="cursor: pointer; text-transform: capitalize;">{{number_format($devi->devi()->first()->cout)}} <sup>Fcfa</sup></td>
                                        <td onclick="showVoiture({{ $devi->id }})" style="cursor: pointer; text-transform: capitalize;">{{$devi->voiture()->first()->client()->first()->prenom.' '.$devi->voiture()->first()->client()->first()->nom}}</td>
                                        <td onclick="showVoiture({{ $devi->id }})" style="cursor: pointer; text-transform: capitalize;">
                                        <form action="/devis-etat" method="POST">
                                          @csrf
                                          @method('Patch')
                                          @if ($devi->devi()->first()->etat == 1)
                                            <span class="badge-dot badge-primary mr-1"></span>En Cours</td>
                                          @elseif($devi->devi()->first()->etat == 2)
                                            <span class="badge-dot badge-success mr-1"></span>Validé</td>
                                          @else 
                                            <span class="badge-dot badge-danger mr-1"></span>Expiré</td>   
                                          @endif
                                      </form>
                                    </tr>
                                    
                                    @endforeach
                                      <div class="col-md-12 mt-3 d-flex justify-content-center">
                                        {!! $devis->links() !!}
                                      </div>
                                </table>
                                  </div>
          
                            </div>
                          </li>
                          <li>
                            <input type="radio" name="tabs" id="tab3" />
                            <label for="tab3"
                                    role="tab" 
                                    aria-selected="false" 
                                    aria-controls="panel3" 
                                    tabindex="0">Resumes/Compte-rendus<sup><span class="badge badge-warning">{{App\Models\Summary::count()}}</span></sup></label>
                            <div id="tab-content3" 
                                  class="tab-content"
                                  role="tabpanel" 
                                  aria-labelledby="reparations" 
                                  aria-hidden="true">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                  <table class="table table-striped table-hover col-md-12">
                                    <thead class=""  style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);">
                                    <tr style="text-align: center">
                                        <th style="color: white;">#</th>
                                        <th style="color: white;">Entree Garage</th>
                                        <th style="color: white;">Sortie Garage</th>
                                        <th style="color: white;">Mecanicien Chef</th>
                                        <th style="color: white;">Voiture</th>
                                    </tr>
                                        </thead>
                                    @foreach ($interventions as $intervention)
                                    <tr style="text-align: center">
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        
                                    </tr>
                                    
                                    @endforeach
                                      <div class="col-md-12 mt-3 d-flex justify-content-center">
                                        {!! $summaries->links() !!}
                                      </div>
                                </table>
                                  </div>
                            </div>
                          </li>
                          <li>
                            <input type="radio" name="tabs" id="tab4" />
                            <label for="tab4"
                                    role="tab" 
                                    aria-selected="false" 
                                    aria-controls="panel4" 
                                    tabindex="0">Factures <sup><span class="badge badge-primary">{{App\Models\Facture::count()}}</span></sup></label>
                            <div id="tab-content4" 
                                  class="tab-content"
                                  role="tabpanel" 
                                  aria-labelledby="factures" 
                                  aria-hidden="true">
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                             <table class="table table-striped table-hover col-md-12">
                                    <thead class=""  style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);">
                                    <tr style="text-align: center">
                                        <th style="color: white;">#</th>
                                        <th style="color: white;">Date Edition</th>
                                        <th style="color: white;">Date Expiration</th>
                                        <th style="color: white;">Couts</th>
                                        <th style="color: white;">Client</th>
                                    </tr>
                                        </thead>
                                    @foreach ($interventions as $intervention)
                                    <tr style="text-align: center">
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                                        
                                    </tr>
                                    
                                    @endforeach
                                </table>
                                  </div>
                                {{-- <div class="col-md-12 mt-3 d-flex justify-content-center">
                                  {!! $interventions->links() !!}
                                </div> --}}
                            </div>
                          </li>
                      </ul>
          
                   <br style="clear: both;" />
          
                  </div>
              </div>
                    
              </div>
            </div>
          </div>
        </div>
    
   

    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showDiagnostic(id)
		{
       
			window.location = 'diagnostics/'+id ;
		}
    
  setInterval(function(){
  $.ajax({
    method:'get',
    url:'/api/devis-list',
    success:function(data){
    console.log('ici');
    }
  })
  }, 3000);  



 

 
	</script>

@endsection