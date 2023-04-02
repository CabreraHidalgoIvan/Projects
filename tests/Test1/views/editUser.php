<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar === null || $validar = '') {
    echo 'No tiene autorizacion';
    header('Location: ../includes/login.php');
    die();
}

$id = $_GET['id'];

$conexion = mysqli_connect('localhost', 'root', '', 'CRUDTests_Test1');

$query = "SELECT * FROM user WHERE id = $id";

$result = mysqli_query($conexion, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>

    <link rel="stylesheet" href="../css/es.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body id="page-top">


<form action="../includes/functions.php" method="POST">
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">

                        <br>
                        <br>
                        <h3 class="text-center">Editar usuario</h3>
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required
                                   value="<?php echo $user['nombre']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" name="correo" id="correo" class="form-control" placeholder=""
                                   value="<?php echo $user['correo']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label">Telefono *</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" required
                                   value="<?php echo $user['telefono']; ?>">

                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label><br>
                            <input type="password" name="password" id="password" class="form-control" required
                                   value="<?php echo $user['password']; ?>">
                            <input type="hidden" name="accion" value="editar_registro">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol:</label><br>
                            <select name="rol" id="rol" class="form-control">
                                <option value="1">1 - Administrador</option>
                                <option value="2">2 - Lector</option>
                            </select>
                        </div>


                        <br>

                        <div class=" mb-3">

                            <input type="submit" value="Editar" class="btn btn-success"
                                   name="registrar">
                            <a href="#" class="btn btn-danger">Cancelar</a>

                        </div>
                    </div>
                </div>

</form>
</body>
</html>