@extends('layout.index')
@php
setlocale(LC_TIME, "fr_FR", "French");
$date = new DateTime('now', new DateTimeZone('UTC'));
use Carbon\Carbon;
  $interventionsInachevee=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('statut','!=',3)->count();
  $interventionsAchevee=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('statut','=',3)->count();
  if($interventionsInachevee + $interventionsAchevee != 0){
    $score = ($interventionsAchevee*100)/($interventionsInachevee + $interventionsAchevee);
  }
  else $score = '';

  $interventionsInachevee2=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->where('statut','!=',3)->count();
  $interventionsAchevee2=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->where('statut','=',3)->count();
  if($interventionsInachevee2 + $interventionsAchevee2 != 0){
    $score2 = ($interventionsAchevee2*100)/($interventionsInachevee2 + $interventionsAchevee2);
  }
  else $score2='';

  $interventionsInachevee3=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->where('statut','!=',3)->count();
  $interventionsAchevee3=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->where('statut','=',3)->count();
  if($interventionsInachevee3 + $interventionsAchevee3 != 0){
    $score3 = ($interventionsAchevee3*100)/($interventionsInachevee3 + $interventionsAchevee3);
  }
  else $score3='';
 
  $nombreVoitures=\App\Models\Voiture::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('user_id','=', $user->id)->get();
  $nombreVoitures2=\App\Models\Voiture::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->where('user_id','=', $user->id)->get();
  $nombreVoitures3=\App\Models\Voiture::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->where('user_id','=', $user->id)->get();

  $nombreInterventions=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('user_id','=', $user->id)->get();
  $nombreInterventions2=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->where('user_id','=', $user->id)->get();
  $nombreInterventions3=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->where('user_id','=', $user->id)->get();

  $nombreClients=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('user_id','=', $user->id)->get();
  // dd($nombreClients);
  $nombreClients2=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->where('user_id','=', $user->id)->get();
  $nombreClients3=\App\Models\Client::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-2)->where('user_id','=', $user->id)->get();

 
   $interventionsAchevee2=\App\Models\Intervention::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month-1)->where('statut','=',3)->count();
@endphp

@section('content')

<style>

  .tab-outline .nav.nav-tabs .nav-item .nav-link {
    display: block;
    padding: 3px !important;
    color: #71748d;
    background-color: #e9e9f2;
    border-color: #c4c4cf #c4c4cf #c4c4cf;
    margin-right: 3px;
    overflow-x: auto;
}
  .nav-link_1.active,
  .nav-pills .show .nav-link{
    background-color: gray!important;
    color:#ffffff;
    padding: 5px;
    margin: 5px;
    border-radius:0 20% 0 20%;
    text-align: center;
    font-size: 16px;
  }

