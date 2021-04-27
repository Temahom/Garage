
    @extends('layout.menu') 
    @php
        use App\Models\Produit;
        $listes=Produit::select('produit')->orderBy('produit','asc')->distinct()->get();							
    @endphp 
    
    @section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="col-md-4 py-1"  style="box-shadow: 0px 0px 2px rgb(145, 135, 135); background-color: #fafafa;">
                <div class="row">
                    <div class="col-md-2 col-sm-3 text-center pt-4">
                        @if ($fournisseur->genre == "homme")
                            <img style="height: 50px;width: auto;" class="" src="/assets/images/masculin.png" alt="logo">
                        @else
                            <img style="height: 50px;width: auto;" class="" src="/assets/images/feminin.png" alt="logo">
                        @endif
                    </div>

                    <div class="col-md-10 col-sm-10">
                        <div style="font-size: 20px; color: #2EC551"><a href="{{route('fournisseurs.show',['fournisseur'=>$fournisseur->id])}}" style="color: #2EC551">{{ $fournisseur->prenom}}  {{ $fournisseur->nom}}</a></div>
                        <div style="font-size: 14px;"><i class="fas fa-home"></i> {{ $fournisseur->entreprise}}</div>
                        <div style="font-size: 14px;"><i class="fas fa-phone"></i> {{ $fournisseur->telephone}}</div>
                        <div style="font-size: 14px;"><i class="fas fa-envelope"></i> {{ $fournisseur->email}}</div>
                        @can('update', $fournisseur)
                        <div class="text-right" style="font-size: 12px;">
                            <a class="text-primary mr-1" href="{{ route('fournisseurs.edit',$fournisseur->id)}}">Modifier</a> 
                            <button type="button" class="text-danger hide_delete" id="hide_fournisseurs" style="border: none; cursor: pointer" data-toggle="modal" data-target="#exampleModal{{ $fournisseur->id }}">
                                Supprimer
                            </button>
        
                                    <div class="modal fade" id="exampleModal{{ $fournisseur->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5>Voulez vous supprimer: <strong>{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</strong>  ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form action="{{route('fournisseurs.destroy',$fournisseur->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
    <br>
    <div class="tab-outline">
        <ul class="nav nav-tabs" id="myTab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-outline-one" data-toggle="tab" href="#outline-one" role="tab" aria-controls="home" aria-selected="true">Liste Approvisionnement</a>
            </li>
            
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-two" data-toggle="tab" href="#outline-two" role="tab" aria-controls="profile" aria-selected="false">Nouvel Approvisionnement</a>
                </li>
            
        </ul>
        <div class="tab-content" id="myTabContent2">



            <!-- ============================================================== -->
            <!-- liste intervention  -->
            <!-- ============================================================== -->
            <div class="tab-pane fade show active" id="outline-one" role="tabpanel" aria-labelledby="tab-outline-one">
                
                    

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead style="background-color: #4656E9;">
                                <tr>
                                    <th scope="col" style="color: #ffffff; text-align:center;" >Numero </th>
                                    <th scope="col" style="color: #ffffff;text-align:center;" >Date approvisionnement</th>
                                    <th scope="col" style="color: #ffffff;text-align:center;" >Nombre d'articles</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvisionnements as $key=>$appro)
                                        <tr>
                                            <td style="text-align: center">{{++$key}}</td>
                                            <td style="text-align: center">{{$appro->date_approvisionnement}}</td>
                                            <td style="text-align: center">{{count($appro->produits)}}</td>
                                        </tr>
                                        
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
               
                

            </div>
            <!-- ============================================================== -->
            <!-- FIN DIAGNOSTIC  -->
            <!-- ============================================================== -->



            <!-- ============================================================== -->
            <!-- Nouvel approvisionnement  -->
            <!-- ============================================================== -->
            <div class="tab-pane fade" id="outline-two" role="tabpanel" aria-labelledby="tab-outline-two">
                
                <form id="Formapprov" action="{{route('fournisseurs.approvisionnements.store',['fournisseur'=>$fournisseur->id]) }}" method="POST">
                    @csrf
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-11" >
                                <div class="row p-3" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">    
                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                        <div class="form-group">
                                            <strong>Fournisseur</strong>
                                            <select name="fournisseur_id" class="custom-select form-control" >
                                                @if(!empty($fournisseur->id))
                                                    <option value="{{$fournisseur->id}}">{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                                @else   
                                                    @foreach( $fournisseurs as $fournisseur ) 
                                                        <option value="{{$fournisseur->id}}" {{ old('fournisseur_id') == ($fournisseur->id) ? 'selected' : '' }} {{$approvisionnement->fournisseur_id == $fournisseur->id ? 'selected':'' }}>{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                                    @endforeach 
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                        <strong>Produit(s):</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12" id="dynamicAddRemove">
                                        <style>
                                            #newproduct
                                            {
                                                border: 1px solid #D2D2E4;
                                                box-shadow: 0 10px 20px rgba(0,0,0,0.1), 0 6px 6px rgba(0,0,0,0.2);
                                                background-color: #fefefe;
                                            }
                                            #remove-button{
                                                color: #888;
                                            }
                                            #remove-button:hover{
                                                background-color: red;
                                                color: white;
                                                box-shadow: none;
                                            }
                                            #remove-button:focus{
                                                box-shadow: none;
                                            }
                                        </style>
            
                                        
                                            <!-- AJOUT PRODUITS -->
                                            <div class="row p-3 mb-2" id="newproduct">
                                                <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                                    <span class="numero">#1</span>
                                                    <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                                    <div class="row">
                                                        <div class="divProduit col-xs-12 col-sm-12 col-md-4">
                                                            <strong>Nom Produit</strong>
                                                                <select name="plusdechamps[0][produit_id]" class="custom-select form-control" >
                                                                    <option value="">Nom Produit</option>
                                                                        @foreach( $produits as $produit ) 
                                                                            <option value="{{$produit->id}}">{{ $produit->produit }}</option>
                                                                        @endforeach 
                                                                </select>
                                                        </div> 
                                                        <div class="divQteAppro col-xs-12 col-sm-12 col-md-4">
                                                            <strong>Quantité Approvisionnée:</strong>
                                                            <input type="number" name="plusdechamps[0][qteAppro]" class="form-control" placeholder="Quantité Approvisionnée">
                                                        </div> 
                                                        <div class="divPuAchat col-xs-12 col-sm-12 col-md-4">
                                                            <strong>PU achat:</strong>
                                                            <input type="number" name="plusdechamps[0][prixAchat]" class="form-control" placeholder="Prix Unitaire (achat)">
                                                        </div> 
                                                    </div>
                                                </div> 
                                            </div>
                                            <!-- FIN AJOUT PRODUITS -->
                                    </div>
                                </div>
            
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                                        <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter un nouveau produit</button>
                                    </div>
                                </div>
            
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-12 pl-0 py-4">
                                <a class="btn btn-secondary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
                                <a class="btn btn-success" style="color: white; margin-left: 6px; " onclick="envoyerFormappro()">Enregistrer</a>
                            </div>
                        </div>
                                    
                </form>

            </div>
            <!-- ============================================================== -->
            <!-- FIN RESUME  -->
            <!-- ============================================================== -->



        </div>
    </div>
        {{-- <form id="Formapprov" action="{{route('fournisseurs.approvisionnements.store',['fournisseur'=>$fournisseur->id]) }}" method="POST">
            @csrf
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-11" >
                        <div class="row p-3" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">    
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
                                <div class="form-group">
                                    <strong>Fournisseur</strong>
                                    <select name="fournisseur_id" class="custom-select form-control" >
                                        @if(!empty($fournisseur->id))
                                            <option value="{{$fournisseur->id}}">{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                        @else   
                                            @foreach( $fournisseurs as $fournisseur ) 
                                                <option value="{{$fournisseur->id}}" {{ old('fournisseur_id') == ($fournisseur->id) ? 'selected' : '' }} {{$approvisionnement->fournisseur_id == $fournisseur->id ? 'selected':'' }}>{{$fournisseur->prenom.' '.$fournisseur->nom}}</option>
                                            @endforeach 
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                <strong>Produit(s):</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" id="dynamicAddRemove">
                                <style>
                                    #newproduct
                                    {
                                        border: 1px solid #D2D2E4;
                                        box-shadow: 0 10px 20px rgba(0,0,0,0.1), 0 6px 6px rgba(0,0,0,0.2);
                                        background-color: #fefefe;
                                    }
                                    #remove-button{
                                        color: #888;
                                    }
                                    #remove-button:hover{
                                        background-color: red;
                                        color: white;
                                        box-shadow: none;
                                    }
                                    #remove-button:focus{
                                        box-shadow: none;
                                    }
                                </style>
    
                                
                                    <!-- AJOUT PRODUITS -->
                                    <div class="row p-3 mb-2" id="newproduct">
                                        <div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">
                                            <span class="numero">#1</span>
                                            <button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">
                                            <div class="row">
                                                <div class="divProduit col-xs-12 col-sm-12 col-md-4">
                                                    <strong>Nom Produit</strong>
                                                        <select name="plusdechamps[0][produit_id]" class="custom-select form-control" >
                                                            <option value="">Nom Produit</option>
                                                                @foreach( $produits as $produit ) 
                                                                    <option value="{{$produit->id}}">{{ $produit->produit }}</option>
                                                                @endforeach 
                                                        </select>
                                                </div> 
                                                <div class="divQteAppro col-xs-12 col-sm-12 col-md-4">
                                                    <strong>Quantité Approvisionnée:</strong>
                                                    <input type="number" name="plusdechamps[0][qteAppro]" class="form-control" placeholder="Quantité Approvisionnée">
                                                </div> 
                                                <div class="divPuAchat col-xs-12 col-sm-12 col-md-4">
                                                    <strong>PU achat:</strong>
                                                    <input type="number" name="plusdechamps[0][prixAchat]" class="form-control" placeholder="Prix Unitaire (achat)">
                                                </div> 
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- FIN AJOUT PRODUITS -->
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 p-4" style="border: 1px solid #D2D2E4; box-shadow: 0px 0px 3px #999; background-color: #fefefe;">
                                <button type="button" name="add" id="add-btn" class="btn btn-light" style="border-radius:15px">Ajouter un nouveau produit</button>
                            </div>
                        </div>
    
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-12 pl-0 py-4">
                        <a class="btn btn-secondary" href="{{ route('approvisionnements.index') }}" title="Go back"> <i class="fas fa-backward "></i> Retour</a>
                        <a class="btn btn-success" style="color: white; margin-left: 6px; " onclick="envoyerFormappro()">Enregistrer</a>
                    </div>
                </div>
                            
        </form>             --}}
     
    
    <script src="/assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <script  type="text/javascript">
        var i = 1000;
        var nbItemApprov = 1;
        var divApprov;
    
        function getDiv(i) {
            divApprov =     '<div class="row p-3 mb-2" id="newproduct">'+
                                        '<div class="divSup col-xs-12 col-sm-12 col-md-12 p-0">'+
                                            '<span class="numero"></span>'+
                                            '<button type="button" class="btn btn-sm m-0" id="remove-button" style="float: right"><i class="fas fa-times"></i></button>'+
                                        '</div>'+
                                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 pt-4">'+
                                            '<div class="row">'+
                                                '<div class="divProduit col-xs-12 col-sm-12 col-md-4">'+
                                                    '<strong>Nom Produit</strong>'+
                                                        '<select name="plusdechamps['+i+'][produit_id]" class="custom-select form-control" >'+
                                                            '<option value="">Nom Produit</option>'+
                                                                '@foreach( $produits as $produit )'+
                                                                    '<option value="{{$produit->id}}">{{ $produit->produit }}</option>'+
                                                                '@endforeach'+
                                                        '</select>'+
                                                '</div>'+
                                                '<div class="divQteAppro col-xs-12 col-sm-12 col-md-4">'+
                                                    '<strong>Quantité Approvisionnée:</strong>'+
                                                    '<input type="number" name="plusdechamps['+i+'][qteAppro]" class="form-control" placeholder="Quantité Approvisionnée">'+
                                                '</div>'+
                                                '<div class="divPuAchat col-xs-12 col-sm-12 col-md-4">'+
                                                    '<strong>PU achat:</strong>'+
                                                    '<input type="number" name="plusdechamps['+i+'][prixAchat]" class="form-control" placeholder="Prix Unitaire (achat)">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+ 
                                    '</div>';
            return divApprov;
        }
    
        
    
        $("#add-btn").click(function(){
            div = getDiv(i);
            $("#dynamicAddRemove").append(div);
            numeroter();
            i++;
        });
    
        $(document).on('click', '#remove-button', function(){  
            $(this).parents('#newproduct').remove();
            numeroter();
        });
    
        function numeroter() {
            var num = 0;
            $('#dynamicAddRemove > div').each( function(){
                num++;
                $(this).children('.divSup').children('.numero').text('#' + num);
            });
            nbItemApprov = num;
        }
    
        $(document).on('change', function(){  
            var parent = $(this).parents('#newproduct');
            $.ajax({
                
                success: function(data) {
                    parent.children('div').children('div').children('.divQteAppro').children('input').removeClass('is-invalid');
                    parent.children('div').children('div').children('.divPuAchat').children('input').removeClass('is-invalid');
                    
                    parent.children('div').children('div').children('.divQteAppro').children('input').val(data[0].divQteAppro);
                    parent.children('div').children('div').children('.divPuAchat').children('input').val(data[0].divPuAchat);
                }
            });
        });
    
        /*DEBUT control formulaire*/
        function envoyerFormappro()
        {
           
            var ok = 1;
            
            if(nbItemApprov == 0)
            {
                alert('Ajouter au moins un produit');
                return 0;
            }
            $('#dynamicAddRemove > div').each( function(){
                $(this).children('div').children('div').children('.divProduit').children('select').removeClass('is-invalid');
                $(this).children('div').children('div').children('.divQteAppro').children('input').removeClass('is-invalid');
                $(this).children('div').children('div').children('.divPuAchat').children('input').removeClass('is-invalid');
                
                Produit = $(this).children('div').children('div').children('.divProduit').children('select').val().trim();
                
                if(Produit == '')
                {
                    $(this).children('div').children('div').children('.divProduit').children('input').addClass('is-invalid');
                    ok = 0;
                }
    
                QteAppro = $(this).children('div').children('div').children('.divQteAppro').children('input').val().trim();
    
                if(QteAppro == '')
                {
                    $(this).children('div').children('div').children('.divQteAppro').children('input').addClass('is-invalid');
                    ok = 0;
                }
    
                PuAchat = $(this).children('div').children('div').children('.divPuAchat').children('input').val().trim();
    
                if(PuAchat == '')
                {
                    $(this).children('div').children('div').children('.divPuAchat').children('input').addClass('is-invalid');
                    ok = 0;
                }
            });
            if(ok){
                $('#Formapprov').submit();
            }
            else{
                alert('il y\'a au moins un champs vide');
            }
        }
        /*FIN control formulaire*/
        
    
    </script>
    
    
    @endsection