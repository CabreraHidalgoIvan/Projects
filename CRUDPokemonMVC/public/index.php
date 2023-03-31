<?php

include "../app/helpers/funciones.php";

$error = false;
$config = include "../app/config.php";

try {
    $connection = new PDO("mysql:host={$config['db']['host']};dbname={$config['db']['name']}", $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        $sql = "SELECT * FROM ciudadanos WHERE nombre LIKE '%$nombre%'";
    } else {
        $sql = "SELECT * FROM ciudadanos";
    }

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

} catch (PDOException $error) {
    $error = $error->getMessage();
}

$titulo = isset($_POST['nombre']) ? 'Lista de ciudadanos (' . $_POST['nombre'] . ')' : 'Lista de ciudadanos';

?>

<?php include "templates/header.php"; ?>

<h1>Aplicación CRUD Pokemon</h1>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" class="form-inline">
                <div class="form-group mr-3">
                    <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre" class="form-control">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4"><?= $titulo ?></h2>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if ($result && $statement->rowCount() > 0) {
                    foreach ($result as $fila) {
                        ?>
                        <tr>
                            <td><?php echo escapar($fila["id_ciudadano"]); ?></td>
                            <td><?php echo escapar($fila["nombre"]); ?></td>
                            <td><?php echo escapar($fila["direccion"]); ?></td>
                            <td><?php echo escapar($fila["telefono"]); ?></td>
                            <td>
                                <a href="<?= 'borrar.php?id=' . escapar($fila["id_ciudadano"]) ?>">🗑️Borrar</a>
                                <a href="<?= 'editar.php?id=' . escapar($fila["id_ciudadano"]) ?>">✏️Editar</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>
