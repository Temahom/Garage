<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Matricule:</strong>
                    <input type="text" name="matricule" value="{{old('matricule'), isset($voiture) ? $voiture->matricule :''}} " class="form-control @error('matricule') is-invalid @enderror" placeholder="Saisir matricule...">
                    <div class="invalid-feedback">
                            @if($errors->has('matricule'))
                               {{ $errors->first('matricule') }}
                           @endif
                    </div>
                </div>
                 <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Marque</strong>
                    <input type="text" name="marque" value="{{old('marque'), isset($voiture) ? $voiture->marque :''}}" class="form-control   @error('marque') is-invalid @enderror" placeholder="Saisir marque...">
                    <div class="invalid-feedback">
                            @if($errors->has('marque'))
                               {{ $errors->first('marque') }}
                           @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Model</strong>
                    <input type="text" name="model" value="{{ old('model'), isset($voiture) ? $voiture->model :''}}" class="form-control  @error('model') is-invalid @enderror " placeholder="Saisir model...">
                    <div class="invalid-feedback">
                            @if($errors->has('model'))
                               {{ $errors->first('model') }}
                           @endif
                    </div>
                </div>
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Annee</strong>
                    <input type="number" name="annee" value="{{ old('annee'), isset($voiture) ? $voiture->annee :''}}" class="form-control  @error('annee') is-invalid @enderror" placeholder="Saisir annee...">
                    <div class="invalid-feedback">
                            @if($errors->has('annee'))
                               {{ $errors->first('annee') }}
                           @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Carburant</strong>
                    <input type="text" name="carburant" value="{{old('carburant'), isset($voiture) ? $voiture->carburant :''}}" class="form-control  @error('carburant') is-invalid @enderror" placeholder="Saisir carburant...">
                    <div class="invalid-feedback">
                            @if($errors->has('carburant'))
                               {{ $errors->first('carburant') }}
                           @endif
                    </div>
                </div>
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Puissance</strong>
                    <input type="text" name="puissance" value="{{old('puissance'), isset($voiture) ? $voiture->puissance :''}}" class="form-control  @error('puissance') is-invalid @enderror" placeholder="Saisir puissance...">
                    <div class="invalid-feedback">
                            @if($errors->has('puissance'))
                               {{ $errors->first('puissance') }}
                           @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Proprietaire</strong>
                    <select name="client_id" class="custom-select form-control  @error('client_id') is-invalid @enderror">
                       <option value="{{ isset($client_default) ? $client_default->id:''}}">{{ isset ($client_default) ? $client_default->prenom.' '.$client_default->nom:''}}</option>
                      @foreach( $clients as $client ) 
                       <option value="{{$client->id}}">{{$client->prenom.' '.$client->nom}}</option>
                      @endforeach 
                    </select>
                    <div class="invalid-feedback">
                            @if($errors->has('client_id'))
                               {{ $errors->first('client_id') }}
                           @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ route('voitures.index') }}">Retour</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

 </div>