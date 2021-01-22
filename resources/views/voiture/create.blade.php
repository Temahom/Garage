<form action="{{route('voitures.store')}}" method="POST">
@csrf
    <table>
        <tr>
           <td>Matricule</td>
           <td><input type="text" name="matricule"></td>
        </tr>
        <tr>
           <td>Marque</td>
           <td><input type="text" name="marque"></td>
        </tr>
        <tr>
           <td>Model</td>
           <td><input type="text" name="model"></td>
        </tr>
        <tr>
           <td>Annee</td>
           <td><input type="number" name="annee"></td>
        </tr>
        <tr>
           <td>Carburant</td>
           <td><input type="text" name="carburant"></td>
        </tr>
        <tr>
           <td>Puissance</td>
           <td><input type="text" name="puissance"></td>
        </tr>
        <tr><td><input type="submit" value="Ajouter"></td></tr>
    </table>
</form>