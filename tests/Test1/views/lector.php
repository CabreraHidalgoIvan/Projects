<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar === null || $validar = '') {
    echo 'No tiene autorizacion';
    header('Location: ../includes/login.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">


    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title></title>
</head>

<div class="container is-fluid">

    <br>
    <div class="col-xs-12">
        <h1>Bienvenido Lector <?php echo $_SESSION['nombre'];?></h1>
        <br>
        <h1>Lista de usuarios</h1>
        <br>
        <div>
            <a class="btn btn-warning" href="../includes/session/closeSession.php">LogOut</a>
        </div>
        <br>
        <table class="table table-striped table-dark " id="table_id">
            <caption>Lista de usuarios</caption>

            <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Fecha_Registro</th>
                <th>Rol de usuario</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $conexion = mysqli_connect("localhost", "root", "", "CRUDTests_Test1");
            $query = "SELECT user.id, user.nombre, user.correo, user.password, user.telefono, user.fecha, permisos.rol
FROM user LEFT JOIN permisos ON user.rol = permisos.id";
            $result = mysqli_query($conexion, $query);

            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['correo'] ?></td>
                        <td><?php echo $row['telefono'] ?></td>
                        <td><?php echo $row['fecha'] ?></td>
                        <td><?php echo $row['rol'] ?></td>
                    </tr>
                    <?php
                }
                ?>

                <?php
            }
            ?>


            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="../js/user.js"></script>


</html>