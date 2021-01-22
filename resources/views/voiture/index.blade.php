<table>
        <tr>
           <td>Matricule</td>
           <td>Marque</td>
           <td>Model</td>
           <td>Annee</td>
           <td>Carburant</td>
           <td>Puissance</td>
        </tr>
        @foreach($voitures as $voiture)
        <tr>
           <td><a href="/voitures/{{$voiture->id}}/edit">{{$voiture->matricule}}</a></td>
           <td>{{$voiture->marque}}</td>
           <td>{{$voiture->model}}</td>
           <td>{{$voiture->annee}}</td>
           <td>{{$voiture->carburant}}</td>
           <td>{{$voiture->puissance}}</td>
           <td>
             <form action="/voitures/{{$voiture->id}}" method="POST">
             @csrf
             @method('DELETE')
             <input type="submit" value="Supprimer">
             </form>
           </td>
        </tr>
        @endforeach
        
    </table>