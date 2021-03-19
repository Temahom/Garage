@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Diagnostic</h2>
                <a href="/diag-pdf/{{$diagnostic->id}}" class="btn btn-success mb-2">PDF</a>
            </div>
        </div>
    </div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 row">  
    <div class="row ml-1">
        <div class="col-md-7 pt-3"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
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
    
                    <div style="font-size: 14px;"> {{ $voiture->marque}} {{ $voiture->model}} {{ $voiture->annee}}</div>
                    <div style="font-size: 14px;"> {{ $voiture->carburant}}</div>
                    <div style="font-size: 14px;"> {{ $voiture->puissance}} cheveaux</div>
                    <div class="text-right" style="font-size: 12px;">
                        <a class="text-primary mr-1" href="{{ route('voitures.edit',$voiture->id)}}">Modifier</a> 
                        <button type="button" class="text-danger" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $voiture->id }}">
                            Supprimer
                        </button>
                        <div class="modal fade" id="exampleModal{{ $voiture->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5>Voulez vous supprimer: <strong>{{ $voiture->matricule }}</strong>  ?</h5>
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
    </div>

  
    <div class="row" style="margin-top: 30px">
        <div class="col-2">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Resume</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Details</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Historique</a>
          </div>
        </div>
        <div class="col-10">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <table class="table table-borderless">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col" ><i class="fas fa-search"></i> Constat</th>
                        <th scope="col"><i class="far fa-calendar-alt"></i> Date d'examination</th>
                        <th scope="col"><i class="fas fa-user"></i> Chef d'opération</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">{{$diagnostic->constat}}</th>
                        <td>{{$diagnostic->created_at}}</td>
                        <td>{{$diagnostic->intervention()->first()->user()->first()->name}}</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <table class="table table-borderless">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col"><i class="fas fa-key"></i> </th>
                        <th scope="col"><i class="fas fa-link"></i> Localisation</th>
                        <th scope="col"><i class="fas fa-info-circle"></i> Description</th>
                        <th scope="col">Etat</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagnostic->defauts()->get() as $defaut)
                      <tr>
                        <td scope="row">{{$defaut->code}}</td>
                        <td>{{$defaut->localisation}}</td>
                        <td>{{$defaut->description}}</td>
                        @if($defaut->etat==1)
                        <td title='Bon Etat'><i class="fas fa-thumbs-up " style="color:green"></i></td>
                        @elseif($defaut->etat==2)
                        <td title="A Reparer"><i class="fas fa-minus-circle"></i></td>
                        @else
                        <td title='defectueux'><i class="fas fa-ban" style="color:red"></i></td>
                        @endif
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
    
@endsection