</style>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div  class="card d-flex justify-content-center mr-2" style="width: 18rem; justify-content: center; text-align: center; cursor: pointer;">
                        @if(isset($user->image))
                          <img class="d-flex justify-content-center " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="{{asset('images/'.$user->image)}}" alt="Card image cap">
                        @else
                          <img class="d-flex justify-content-center " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="https://ui-avatars.com/api/?background=random&color=fff&name={{ $user->name}}" alt="Card image cap">
                        @endif
                          <div class="card-body" style="justify-content: center; text-align: center;">
                         <h5 class="card-title">{{ $user->name}}</h5>
                            <p class="card-text"><a style="text-decoration: none;" href="mailto:{{ $user->email}}">{{ $user->email}} </a><br> <span class="{{$user->role()->first()->role=='Admin'? 'badge badge-success':'badge badge-primary'}}">{{ $user->role()->first()->role}}</span> </p>
                            @can('update', $user)
                            <a href="{{ route('actors.edit',$user->id) }}" class="btn btn-primary btn-blok"><i class="fas fa-edit"></i></a>
                            @endcan
                            {{-- <a href="{{ route('actors.show',$user->id) }}" class="btn btn-danger btn-blok"><i class="fas fa-trash"></i></a> --}}
                          </div>  
                    </div>
                  </div>
                </div> 
        
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="tab-outline">
                      <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link nav-link_1 active" id="v-pills" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Statistique Taches</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link nav-link_1" id="v-pills" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Historique Interventions</a>             
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                

              <div class="row tableau">
                <div class="col-xs-12 col-sm-12 col-md-12"> 
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div class="card" style="width: 98%">
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table class="table  table-striped table-bordered" style="width: 100%;">
                                      <thead class="" style="background-color: #4656E9;">
                                          @if($user->id == 3)
                                                <tr> 
                                                    <th style="color: white;">Periodes</th>
                                                    <th style="color: white;">Taches Achevées</th>
                                                    <th style="color: white;">Taches Innachevées</th>
                                                    <th style="color: white;">Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Il y'a 0 à 30 jours</td>
                                                    <td>{{$interventionsAchevee}} {{$interventionsAchevee>1?"taches":"tache"}} </td>
                                                    <td>{{$interventionsInachevee}} {{$interventionsInachevee>1?"taches":"tache"}}</td>
                                                    <td>{{$score}} %</td>
                                                </tr>
                                                <tr>
                                                    <td>Il y'a 2mois</td>
                                                    <td>{{$interventionsAchevee2}} {{$interventionsAchevee2>1?"taches":"tache"}} </td>
                                                    <td>{{$interventionsInachevee2}} {{$interventionsInachevee2>1?"taches":"tache"}}</td>
                                                    <td>{{$score2}} %</td>
                                                </tr>
                                                <tr>
                                                    <td>Il y'a 3mois</td>
                                                    <td>{{$interventionsAchevee3}} {{$interventionsAchevee3>1?"taches":"tache"}} </td>
                                                    <td>{{$interventionsInachevee3}} {{$interventionsInachevee3>1?"taches":"tache"}}</td>
                                                    <td>{{$score3}} %</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td style="font-size: 15px; font-weight: bold;" colspan="9"><span class="float-right"><strong>Score Global: {{($score+$score2+$score3)/3}} %</strong></span></td>
                                                </tr> --}}
                                              @else
                                              <tr class="border-0">
                                                <th class="border-0" style="color: white;">Periodes</th>
                                                <th class="border-0" style="color: white;">Nombre de Clients Enregistrés</th>
                                                <th class="border-0" style="color: white;">Nombres de Voitures Enrisgistrées</th>
                                                <th class="border-0" style="color: white;">Nombre de travaux assignés</th>
                                              </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Il y'a 0 à 30 jours</td>
                                          <td>{{$nombreClients->count()}}</td>
                                          <td>{{$nombreVoitures->count()}} {{$nombreVoitures->count()>1?"voitures":"voiture"}}</td>
                                          <td>{{$nombreInterventions->count()}} {{$nombreInterventions->count()>1?"interventions":"intervention"}}</td>
                                      </tr>
                                      <tr>
                                          <td>Il y'a 2mois</td>
                                          <td>{{$nombreClients2->count()}} {{$nombreClients2->count()>1?"clients":"client"}} </td>
                                          <td>{{$nombreVoitures2->count()}} {{$nombreVoitures2->count()>1?"voitures":"voiture"}}</td>
                                          <td>{{$nombreInterventions2->count()}} {{$nombreInterventions2->count()>1?"interventions":"intervention"}}</td>
                                      </tr>
                                      <tr>
                                          <td>Il y'a 3mois</td>
                                          <td>{{$nombreClients3->count()}} {{$nombreClients2->count()>1?"clients":"client"}}</td>
                                          <td>{{$nombreVoitures3->count()}} {{$nombreVoitures3->count()>1?"voitures":"voiture"}}</td>
                                          <td>{{$nombreInterventions3->count()}} {{$nombreInterventions3->count()>1?"interventions":"intervention"}}</td>
                                      </tr>
                                        @endif  
                                      </tbody>
                                  </table>
                                 
                              </div>
                          </div>
                      </div>
                    </div>
                 
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">               
                          <div class="card" style="width: 98%">
                            <!--<div class="titre" style="text-align: center;">                           
                                <h3><mark style=" background-color:#4656E990; color: white; padding: 8px">Liste Opérations</mark></h3>
                            </div>-->
                            
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table id="example4" class="table  table-striped table-bordered" style="width:100%">
                                          <thead class="" style="background-color: #4656E9;">
                                              @if ($role->id != 3 )
                                                <tr>
                                                    <td style="color:#ffffff">Type</td>
                                                    <td style="color:#ffffff">Constat</td>
                                                    <td style="color:#ffffff">Voiture</td>
                                                    <td style="color:#ffffff">Date Operation</td>
                                                    <td style="color:#ffffff">Chargé d'Operation</td>
                                                </tr> 
                                              @else
                                                <tr>
                                                  <td style="color:#ffffff">Tache</td>
                                                  <td style="color:#ffffff">Diagnostic</td>
                                                  <td style="color:#ffffff">Devis</td>
                                                  <td style="color:#ffffff">Reparation</td>
                                                  <td style="color:#ffffff">Date Attribution</td>
                                                  <td style="color:#ffffff">Voiture</td>
                                                  <td style="color:#ffffff">Attribué par</td>
                                                </tr>
                                            @endif
                                          </thead>
                                            @if ($role->id != 3 )
                                              @foreach ($interventions_manager as $intervention)
                                                <tr>
                                                    <td>{{$intervention->type}}</td>
                                                    <td>{{isset($intervention->diagnostic)?$intervention->diagnostic->first()->constat:''}}</td>
                                                    <td title="{{$intervention->voiture()->first()->marque}} {{$intervention->voiture()->first()->model}}">{{$intervention->voiture()->first()->matricule}}</td>
                                                    <td>{{$intervention->debut}}</td>
                                                    <td>{{App\Models\User::find($intervention->technicien)->name}}</td>
                                                </tr>   
                                              @endforeach 
                                              @else
                                              @foreach ($interventions_technicien as $intervention)
                                                <tr>
                                                  <td>{{$intervention->type}}</td>
                                                  <td>{{isset($intervention->diagnostic)?$intervention->diagnostic->first()->constat:'en attente'}} </td>
                                                  <td>{{isset($intervention->devi)?$intervention->devi->first()->cout:'en attente'}}</td>
                                                  <td>{{isset($intervention->reparation)?$intervention->reparation->first()->element_3:'en attente'}}</td>
                                                  <td>{{$intervention->debut}}</td>
                                                  <td>{{$intervention->voiture()->first()->matricule}}</td>
                                                  <td>{{$intervention->user()->first()->name}}</td>
                                                </tr>
                                              @endforeach
                                            @endif
                                    </table>              
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
              </div>
        
                  {{-- <div class="row">
                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                        {!! $interventions->links() !!}
                    </div>
                  </div> --}}
                    
                        <div class="col-md-12 ml-3 mt-3">
                            <a class="btn btn-secondary" href="{{ route('actors.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
                        </div>
                        <br>

    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
 
@endsection    
