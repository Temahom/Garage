@extends('layout.index')
@section('content')
    <div class="row ml-1">
        <div class="col-md-5 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
            <div class="row">

                <div class="col-md-2 col-sm-3 text-center pt-3">
                    @if ($user->role()->first()->role == "admin")
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/feminin.png" alt="logo">
                    @else
                        <img style="height: 50px;width: auto;" class="" src="/assets/images/masculin.png" alt="logo">
                    @endif
                </div>

                <div class="col-md-9 col-sm-10">
                    <div style="font-size: 20px; color: #2EC551">{{ $user->name}}</div>
                    <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{ $user->email}}</div>
                    <div style="font-size: 14px;"><i class="fas fa-users-cog"></i> {{ $user->role()->first()->role}}</div>
                    {{-- <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{ $client->email}}</div> --}}
                </div>

            </div>
        </div>    
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
            <div class="pull-right py-3">
                 <a class="btn btn-secondary" href="#"><i class="fas fa-plus"></i> Attribuer Tache(s)</a>
             </div>
             <form>
                <div class="form-group">
                  <label for="formControlRange">Example Range input</label>
                  <input type="range" class="form-control-range" id="formControlRange" min="1" max="12" value="12" step="1">
                </div>
              </form>
             <table class="table table-striped table-hover">
                 <thead class="" style="background-color: #4656E9;">
                     <tr>
                         <th style="color: white;">Categorie</th>
                         <th style="color: white;">Description</th>
                         <th style="color: white;">Date Debut</th>
                         <th style="color: white;">Duree Estimative</th>
                         <th style="color: white;">Statut</th>
                     </tr>
                 </thead>
                 @foreach ($interventions as $intervention)
                 <tr>
                    <td>{{$intervention->type}}</td>
                    <td>{{isset($intervention->diagnostic)?$intervention->diagnostic->first()->description:''}}</td>
                    <td>{{$intervention->debut}}</td>
                    <td>2 jours</td>
                    <td style="color: red;">en cours</td>
                </tr>   
                 @endforeach
             </table>
          </div>
          <div class="row">
            <div class="col-md-12 mt-3 d-flex justify-content-center">
                {!! $interventions->links() !!}
            </div>
        </div>
         <div class="row">
             <div class="col-md-12 ml-3 mt-3">
                 <a class="btn btn-secondary" href="{{ route('actors.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
             </div>
          </div>
            
     </div>

    </div>

@endsection    