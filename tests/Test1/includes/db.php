<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'CRUDTests_Test1';

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    echo 'Error al conectar a la base de datos';
    mysqli_connect_error();
} else {
    echo 'Conectado a la base de datos';
}