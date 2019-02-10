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
    <title> Reporte Cantidad de likes -Laravel Framework</title>

    <h2>Publicaciones con mayor cantidad de likes</h2>

    <table class="table">
        <tr>


            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>publicacion con mayor cantidad de Likes</th>
            <th>Nombre de la publicación</th>
            <th>Usuario Activo=1 Inactivo=0</th>

            {{-- SELECT COUNT(likes.id),users.name FROM `likes`,`users` WHERE users.id=likes.user_id GROUP BY user_id --}}

        </tr>
        @foreach ($likes as $l)



        <tr>

            <td>{{$l->name}}</td>
            <td>{{$l->surname}}</td>
            <td>{{$l->nick}}</td>
            <td>{{$l->cantidad}}</td>
            <td>{{$l->description}}</td>
            <td>{{$l->userActive}}</td>




        </tr>
        @endforeach
    </table>
</body>

</html>