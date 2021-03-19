

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 row">  
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <br><h2>Liste des Produits</h2><br>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 row">
            <div class="col-xs-9 col-sm-9 col-md-9">     
                 <div class="form-group">
                     <a class="btn btn-secondary" href="{{ route('produits.create') }}"><i class="fas fa-plus"></i> Ajouter un Produit</a>
                 </div>
             </div>   
         <div class="col-xs-3 col-sm-3 col-md-3">     
                 <div class="form-group">
                     <form action="{{ route('produits.index') }}" method="GET" role="search">
                         <div class="d-flex">
                             <input type="text" class="form-control mr-2" name="term" placeholder="Rechercher ici " id="term" autocomplete="off">
                             <button class="btn btn-info t" type="submit" title="recherche un produit">
                                 <span class="fas fa-search"></span>
                             </button>
                         </div>
                     </form><br>
                 </div>
             </div>     
        {{-- <!--       <div class="col-xs-4 col-sm-5 col-md-3">     
                    <div class="form-group">
                <form action="{{ route('produits.index') }}" method="GET" role="search">
                    <div class="d-flex">
                        <button class="btn btn-info t" type="submit" title="recherche un produit">
                            <span class="fas fa-search"></span>
                        </button>
                            <input type="text" class="form-control mr-2" name="term" placeholder="Rechercher produit" id="term">
                            <a href="{{ route('produits.index') }}" class="">
                                <button class="btn btn-danger" type="button" title="Actualiser page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </a>
                    </div>
                </form><br>
            </div>
        </div>      --> --}}


         </div>         
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


        <div class="row">
	        <div class="col-xs-12 col-sm-12 col-md-12 row"><br>
                <table class="table table-striped table-hover">
                    <thead  class="" style="background-color: #4656E9;">
                        <tr>
                            <th style="color: white;" style="cursor: pointer;">N°</th>
                            <th style="color: white;" style="cursor: pointer;">Catégorie</th>
                            <th style="color: white;" style="cursor: pointer;">Nom Produit</th>
                            <th style="color: white;" style="cursor: pointer;">Prix Unitaire</th>
                            <th style="color: white;" style="cursor: pointer;">En Stock</th>
                            <th style="color: white;" style="cursor: pointer;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($produits as $produit)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td style="cursor: pointer; text-transform: capitalize;">{{ $produit->categorie }}</td>
                            <td style="cursor: pointer; text-transform: capitalize;">{{ $produit->produit }}</td>
                            <td style="cursor: pointer;">{{number_format($produit->prix1 ,0, ",", " " )}} <sup>F CFA</sup> </td>
                            <td style="cursor: pointer;">{{ $produit->qte }}</td>   
                        <!--    <td style="text-transform:capitalize;"> {{strftime("%A %d %B %Y", strtotime($produit->created_at))}}</td>-->
                            <td>

                        <!--       <a href="{{ route('produits.show', $produit->id) }}" title="show">      -->             
                                    <button type="button" class="btn btn-succes p-0 pr-2 pl-2" data-toggle="modal" data-target="#exampleModal{{ $produit->id }}">
                                        <i class="fas fa-eye text-success  fa-lg"></i>    
                                    </button>
                                    <div class="modal fade" id="exampleModal{{ $produit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">
                                                    <div style="font-size: 20px; ">Produit : <a href="{{route('produits.index',['produit'=>$produit->id])}}" style="color: #2EC551">{{ $produit->produit}} </a></div>
                                                    <div style="font-size: 14px; ">Catégorie  : <a href="{{route('produits.index',['produit'=>$produit->id])}}" style="color: #750439">{{ $produit->categorie}} </a></div>
                                                    <div style="font-size: 14px;" >Prix Unitaire  : <a href="" class="badge badge-success"> {{ $produit->prix1}} <sup>F CFA</sup> </a> </div>
                                                    <div style="font-size: 14px;">Quantité Produit  : <a href="" style="color: #17028a">{{ $produit->qte}} </a> </div>                    
                                                </div>
                                                <div class="modal-footer">
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                <a href="{{ route('produits.edit', $produit->id) }}">
                                    <i class="fas fa-edit  fa-lg"></i>

                                </a>
                                <a data-toggle="modal" id="smallButton{{$produit->id}}" data-target="#smallModal{{$produit->id}}" data-attr="{{ route('produits.destroy', $produit->id) }}" title="Supprimer Produit">
                                    <i class="fas fa-trash text-danger  fa-lg"></i>
                                </a>
                <!-- small modal -->
                        <div class="modal fade" id="smallModal{{$produit->id}}" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="smallBody">
                                <div>
                                    <form action="/produits/{{$produit->id}}" method="POST">
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        @method('DELETE')
                                        <h5 class="text-center">Etes-vous sûr que vous voulez supprimer le Produit :{{ $produit->produit }} ? </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"  title="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit"  title="delete" class="btn btn-danger">Oui,Supprimer</button>
                                    </div>
                                    </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div> 



