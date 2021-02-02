<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:280px" name="description" rows="30" placeholder="Entrer les observation issus du diagnostic"> {{ isset($diagnostic) ? $diagnostic->description :''}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <a class="btn btn-secondary" href="{{ route('voitures.interventions.show',['voiture' => $voiture->id, 'intervention' => $intervention->id]) }}">Retour</a>
                <button type="submit" class="btn btn-success">Ajouter une diagnostic</button>
            </div>
</div>