<!DOCTYPE html>

<html>

<head>

    <style>
        table {

            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr::nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>Bienvenido a la pagina de reporte</h1>
    <title> Reporte top establecimiento</title>

    <h2>Reporte TOP establecimientos</h2>

    <table class="table">
        <tr>


            <th>Nombre establecimiento</th>
            <th>Rating en estrellas</th>




        </tr>
        @foreach ($users as $l)



        <tr>

            <td>{{$l->name}}</td>
            <td>{{$l->stars}}</td>





        </tr>
        @endforeach
    </table>
</body>

</html>