<div> <br></div>

     <!--   <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row centrage">  
                @foreach ($produits as $produit) 
                    <div  class="card d-flex justify-content-center mr-2"style="width: 18rem; justify-content: center; text-align: center; cursor: pointer;">    
                            @if(isset($produit->image))
                                <img class="d-flex justify-content-center mt-2 " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="{{asset('images/'.$produit->categorie)}}" alt="Card image cap">
                            @else
                                <img class="d-flex justify-content-center mt-2 " style="align-self:center;width: 100px ; height: 100px; border-radius: 50%;" src="https://ui-avatars.com/api/?background=random&color=fff&name={{ $produit->produit}}" alt="Card image cap">
                            @endif
                        <div class="card-body" style="justify-content: center; text-align: center;">
                            <h5 class="card-title">{{ $produit->categorie}}</h5>
                            <p class="card-text"><a style="text-decoration: none; color: #fc0505;">{{ $produit->produit}} </a><br> <span class="{{$produit->prix1 }}">Prix Unitaire: {{$produit->prix1 }}<br> Stock : {{ $produit->qte}}</span> </p>
                            <a data-toggle="modal" id="smallButton{{$produit->id}}" data-target="#smallModal{{$produit->id}}" data-attr="{{ route('produits.destroy', $produit->id) }}" title="Supprimer Produit">
                                <i class="fas fa-trash text-danger  fa-lg"></i>
                            </a>
                            <!-- small modal 

                            <div class="modal fade" id="smallModal{{$produit->id}}" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document"> 
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="smallBody">
                                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <h5 class="text-center">Etes-vous sûr que vous voulez supprimer le Produit :{{ $produit->produit }} ? </h5>

                                                <div class="modal-footer">
                                                    <button type="button"  title="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <button type="submit"  title="delete" class="btn btn-danger">Oui,Supprimer</button>
                                                </div>
                                            </form>
                                
                                
                                        </div>
                    
                                    </div>
                                </div>   

                            </div>
                        </div>     
                    </div>             
                @endforeach  
            </div>
        </div>-->
    </div></div>

{!! $produits->links() !!}


<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    }); 

</script>
<script>
    function showProduit(id)
    {
        window.location = 'produits/' + id ;
    }
</script>

<script>
    function commanderProduit(id)
    {
        window.location = 'produits/' + id ;
    }
</script>

<script>
    const compare = (ids, asc) => (row1, row2) => {
        const tdValue = (row, ids) => row.children[ids].textContent;
        const tri = (v1, v2) => v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2);
        return tri(tdValue(asc ? row1 : row2, ids), tdValue(asc ? row2 : row1, ids));
    };
        const tbody = document.querySelector('tbody');
        const thx = document.querySelectorAll('th');
        const trxb = tbody.querySelectorAll('tr');

            thx.forEach(th => th.addEventListener('click', () => {
                let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
                classe.forEach(tr => tbody.appendChild(tr));
            }));
</script>