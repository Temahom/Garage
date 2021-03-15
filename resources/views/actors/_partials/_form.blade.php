
<div class="row">

<div class="col-xs-12 col-sm-12 col-md-12 row">
  
<div class="col-xs-6 col-sm-6 col-md-6">
  
  <div class="form-group">
    <strong>Role</strong>
    <select name="role_id" class="custom-select form-control @error('role_id') is-invalid @enderror">
      @if(!empty($role->id))
        <option value="{{$role->id}}" >{{$role->role}}</option>
      @else   
      @foreach( $roles as $role ) 
        <option value="{{$role->id}}"  {{$user->role_id == $role->id ? 'selected':'' }}>{{$role->role}}</option>
      @endforeach 
        @endif
    </select>
    <div class="invalid-feedback">
      @if($errors->has('role_id'))
        Le champs role est obligatoire.
      @endif
    </div>
  </div>
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 row">

<div class="col-xs-6 col-sm-6 col-md-6">

  <div class="form-group">
    <strong>Prenom | Nom</strong>
    <input type="text" name="name" value="{{ isset($user) ? $user->name:''}} {{ old('name') }}" autocomplete="off" class="custom-select form-control @error('name') is-invalid @enderror" placeholder="Saisir Prenom | Nom..." >
    <div class="invalid-feedback">
        @if($errors->has('name'))
          {{ $errors->first('name') }}
        @endif
      </div>
  </div>

  <div class="form-group">
    <strong>Adresse Email</strong>
    <input type="text" name="email" value="{{ isset($user) ? $user->email:''}} {{ old('email') }}" autocomplete="off" class="custom-select form-control @error('email') is-invalid @enderror" placeholder="Saisir Email...">
    <div class="invalid-feedback">
        @if($errors->has('email'))
          {{ $errors->first('email') }}
        @endif
      </div>
  </div>
  @if(!isset($user->id))
  <div class="form-group">
    <strong>Photo Profil</strong>
    <div class="input-group mb-3 is-invalid">
      <input type="file" class="form-control  @error('image') is-invalide @enderror" name="image" value="1">
    </div>
      @error('image')
      <div class="invalid-feedback">{{$errors->first('image')}}</div>
      @enderror
  </div>  
  @endif  

  
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 mt-4">
<a class="btn btn-secondary" href="{{ route('actors.index') }}">Retour</a>
<button type="submit" class="btn btn-success">Enregistrer</button>
</div>

</div>