<!DOCTYPE html>
<html>
<head>
    <title>Ver Ciudadanos</title>
</head>
<body>
<h1>Listado de Ciudadanos</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>

    <?php $ciudadanos = [];

    // Obtener todos los ciudadanos de la base de datos
    $ciudadanoDAO = new CiudadanoDAO();
    $ciudadanos = $ciudadanoDAO->getAll();
    ?>
    <?php
    foreach ($ciudadanos as $ciudadano): ?>
        <tr>
            <td><?php echo $ciudadano['id_ciudadano']; ?></td>
            <td><?php echo $ciudadano['nombre']; ?></td>
            <td><?php echo $ciudadano['direccion']; ?></td>
            <td><?php echo $ciudadano['telefono']; ?></td>
            <td>
                <a href="editar_ciudadano.php?id=<?php echo $ciudadano['id_ciudadano']; ?>">Editar</a>
                <a href="eliminar_ciudadano.php?id=<?php echo $ciudadano['id_ciudadano']; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="crear_ciudadano.php">Crear Ciudadano</a>
</body>
</html>
