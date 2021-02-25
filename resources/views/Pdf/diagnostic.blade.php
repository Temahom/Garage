<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
</style>
</head>
<body>

<h2>Constat : {{$diagnostic->constat}} </h2>
<h2>Date : {{$diagnostic->created_at}} </h2>
<h2>Chef d'opération : {{$diagnostic->intervention()->first()->user()->first()->name}} </h2>
<h2>Voiture : {{ $voiture->marque}} {{ $voiture->model}} {{ $voiture->annee}} </h2>

<table>
  <tr>
    <th>Code</th>
    <th>Localisation</th>
    <th>Description</th>
    <th>Etat</th>
  </tr>
   @foreach ($diagnostic->defauts()->get() as $defaut)
  <tr>
    <td>{{$defaut->code}}</td>
    <td>{{$defaut->localisation}}</td>
    <td>{{$defaut->description}}</td>
    <td>{{$defaut->etat}}</td>
  </tr>
  @endforeach
</table>

</body>
</html>
