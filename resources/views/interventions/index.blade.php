@extends('layout.index')

@section('content')

<style>

                  
@media screen and (max-width: 767px) {
  .row {
          overflow-x: auto !important;
  }

  }                            

    .nav-link_1.active,
    .nav-pills .show>.nav-link{
    background-color:#1B192E!important;
    color:#ffffff;
    padding: 12px;
    border-radius:20px;
    font-size: 16px;
    }
    .nav-link_1.active:hover,
    .nav-pills .show>.nav-link:hover{
    background-color:#1B192E!important;
    color:#ffffff;
    padding: 12px;
    border-radius:20px;
    text-align: center;
    font-size: 16px;
    }

    .second{
      margin:7px;
      background-color:#F9F8F9!important;
    color:#737373;
    padding: 12px;
    border-radius:20px;
    font-size: 16px;
    }
    /* .third{
      margin-left:25px;
    } */

 
    
/* --------------------radial_progress--------------- */
.pie {
position: relative;
display: inline-block;
background-image: conic-gradient(
rgba(0,0,0,0) calc(3.6deg * var(--percent)),
rgba(0,0,0,1) calc(3.6deg * var(--percent))
);
background-blend-mode: overlay;
background-position: 50% 50%;
background-size: 150%; /* oversize bg image to prevent "underdraw" */
width: 3.75em;
height: 3.75em;
border-radius: 50%;
}

/* show the percentage (thanks to Ana Tudor for the counter() trick) */
.pie--value::after {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
counter-reset: percent var(--percent);
content: counter(percent) "%";
color: #fff;
text-shadow: 0 0 1px #000;
}

.pie--disc::before {
content: '';
position: absolute;
top: .5em;
left: .5em;
right: .5em;
bottom: .5em;
border-radius: 50%;
background: #fff;
}

.pie--disc::after {
color: #000;
text-shadow: none;
}


/* demo styles---------------------------------------------------- */

body::before {
color: red;
font-size: 150%;
content: "This browser doesn't support conical graidents yet";
}

@supports (background: conic-gradient(red, blue)) {
body::before {
content: '';
}
}

/* body {
font: 90%/1.5 Arial;
background: #fcf3f0;
text-align: center;
} */

.pie {
border: .15em solid #fff;
box-shadow: 0 .075em .2em .05em rgba(0,0,0,.25);
margin: .75rem;
}
.pie:nth-child(1) {
background-color: #d44;
}
.pie:nth-child(2) {
background-color: #fc3;
}
.pie:nth-child(3) {
background-color: #ac0;
}
.pie:nth-child(4) {
background-color: #0ac;
}
.pie:nth-child(5) {
background-color: #d6b;
}

.big {
  margin-left: 15%;
  font-size: 260%;
}
.med {
font-size: 150%;
}
.sml {
font-size: 100%;
}

/* ------------------------en mode téléphone-------------------------- */

@media screen and (max-width: 767px) {
 
 .big {
         display: none;
 }

 }

