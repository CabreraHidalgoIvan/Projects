<?php

include 'funciones.php';
if (isset($_POST['submit'])) {
    $result = [
        'error' => false,
        'message' => 'Ciudadano creado correctamente'
    ];

    if (empty($_POST['nombre']) || empty($_POST['password']) || empty($_POST['dir']) || empty($_POST['tlf'])) {
        $result['error'] = true;
        $result['message'] = 'Todos los campos son obligatorios';
    } else {
        $config = include 'config.php';

        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $connection = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

            $ciudadano = [
                "nombre" => $_POST['nombre'],
                "password" => $_POST['password'],
                "dir" => $_POST['dir'],
                "tlf" => $_POST['tlf']
            ];

            $stmt = "INSERT INTO ciudadanos (nombre, contraseña, direccion, telefono) VALUES (:nombre, :password, :dir, :tlf)";

            $query = $connection->prepare($stmt);
            $query->execute($ciudadano);

        } catch (PDOException $error) {
            $result['error'] = true;
            $result['message'] = $error->getMessage();
        }
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
            <h2 class="mt-4">Registrarse como Ciudadano</h2>
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
                    <label for="dir">Dirección</label>
                    <input type="text" name="dir" id="dir" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tlf">Teléfono</label>
                    <input type="number" name="tlf" id="tlf" class="form-control" maxlength="9" minlength="9">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Enviar" href="index.php">
                    <a class="btn btn-primary" href="login.php">Regresar al login</a>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "templates/footer.php"; ?>
