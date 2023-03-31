<?php

include '../app/helpers/funciones.php';
if (isset($_POST['submit'])) {
    $result = [
        'error' => false,
        'message' => 'Iniciado correctamente'
    ];

    $config = include '../app/config.php';

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conn = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        $username = $_POST['nombre'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM ciudadanos WHERE nombre='$username' AND contraseña='$password'";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            $sqlRol = "SELECT es_entrenador FROM ciudadanos WHERE nombre='$username' AND contraseña='$password'";

            $resultRol = $conn->query($sqlRol);

            if ($resultRol->rowCount() > 0) {
                $row = $resultRol->fetch(PDO::FETCH_ASSOC);
                if ($row['es_entrenador'] == 1) {
                    $_SESSION['username'] = $username;
                    header('Location: index.php');
                    exit();
                } else {
                    $error = "No eres entrenador";
                    header('Location: index.php');
/*                    header('Location: indexEntrenadores.php');*/
                }
            }
        } else {
            // los datos de inicio de sesión son incorrectos
            $error = "Nombre de usuario o contraseña incorrectos";
            header('Location: login.php');
        }

    } catch (PDOException $error) {
        $result['error'] = true;
        $result['message'] = $error->getMessage();
    }
}

?>

<?php include "templates/header.php"; ?>

<?php
if (isset($result)) {
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-<?= $result['error'] ? 'danger' : 'success' ?>" role="alert">
                    <?= $result['message'] ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Iniciar Sesión</h2>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-primary" href="registro.php">Regristro</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "templates/footer.php"; ?>
