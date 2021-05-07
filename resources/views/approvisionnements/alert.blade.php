@extends('layout.menu')
@section('content')
<div class="row">
@section('css')
<link rel="stylesheet" href="{{asset('/assets/vendor/multi-select/css/multi-select.css')}}">
<style>
    .titre{
            background-image: linear-gradient(to left, #268956, #332F30);
            color:#fff;
            border-radius:20px;
            padding:0 10px;
            padding:10px;
    }
    .label{
        margin-right: 12px;
    }
</style>
@endsection
<!-- ============================================================== -->
                <!-- keep over multiselectd  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>
                                    <span class="titre label">
                                        <i class="far fa-share-square"></i>
                                        Demande Approvisionnement
                                    </span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Approvisionnement</h5>
                        <form action="{{route('store-demande-appro')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <select id='keep-order' multiple='multiple' name="produit[]">
                                    @foreach ($produits as $produit)
                                    <option value='{{$produit->id}}'>{{$produit->produit}}</option>
                                    @endforeach
                                </select>    
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mb-2">
                                    <button  type="submit" class="btn btn-rounded btn-success px-5">Soumettre</button>
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end keep over multiselectd  -->
                <!-- ============================================================== -->
</div>

@section('javascript')
<script src="{{asset('/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('/assets/vendor/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('/assets/libs/js/main-js.js')}}"></script>
<script>
    $('#my-select, #pre-selected-options').multiSelect()
    </script>
    <script>
    $('#callbacks').multiSelect({
        afterSelect: function(values) {
            alert("Select value: " + values);
        },
        afterDeselect: function(values) {
            alert("Deselect value: " + values);
        }
    });
    </script>
    <script>
    $('#keep-order').multiSelect({ keepOrder: true });
    </script>
    <script>
    $('#public-methods').multiSelect();
    $('#select-all').click(function() {
        $('#public-methods').multiSelect('select_all');
        return false;
    });
    $('#deselect-all').click(function() {
        $('#public-methods').multiSelect('deselect_all');
        return false;
    });
    $('#select-100').click(function() {
        $('#public-methods').multiSelect('select', ['elem_0', 'elem_1'..., 'elem_99']);
        return false;
    });
    $('#deselect-100').click(function() {
        $('#public-methods').multiSelect('deselect', ['elem_0', 'elem_1'..., 'elem_99']);
        return false;
    });
    $('#refresh').on('click', function() {
        $('#public-methods').multiSelect('refresh');
        return false;
    });
    $('#add-option').on('click', function() {
        $('#public-methods').multiSelect('addOption', { value: 42, text: 'test 42', index: 0 });
        return false;
    });
    </script>
    <script>
    $('#optgroup').multiSelect({ selectableOptgroup: true });
    </script>
    <script>
    $('#disabled-attribute').multiSelect();
    </script>
    <script>
    $('#custom-headers').multiSelect({
        selectableHeader: "<div class='custom-header'>Selectable items</div>",
        selectionHeader: "<div class='custom-header'>Selection items</div>",
        selectableFooter: "<div class='custom-header'>Selectable footer</div>",
        selectionFooter: "<div class='custom-header'>Selection footer</div>"
    });
    </script>
@endsection

@endsection