<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Diagnostic</title>
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
.entete{
  display: inline;

}
.gauche{
  float: left;
}
.droite{
  float: right;
  padding-left: 20px;

}
h2{
  font-size: 20px;
}
tr:hover {background-color:#f5f5f5;}
</style>
</head>
<body>
<div id="entete">
  <div class="gauche">
      <h2>Constat : {{$diagnostic->constat}} </h2>
      <h2>Date : {{$diagnostic->created_at}} </h2>
</div>
<div class="droit">
  <h2>Chef d'opération : {{$diagnostic->intervention()->first()->user()->first()->name}} </h2>
  <h2>Voiture : {{ $voiture->marque}} {{ $voiture->model}} {{ $voiture->annee}} </h2>
</div>
</div>
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
