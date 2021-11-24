<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
<a class="btn btn-primary" href="{{ route('estudiante.create') }}">Crear Estudiante</a><br/><br/>
<table class="table table-dark table-striped">
    <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Celular</th>
        <th>Opciones</th>
    </tr>
<?php foreach($estudiantes as $estudiante) { ?>

    <tr>

    <td>{{ $estudiante->documento }}</td>
    <td>{{ $estudiante->nombre }}</td>
    <td>{{ $estudiante->email }}</td>
    <td>{{ $estudiante->celular }}</td>
    <td>
        <a class="btn btn-secondary" href="{{ route('estudiante.edit',['estudiante' => $estudiante->id]) }}">Edit</a><br>
    <form method="post" action="{{ route('estudiante.destroy',['estudiante'=>$estudiante->id]) }}">
    @csrf
    {{ method_field('DELETE') }}
    <button class="btn btn-danger" type="submit">Borrar</button>
</form>
</td>

</tr>
<?php } ?>
</table>
</div>
</div>
</div>
</div>
</div>
</body>
</html>


