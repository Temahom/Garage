@extends('layout.index')

@section('content')

    <style>
        .row{
            overflow: hidden;
        }
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification Acteur</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('actors.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @include('actors._partials._form')

    </form>

<<<<<<< HEAD

=======
    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    
>>>>>>> 74dd1123048e823bf38684b1acd3aebbd9b482bb
@endsection