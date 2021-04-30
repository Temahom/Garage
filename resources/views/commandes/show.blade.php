@include('animate_gestion_stock')
@extends('layout.menu')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('commandes.index') }}" title="Go back"> <i class="fas fa-backward "></i>  Retour</a>
            </div>
        </div>
    </div>
        <br>
    <div class="row">
        <div class="row my-4">
            <div class="col-md-12">

                <table class="table table-bordered">
                    <thead style="background-color: #4656E9;">
                        <tr>
                            <th scope="col" style="color: #ffffff">Produit</th>
                            <th scope="col" style="color: #ffffff">Quantité Commander</th>
                            <th scope="col" style="color: #ffffff">Prix unitaire (F CFA)</th>
                            <th scope="col" style="color: #ffffff; width: 200px">Montant (F CFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $total = 0 ?>
                        @foreach ($produits as $produit)
                            <tr>
                                <td>{{ $produit->produit }}</td>
                                <td>{{ $produit->pivot->quantite }}</td>
                                <td>{{ number_format($produit->prix1, 0, ",", " " ) }}</td>
                                <td><?php echo number_format($produit->pivot->quantite * $produit->prix1, 0, ",", " ") ?></td>
                            </tr>
                            <?php $total += $produit->pivot->quantite * $produit->prix1 ?>
                        @endforeach
                    </tbody>
                </table>

                <table class="table table-bordered mt-5">
                    <tbody>
                        <tr>
                            <th scope="col" colspan="4">Total produit(s) commandé(s)</th>
                            <th scope="col">{{ number_format($total, 0, ",", " ") }}</th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    
    </div>
@endsection