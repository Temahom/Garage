@extends('layout.index')
@section('content')
<style>
  .nav-link_1.active,
  .nav-pills .show>.nav-link{
    background-color:#4656E9!important;
    color:#ffffff;
    padding: 10px;
    margin: 10px;
    border-radius:0 20% 0 20%;
    text-align: center;
    font-size: 16px;
  }
</style>
    <div class="row ml-1" style="justify-content:center;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <div  class="card d-flex justify-content-center mr-2" style="width: 18rem; justify-content: center; text-align: center; cursor: pointer;">
                        @if(isset($user->image))
                          <img class="d-flex justify-content-center " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="{{asset('images/'.$user->image)}}" alt="Card image cap">
                        @else
                          <img class="d-flex justify-content-center " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="https://ui-avatars.com/api/?background=random&color=fff&name={{ $user->name}}" alt="Card image cap">
                        @endif
                          <div class="card-body" style="justify-content: center; text-align: center;">
                         <h5 class="card-title">{{ $user->name}}</h5>
                            <p class="card-text"><a style="text-decoration: none;" href="mailto:{{ $user->email}}">{{ $user->email}} </a><br> <span class="{{$user->role()->first()->role=='Admin'? 'badge badge-success':'badge badge-primary'}}">{{ $user->role()->first()->role}}</span> </p>
                            <a href="{{ route('actors.edit',$user->id) }}" class="btn btn-primary btn-blok"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('actors.show',$user->id) }}" class="btn btn-danger btn-blok"><i class="fas fa-trash"></i></a>
                          </div>  </div>
            </div>
        </div> 
        
        <div class="row">
          <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link_1 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Client</a>
              <a class="nav-link_1" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Voiture</a>
              <a class="nav-link_1" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Interventions</a>
              
            </div>
          </div>
          <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                
                  <div class="pull-right py-3">
                     <caption>Liste Operations</caption>
                   </div>
                   <table class="table table-striped table-hover">
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
                            <td>{{isset($intervention->diagnostic)?$intervention->diagnostic->first()->constat:'en attente'}}</td>
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


        
          {{-- <div class="row">
            <div class="col-md-12 mt-3 d-flex justify-content-center">
                {!! $interventions->links() !!}
            </div>
        </div> --}}
         <div class="row">
             <div class="col-md-12 ml-3 mt-3">
                 <a class="btn btn-secondary" href="{{ route('actors.index') }}"><i class="fas fa-angle-left"></i> Retour</a>
             </div>
          </div>
            
     </div>

    </div>

@endsection    