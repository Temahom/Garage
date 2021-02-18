@extends('layout.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste Acteurs</h2>
            </div>
            <div class="pull-right py-3">
                 <a class="btn btn-success" href="{{ route('actors.create') }}">Ajouter Acteur</a>
            </div>
        </div>
    </div>
    <style>
        svg{
            display: none;
        }
    </style>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
    
        @endif
    <div class="row">
       
        @foreach ($produits as $produit)
        <div onclick="showActor({{ $produit->id }})" class="card d-flex justify-content-center mr-2" style="width: 18rem; justify-content: center; text-align: center; cursor: pointer;">
          @if(isset($produit->image))
            <img class="d-flex justify-content-center " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="{{asset('images/'.$produit->image)}}" alt="Card image cap">
          @else
            <img class="d-flex justify-content-center " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="https://ui-avatars.com/api/?background=random&color=fff&name={{ $produit->produit}}" alt="Card image cap">
          @endif
            <div class="card-body" style="justify-content: center; text-align: center;">
              <h5 class="card-title">{{ $produit->categorie}}</h5>
              <p class="card-text"><a style="text-decoration: none;" href="mailto:{{ $produit->produit}}">{{ $produit->produit}} </a><br> <span class="{{$produit->prix1 badge badge-success }}">{{ $produit->qte}}</span> </p>
              <a href="{{ route('produits.edit',$actor->id) }}" class="btn btn-primary btn-blok"><i class="fas fa-edit"></i></a>
              <a href="{{ route('produits.show',$actor->id) }}" class="btn btn-danger btn-blok"><i class="fas fa-trash"></i></a>
            </div>
        </div>
          
        
                   
        @endforeach  
  

</div>
<div class="row">
    <div class="col-md-12 mt-3 d-flex justify-content-center">
        {!! $actors->links() !!}
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<script>
    function showActor(id)
    {
        window.location = 'actors/' + id ;
    }
</script>

@endsection      
                