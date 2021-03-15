@extends('layout.index')
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <form action="">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
              <textarea class="description" name="description">{{$summary->resume}}</textarea>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                <a class="btn btn-secondary"  href="/interventions-list"><i class="fas fa-angle-left"></i>  Retour</a>
            </div>
        </form> 
    </div>     
</div> 
{{-- ------formateur de texte dans summary(compte rendu)------- --}}
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector:'textarea.description',
        // width: 900,
        height: 300
    });
</script>
{{-- ----------------------end-----------------    --}}       
@endsection
    