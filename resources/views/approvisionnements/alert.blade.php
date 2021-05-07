@extends('layout.menu')
@section('content')
<div class="row">
@section('css')
<link rel="stylesheet" href="{{asset('/assets/vendor/multi-select/css/multi-select.css')}}">
@endsection
<!-- ============================================================== -->
                <!-- keep over multiselectd  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Demande Approvisionnement</h5>
                        <div class="card-body">
                            <select id='keep-order' multiple='multiple'>
                                
                                <option value='elem_1'>Elements 1</option>
                                <option value='elem_2'>Elements 2</option>
                                <option value='elem_3'>Elements 3</option>
                                <option value='elem_4'>Elements 4</option>
                                <option value='elem_5'>Elements 5</option>
                                <option value='elem_6'>Elements 6</option>
                                <option value='elem_7'>Elements 7</option>
                                <option value='elem_8'>Elements 8</option>
                                <option value='elem_9'>Elements 9</option>
                                <option value='elem_10'>Elements 10</option>
                                <option value='elem_11'>Elements 11</option>
                                <option value='elem_12'>Elements 12</option>
                            </select>
                        </div>
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