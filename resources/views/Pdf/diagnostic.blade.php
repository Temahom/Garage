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

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .entete {
            display: inline;
            width: 100%;

        }

        .gauche {
            float: left;
        }

        .droite {
            float: right;
            margin: 20px;

        }

        h2 {
            font-size: 20px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

    </style>
</head>

<body>
    <div id="entete">
        <div class="gauche">
            <h3>Constat : {{ $diagnostic->constat }} </h3>
            <h3>Date : {{ $diagnostic->created_at }} </h3>
        </div>
        <div class="droit">
            <h3>Chef d'opération : {{ $diagnostic->intervention()->first()->user()->first()->name }} </h3>
            <h3>Voiture : {{ $voiture->marque }} {{ $voiture->model }} {{ $voiture->annee }} </h3>
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
                <td>{{ $defaut->code }}</td>
                <td>{{ $defaut->localisation }}</td>
                <td>{{ $defaut->description }}</td>
                <td>{{ $defaut->etat }}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
