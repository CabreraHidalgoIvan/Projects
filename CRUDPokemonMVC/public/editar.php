<?php

include '../app/helpers/funciones.php';

$config = include '../app/config.php';

$result = [
    'error' => false,
    'message' => ''
];

if (!isset($_GET['id'])) {
    $result['error'] = true;
    $result['message'] = 'El ciudadano o entrenador no existe';
}

if (isset($_POST['submit'])) {
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        $alumno = [
            "id"        => $_GET['id'],
            "nombre"    => $_POST['nombre'],
            "password"  => $_POST['password'],
            "dir"     => $_POST['dir'],
            "tlf"      => $_POST['tlf']
        ];

        $consultaSQL = "UPDATE ciudadanos SET
        nombre = :nombre,
        contraseña = :password,
        direccion = :dir,
        telefono = :tlf,
        es_entrenador = 0
        WHERE id_ciudadano = :id";

        $consulta = $conexion->prepare($consultaSQL);
        $consulta->execute($alumno);

    } catch(PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $connection = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $id = $_GET['id'];

    $sql = "SELECT * FROM ciudadanos WHERE id_ciudadano=$id";

    $query = $connection->prepare($sql);
    $query->execute();

    $ciudadano = $query->fetch(PDO::FETCH_ASSOC);

    if (!$ciudadano) {
        $result['error'] = true;
        $result['message'] = 'El ciudadano o entrenador no existe';
    }

} catch (PDOException $error) {
    $result['error'] = true;
    $result['message'] = $error->getMessage();
}


?>

<?php require "templates/header.php"; ?>

<?php
if ($result['error']) {
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $result['message'] ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php

if (isset($_POST['submit']) && !$result['error']) {
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    Ciudadano actualizado correctamente
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php if (isset($ciudadano) && $ciudadano) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Editando el ciudadano <?= escapar($ciudadano['nombre']) ?></h2>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="<?= escapar($ciudadano['nombre']) ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password"
                               value="<?= escapar($ciudadano['contraseña']) ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="dir">Dirección</label>
                        <input type="text" name="dir" id="dir" value="<?= escapar($ciudadano['direccion']) ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tlf">Edad</label>
                        <input type="text" name="tlf" id="tlf" value="<?= escapar($ciudadano['telefono']) ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
                        <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- código de la página -->
<?php require "templates/footer.php"; ?>