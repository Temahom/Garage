<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" style="height:280px" name="description" rows="30" placeholder="Entrer les observation issus du diagnostic"> {{ isset($diagnostic) ? $diagnostic->description :''}}</textarea>
            </div>
                @if($errors->has('description'))
                    <p>{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-primary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>