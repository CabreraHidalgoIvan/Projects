<?php

require_once 'db.php';

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'editar_registro':
            echo '<br> Editar registro';
            editar_registro();
            break;

        case 'eliminar_registro':
            eliminar_registro();
            break;

        case 'acceso_user':
            acceso_user();
            break;

        default:
            echo 'No se ha encontrado ninguna acción';
            break;
    }
}

function editar_registro()
{
    $conexion = mysqli_connect("localhost", "root", "", "CRUDTests_Test1");

    extract($_POST, EXTR_OVERWRITE);


    $query = "UPDATE user SET nombre = '$nombre', correo = '$correo', telefono = '$telefono', password = '$password', rol = '$rol' WHERE id = $id";


    mysqli_query($conexion, $query);

    mysqli_close($conexion);

    header('Location: ../views/user.php');
}

function eliminar_registro()
{
    $conexion = mysqli_connect("localhost", "root", "", "CRUDTests_Test1");

    extract($_POST, EXTR_OVERWRITE);
    $id = $_POST['id'];

    $query = "DELETE FROM user WHERE id = $id";


    mysqli_query($conexion, $query);

    mysqli_close($conexion);

    header('Location: ../views/user.php');
}

function acceso_user() {

    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    session_start();
    $_SESSION['nombre'] = $nombre;

    $conexion = mysqli_connect("localhost", "root", "", "CRUDTests_Test1");

    $query = "SELECT * FROM user WHERE nombre = '$nombre' AND password = '$password'";

    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_array($result);

    if ($row) {
        if ($row['rol'] == 1) {
            header('Location: ../views/user.php');
        } else {
            header('Location: ../views/lector.php');
        }
    } else {
        header('Location: ../includes/login.php');
        session_destroy();
    }



}