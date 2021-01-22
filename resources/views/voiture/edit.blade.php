<form action="/voitures/{{$voiture->id}}" method="POST">
@csrf
@method('patch')
    <table>
        <tr>
           <td>Matricule</td>
           <td><input type="text" name="matricule" value="{{$voiture->matricule}}"></td>
        </tr>
        <tr>
           <td>Marque</td>
           <td><input type="text" name="marque" value="{{$voiture->marque}}"></td>
        </tr>
        <tr>
           <td>Model</td>
           <td><input type="text" name="model" value="{{$voiture->model}}"></td>
        </tr>
        <tr>
           <td>Annee</td>
           <td><input type="number" name="annee" value="{{$voiture->annee}}"></td>
        </tr>
        <tr>
           <td>Carburant</td>
           <td><input type="text" name="carburant" value="{{$voiture->carburant}}"></td>
        </tr>
        <tr>
           <td>Puissance</td>
           <td><input type="text" name="puissance" value="{{$voiture->puissance}}"></td>
        </tr>
        <tr><td><input type="submit" value="Modifier"></td></tr>
    </table>
</form>