</style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Historique Interventions</h2>
            </div>

        </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="big">
          <div  class="pie pie--value pie--disc" style="--percent:{{(App\Models\Diagnostic::count()*100) / App\Models\Intervention::count()}};"></div><label for="diagnostic"><span class="badge badge-danger"> Diagnostics |</span> </label>
          <div  class="pie pie--value pie--disc" style="--percent:{{(App\Models\Devi::count()*100) / App\Models\Intervention::count()}};"></div><label for="devis"><span class="badge badge-success"> Devis |</span></label>
          <div  class="pie pie--value pie--disc" style="--percent:{{(App\Models\Summary::count()*100) / App\Models\Intervention::count()}};"></div><label for="resume"><span class="badge" style="background: #DD66BB; color:#ffffff;"> Compte-Rendus |</span></label>
          <div  class="pie pie--value pie--disc" style="--percent:{{(App\Models\Facture::count()*100) / App\Models\Intervention::count()}};"></div><label for="facture"><span class="badge badge-dark"> Factures |</span></label>
          {{-- <div class="pie pie--disc" style="--percent:40;"></div> --}}
        </div>
      </div>
    </div>

 
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif

        
    <div class="row tab-content-2">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="tab-outline">
            <ul class="nav nav-tabs nav-tabs-2" id="myTab2" role="tablist">
              <li class="nav-item">
                <a class="nav-link_1  second active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Resume</a>
                <a class="nav-link_1 second third" id="v-pills-profile-diagnostic" data-toggle="pill" href="#diagnostic" role="tab" aria-controls="v-pills-diagnostic" aria-selected="false">Diagnostics</a>
                <a class="nav-link_1 second third" id="v-pills-profile-devis" data-toggle="pill" href="#devis" role="tab" aria-controls="v-pills-devis" aria-selected="false">Devis</a>
                <a class="nav-link_1 second third" id="v-pills-profile-resume" data-toggle="pill" href="#resume" role="tab" aria-controls="v-pills-resume" aria-selected="false">Compte-rendus</a>
                <a class="nav-link_1 second third" id="v-pills-profile-facture" data-toggle="pill" href="#facture" role="tab" aria-controls="v-pills-facture" aria-selected="false">Factures</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link_1 second" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Details  <i class="fas fa-angle-down"></i></a>
              </li> --}}
            </ul><br>
          </div>
        </div>
      </div>
          <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="tab-content " id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                 
                <table class="table table-bordered mt-4">
                      <thead>
                        <tr style="background-image: linear-gradient( to top,#2b2a34, #0E0C28); text-align: center">
                          <th scope="col" style= "color:#ffffff" > N<sup>o</sup></th>
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
                <div class="col-md-12 mt-3 d-flex justify-content-center">
                  {!! $interventions->links() !!}
                </div>
              </div>

              <div class="tab-pane fade" id="diagnostic" role="tabpanel" aria-labelledby="v-pills-home-diagnostic">
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <legend><span class="badge badge-light"> Récapitultif-Dignostics <sup> <span class="badge badge-primary">{{App\Models\Diagnostic::count()}}</span></sup></span></legend>
                  <table class="table table-bordered mt-4 table-hover col-md-12">
                    <thead class="" style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);"> 
                        <tr style="text-align: center">
                            <th style="color: white;">N<sup>o</sup></th>
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
                  </table>
                  <div class="col-md-12 mt-3 d-flex justify-content-center">
                    {!! $diagnostics->links() !!}
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="devis" role="tabpanel" aria-labelledby="v-pills-home-devis">
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <legend><span class="badge badge-light"> Récapitultif-Devis <sup> <span class="badge badge-primary">{{App\Models\Devi::count()}}</span></sup></span></legend>
                  <table class="table table-bordered mt-4 table-hover col-md-12">
                    <thead class="" style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);">
                        <tr style="text-align: center">
                            <th style="color: white;">N<sup>o</sup></th>
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
                  </table>
                  <div class="col-md-12 mt-3 d-flex justify-content-center">
                    {!! $devis->links() !!}
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="resume" role="tabpanel" aria-labelledby="v-pills-home-resume">
               
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <legend><span class="badge badge-light"> Récapitultif-Compte-rendus <sup> <span class="badge badge-primary">{{App\Models\Summary::count()}}</span></sup></span></legend>
                  <table class="table table-bordered mt-4 table-hover col-md-12">
                    <thead class=""  style=" background-image: linear-gradient( to top,#2b2a34, #0E0C28);">
                    <tr style="text-align: center">
                        <th style="color: white;">N<sup>o</sup></th>
                        <th style="color: white;">Date Edition</th>
                        <th style="color: white;">Lien contenu</th>
                        <th style="color: white;">Auteur</th>
                        <th style="color: white;">Voiture</th>
                    </tr>
                        </thead>
                    @foreach ($summaries as $summary)
                      <tr style="text-align: center">
                          <td onclick="showVoiture({{ $summary->id }})" style="cursor: pointer; text-transform: capitalize;">{{$summary->summary()->first()->created_at}}</td>
                          <td onclick="showVoiture({{ $summary->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                          <td onclick="showVoiture({{ $summary->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                          <td onclick="showVoiture({{ $summary->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                          <td onclick="showVoiture({{ $summary->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                          
                      </tr>
                    
                    @endforeach
                  </table>
                  <div class="col-md-12 mt-3 d-flex justify-content-center">
                    {!! $summaries->links() !!}
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="facture" role="tabpanel" aria-labelledby="v-pills-home-facture">
                
                     
              </div>
              
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" style="text-align: center;">
                <h1>Vue Proportionnelle des Activites par Rapport au Nombre D'Interventions </h1>
                {{-- <h2>Normal</h2>
                <div class="big">
                  <div class="pie pie--value" style="--percent:35;"></div>
                  <div class="pie pie--value" style="--percent:15;"></div>
                  <div class="pie pie--value" style="--percent:65;"></div>
                  <div class="pie pie--value" style="--percent:85;"></div>
                  <div class="pie" style="--percent:40;"></div>
                </div>
                <div class="med">
                  <div class="pie pie--value" style="--percent:35;"></div>
                  <div class="pie pie--value" style="--percent:15;"></div>
                  <div class="pie pie--value" style="--percent:65;"></div>
                  <div class="pie pie--value" style="--percent:85;"></div>
                  <div class="pie" style="--percent:40;"></div>
                </div>
                <div class="sml">
                  <div class="pie pie--value" style="--percent:35;"></div>
                  <div class="pie pie--value" style="--percent:15;"></div>
                  <div class="pie pie--value" style="--percent:65;"></div>
                  <div class="pie pie--value" style="--percent:85;"></div>
                  <div class="pie" style="--percent:40;"></div>
                </div> --}}
                
                {{-- <h2>Diagramme Circulaire</h2> --}}
                
                {{-- <div class="med">
                  <div class="pie pie--value pie--disc" style="--percent:35;"></div>
                  <div class="pie pie--value pie--disc" style="--percent:15;"></div>
                  <div class="pie pie--value pie--disc" style="--percent:65;"></div>
                  <div class="pie pie--value pie--disc" style="--percent:85;"></div>
                  <div class="pie pie--disc" style="--percent:40;"></div>
                </div> --}}
                {{-- <div class="sml">
                  <div class="pie pie--value pie--disc" style="--percent:35;"></div>
                  <div class="pie pie--value pie--disc" style="--percent:15;"></div>
                  <div class="pie pie--value pie--disc" style="--percent:65;"></div>
                  <div class="pie pie--value pie--disc" style="--percent:85;"></div>
                  <div class="pie pie--disc" style="--percent:40;"></div>
                </div> --}}
                
                {{-- <h2>Dynamically updated (CSS custom property)</h2>
                <div class="big">
                 <div class="js pie pie--value"></div>
                 <div class="js pie pie--value pie--disc"></div>
                 <div class="js pie"></div>
                 <div class="js pie pie--disc"></div>
                </div>
                <div class="med">
                 <div class="js pie pie--value"></div>
                 <div class="js pie pie--value pie--disc"></div>
                 <div class="js pie"></div>
                 <div class="js pie pie--disc"></div>
                </div>
                <div class="sml">
                 <div class="js pie pie--value"></div>
                 <div class="js pie pie--value pie--disc"></div>
                 <div class="js pie"></div>
                 <div class="js pie pie--disc"></div>
                </div>
                 --}}
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
   /* --------------------radial_progress--------------- */
  /* Example code for updating a chart with JS */

function loop(t) {
  requestAnimationFrame(loop);
  updateCharts(Math.floor(t / 16) % 100);
}

function updateCharts(value) {
  charts.forEach(chart => setChartValue(chart, value));
}

function setChartValue(chart, value) {
  chart.style.setProperty('--percent', value);
}

let charts = document.querySelectorAll('.js');

loop();


     /* ------------------------end-------------------------- */

    



 

 
	</script>

@endsection