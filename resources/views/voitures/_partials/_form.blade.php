<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Matricule:</strong>
                    <input type="text" name="matricule" value="{{ isset($voiture) ? $voiture->matricule :''}}" class="form-control" placeholder="Saisir matricule...">
                </div>
                @if($errors->has('matricule'))
                    <p>{{ $errors->first('matricule') }}</p>
                 @endif
                 <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Marque</strong>
                    <input type="text" name="marque" value="{{ isset($voiture) ? $voiture->marque :''}}" class="form-control" placeholder="Saisir marque...">
                </div>
                @if($errors->has('marque'))
                    <p>{{ $errors->first('marque') }}</p>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Model</strong>
                    <input type="text" name="model" value="{{ isset($voiture) ? $voiture->model :''}}" class="form-control" placeholder="Saisir model...">
                </div>
                @if($errors->has('model'))
                    <p>{{ $errors->first('model') }}</p>
                @endif
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Annee</strong>
                    <input type="number" name="annee" value="{{ isset($voiture) ? $voiture->annee :''}}" class="form-control" placeholder="Saisir annee...">
                </div>
                @if($errors->has('annee'))
                    <p>{{ $errors->first('annee') }}</p>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Carburant</strong>
                    <input type="text" name="carburant" value="{{ isset($voiture) ? $voiture->carburant :''}}" class="form-control" placeholder="Saisir carburant...">
                </div>
                @if($errors->has('carbuant'))
                    <p>{{ $errors->first('carburant') }}</p>
                @endif
                <div class="form-group col-xs-6 col-sm-6 col-md-6">
                    <strong>Puissance</strong>
                    <input type="text" name="puissance" value="{{ isset($voiture) ? $voiture->puissance :''}}" class="form-control" placeholder="Saisir puissance...">
                </div>
                @if($errors->has('puissance'))
                    <p>{{ $errors->first('puissance') }}</p>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Proprietaire</strong>
                    <select name="client_id" class="custom-select form-control">
                       <option value="{{ isset($client_default) ? $client_default->id:''}}">{{ isset ($client_default) ? $client_default->prenom.' '.$client_default->nom:''}}</option>
                      @foreach( $clients as $client ) 
                       <option value="{{$client->id}}">{{$client->prenom.' '.$client->nom}}</option>
                      @endforeach 
                    </select>
                </div>
                @if($errors->has('client_id'))
                    <p>{{ $errors->first('client_id') }}</p>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-primary" href="{{ route('voitures.index') }}">Retour</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

 </div>