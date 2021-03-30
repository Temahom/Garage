@extends('layout.index')

@section('content')

@include('voitures._partials.carinformation')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Diagnostic</h2>
                <a href="/diag-pdf/{{$diagnostic->id}}" class="btn btn-success mb-2">PDF</a>
            </div>
        </div>
    </div>

      <div class="row" style="margin-top: 30px">
        <div class="col-xs-12 col-sm-12 col-md-12 row">
          <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Resume</a>
              <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Details</a>
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
    
@endsection