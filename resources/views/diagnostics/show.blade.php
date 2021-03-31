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

    <br>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
              <div class="col-xs-1 col-sm-1 col-md-1">
                  <table class="table table-borderless">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col" style="text-align: center"><i class="fas fa-user"></i>N°</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="text-align: center">{{$diagnostic->id}}</td>
                      </tr>
                    </tbody>
                  </table>               
              </div>
              <div class="col-xs-4 col-sm-4 col-md-4">
                  <table class="table table-borderless">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col" style="text-align: center"><i class="fas fa-search"></i> Constat</th>
                        <th scope="col" style="text-align: center"><i class="far fa-calendar-alt"></i> Date d'examination</th>
                        <th scope="col" style="text-align: center"><i class="fas fa-user"></i> Chef d'opération</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th style="text-align: center" scope="row">{{$diagnostic->constat}}</th>
                        <td style="text-align: center">{{$diagnostic->created_at}}</td>
                        <td style="text-align: center">{{$diagnostic->intervention()->first()->user()->first()->name}}</td>
                      </tr>
                    </tbody>
                  </table>               
              </div>
              <div class="col-xs-7 col-sm-7 col-md-7">
                <table class="table table-borderless">
                  <thead>
                    <tr class="table-primary">
                      <th scope="col" style="text-align: center"><i class="fas fa-key"></i> </th>
                      <th scope="col" style="text-align: center"><i class="fas fa-link"></i> Localisation</th>
                      <th scope="col" style="text-align: center"><i class="fas fa-info-circle"></i> Description</th>
                      <th scope="col" style="text-align: center">Etat</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($diagnostic->defauts()->get() as $defaut)
                    <tr>
                      <td scope="row" style="text-align: center">{{$defaut->code}}</td>
                      <td style="text-align: center">{{$defaut->localisation}}</td>
                      <td style="text-align: center">{{$defaut->description}}</td>
                      @if($defaut->etat==1)
                      <td style="text-align: center" title='Bon Etat'><i class="fas fa-thumbs-up " style="color:green"></i></td>
                      @elseif($defaut->etat==2)
                      <td style="text-align: center" title="A Reparer"><i class="fas fa-minus-circle"></i></td>
                      @else
                      <td style="text-align: center" title='defectueux'><i class="fas fa-ban" style="color:red"></i></td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    
@endsection