@extends('layout.index')

@section('content')

@include('voitures._partials.carinformation')

<br>

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
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
              <div class="card border-3 border-top border-top-primary">
                  <div class="card-body">
                      <h5 class="text-muted">Date d'examination</h5>
                      <div>
                        <p align="center">{{$diagnostic->created_at}}</p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Chef d'opération</h5>
                    <div>
                      <p align="center">{{$diagnostic->intervention()->first()->user()->first()->name}}</p>
                    </div>
                </div>
            </div>
          </div>


          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Constat</h5>
                    <div style="margin-left: 10%">
                      <p>{{$diagnostic->constat}}</p>
                    </div>
                </div>
            </div>
          </div>


      </div>
    </div>


          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <table id="example4" class="table  table-striped table-bordered table-borderless">
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

          <style>
            th{
              background-color:#4656E9 !important;
              color: white !important;
            }
          </style>
    
@endsection