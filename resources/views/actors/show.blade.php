@extends('layout.index')
@section('content')
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
                          </div>
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