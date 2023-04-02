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

<body>

<form action="functions.php" method="post">
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <br>
                        <br>
                        <h3 class="text-center">Iniciar sesión</h3>
                        <br>
                        <div class="form-group">
                            <label for="nombre" class="form-label">Usuario</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label><br>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <input type="hidden" name="accion" value="acceso_user">
                        </div>
                        <div class="form-group">
                            <br>
                            <center>
                                <input type="submit" value="Iniciar sesión" class="btn btn-success">
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</body>
</html>