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
         @import url("https://fonts.googleapis.com/css?family=Lato");
        

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
            background: #4656E9;
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
            padding-top: 17px;
            background: #101010;
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

    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif
    <div class="row">
        <div class="col-lg-11 col-md-12">
            
            <ul class="tabs" role="tablist">
                <li>
                  <input type="radio" name="tabs" id="tab1" checked />
                  <label for="tab1" 
                          role="tab" 
                          aria-selected="true" 
                          aria-controls="panel1" 
                          tabindex="0">Diagnostics <span class="badge badge-warning">{{count($diagnostics)}}</span></label>
                  <div id="tab-content1" 
                        class="tab-content" 
                        role="tabpanel" 
                        aria-labelledby="diagnostics" 
                        aria-hidden="false">
                        <div class="col-xs-12 col-sm-12 col-md-12 row"><br>
          
                          <table class="table table-striped table-hover col-md-12">
                          <tr>
                              <th style="color: white;">#</th>
                              <th style="color: white;">Constat</th>
                              <th style="color: white;">Date Edition</th>
                              <th style="color: white;">Voiture</th>
                          </tr>
                              </thead>
                          @foreach ($interventions as $intervention)
                          <tr>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                          </tr>
                          @endforeach
                      </table>
                  </div>
                </li>

                <li>
                  <input type="radio" name="tabs" id="tab2" />
                  <label for="tab2"
                          role="tab" 
                          aria-selected="false" 
                          aria-controls="panel2" 
                          tabindex="0">Devis <span class="badge badge-primary">{{count($devis)}}</span></label>
                  <div id="tab-content2" 
                        class="tab-content"
                        role="tabpanel" 
                        aria-labelledby="devis" 
                        aria-hidden="true">
                    
                        <table class="table table-striped table-hover col-md-12">
                          <thead class="" style="background-color: #4656E9;">
                          <tr>
                              <th style="color: white;">#</th>
                              <th style="color: white;">Date Edition</th>
                              <th style="color: white;">Date Expiration</th>
                              <th style="color: white;">Cout</th>
                              <th style="color: white;">Client</th>
                              <th style="color: white;">Etat</th>
                          </tr>
                              </thead>
                          @foreach ($devis as $key=>$devi)
                          <tr>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;">{{$key+1}}</td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;">{{date_format($devi->devi()->first()->created_at, 'd-m-Y | H:i:s')}}</td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;">{{number_format($devi->devi()->first()->cout)}} <sup>Fcfa</sup></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;">{{$devi->voiture()->first()->client()->first()->prenom.' '.$devi->voiture()->first()->client()->first()->nom}}</td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                          </tr>
                          
                          @endforeach
                      </table>

                  </div>
                </li>
                <li>
                  <input type="radio" name="tabs" id="tab3" />
                  <label for="tab3"
                          role="tab" 
                          aria-selected="false" 
                          aria-controls="panel3" 
                          tabindex="0">Reparations <span class="badge badge-warning">{{count($reparations)}}</span></label>
                  <div id="tab-content3" 
                        class="tab-content"
                        role="tabpanel" 
                        aria-labelledby="reparations" 
                        aria-hidden="true">
                        <table class="table table-striped table-hover col-md-12">
                          <thead class="" style="background-color: #0E0C28;">
                          <tr>
                              <th style="color: white;">#</th>
                              <th style="color: white;">Entree Garage</th>
                              <th style="color: white;">Sortie Garage</th>
                              <th style="color: white;">Mecanicien Chef</th>
                              <th style="color: white;">Voiture</th>
                          </tr>
                              </thead>
                          @foreach ($interventions as $intervention)
                          <tr>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              
                          </tr>
                          
                          @endforeach
                      </table>
                  </div>
                </li>
                <li>
                  <input type="radio" name="tabs" id="tab4" />
                  <label for="tab4"
                          role="tab" 
                          aria-selected="false" 
                          aria-controls="panel4" 
                          tabindex="0">Factures <span class="badge badge-primary">{{count($factures)}}</span></label>
                  <div id="tab-content4" 
                        class="tab-content"
                        role="tabpanel" 
                        aria-labelledby="factures" 
                        aria-hidden="true">
                   <table class="table table-striped table-hover col-md-12">
                          <thead class="" style="background-color: #4656E9;">
                          <tr>
                              <th style="color: white;">#</th>
                              <th style="color: white;">Date Edition</th>
                              <th style="color: white;">Date Expiration</th>
                              <th style="color: white;">Couts</th>
                              <th style="color: white;">Client</th>
                          </tr>
                              </thead>
                          @foreach ($interventions as $intervention)
                          <tr>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              <td onclick="showVoiture({{ $intervention->id }})" style="cursor: pointer; text-transform: capitalize;"></td>
                              
                          </tr>
                          
                          @endforeach
                      </table>
                  </div>
                </li>
            </ul>

         <br style="clear: both;" />

        </div>
    </div>
     
    

    <div class="row">
		<div class="col-md-12 mt-3 d-flex justify-content-center">
			{!! $interventions->links() !!}
		</div>
	</div>

    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

	<script>
		function showVoiture(id)
		{
			window.location = 'voitures/' + id ;
		}
	</script>

@endsection