@include('animate_gestion_stock')
@extends('layout.menu')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-rounded btn-dark" href="{{ route('commandes.index') }}" title="Go back"> <i class="fas fa-angle-left"></i>  Retour</a>
            </div>
        </div>
    </div>
        <br>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 row">  
                <div class="col-xs-12 col-sm-12 col-md-12 "><br>    
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color: #006680;">
                                        <tr>
                                            <th scope="col" style="color: #ffffff;">Produit</th>
                                            <th scope="col" style="color: #ffffff; text-align:center;">Quantité </th>
                                            <th scope="col" style="color: #ffffff; text-align:center;">Prix unitaire (F CFA)</th>
                                            <th scope="col" style="color: #ffffff;; text-align:center; width: 200px">Montant (F CFA)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $total = 0 ?>
                                        @foreach ($produits as $produit)
                                            <tr>
                                                <td style="cursor: pointer;">{{ $produit->produit }}</td>
                                                <td style="cursor: pointer; text-align: center">{{ $produit->pivot->quantite }}</td>
                                                <td style="cursor: pointer; text-align: center">{{ number_format($produit->prix1, 0, ",", " " ) }}</td>
                                                <td style="cursor: pointer; text-align: center"><?php echo number_format($produit->pivot->quantite * $produit->prix1, 0, ",", " ") ?></td>
                                            </tr>
                                            <?php $total += $produit->pivot->quantite * $produit->prix1 ?>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-5">
                                    <tbody>
                                        <tr style="background-color: rgba(209, 203, 203, 0.306);">
                                            <th style="text-align: end" scope="col" colspan="4">Total produit(s) commandé(s)</th>
                                            <th style="text-align: center" scope="col">{{ number_format($total, 0, ",", " ") }} <sup>F CFA</sup></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
@endsection