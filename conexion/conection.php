<?php

$servername = "localhost"; // Nombre del servidor (puede ser una dirección IP)
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "bd_sisresol"; // Nombre de la base de datos

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
    // Creamos una funcion para renombrar el documento

function file_name($string) {

    // Tranformamos todo a minusculas

    $string = strtolower($string);

    //Rememplazamos caracteres especiales latinos

    $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

    $repl = array('a', 'e', 'i', 'o', 'u', 'n');

    $string = str_replace($find, $repl, $string);

    // Añadimos los guiones

    $find = array(' ', '&', '\r\n', '\n', '+');
    $string = str_replace($find, '-', $string);

    // Eliminamos y Reemplazamos otros carácteres especiales

    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

    $repl = array('', '-', '');

    $string = preg_replace($find, $repl, $string);

    return $string;
}

function redireccionarSegunCargo() {
    if (isset($_SESSION['cargo'])) {
        switch ($_SESSION['cargo']) {
            case 1:
                echo "<script>window.location.href = 'index_admin.php';</script>";
                break;
            case 2:
                echo "<script>window.location.href = 'index_colab.php';</script>";
                break;
            default:
                break;
        }
    }
}

?>