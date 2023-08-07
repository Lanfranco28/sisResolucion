<?php

include_once './conexion/conection.php';
session_start();

$contenido = $_FILES['file']['tmp_name'];
$dir = 'archivos/';
$extension = '.pdf';
$num_resol = null;
$usuario = $_SESSION['id_usuario'];

if (isset($_SESSION['cargo'])) {
    switch ($_SESSION['cargo']) {
        case 1:
            $num_resol = $_POST['txtresol'];
            break;

        case 2:
            $num_resol = $_POST['txtresol_colab'];
            break;

        default:
            // Manejar aquí el caso por defecto (opcional)
    }
}

// La variable '$nuevo_nombre' será la ruta del documento
$nuevo_nombre = $dir . file_name($num_resol) . $extension;

if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$sql_verificar_resol = "SELECT num_resol FROM resolucion WHERE num_resol = ?";
$statement_verificar_resol = $conn->prepare($sql_verificar_resol);
$statement_verificar_resol->bind_param('s', $num_resol);
$statement_verificar_resol->execute();
$statement_verificar_resol->store_result();

if ($statement_verificar_resol->num_rows > 0) {
    echo "<script>alert('El número de resolución ya existe. Por favor, ingrese un número de resolución diferente.');</script>";
    redireccionarSegunCargo();
} else {
    if (move_uploaded_file($contenido, $nuevo_nombre)) {
        echo "<script>alert('El documento se guardó correctamente');</script>";
        // Obtener los valores adicionales desde el formulario
        if (isset($_SESSION['cargo'])) {
            switch ($_SESSION['cargo']) {
                case 1:
                    $fecha = $_POST['txtfecha'];
                    $titulo = $_POST['txtarticulo'];
                    $id_tipo = $_POST['txttipo'];
                    break;

                case 2:
                    $fecha = $_POST['txtfecha_colab'];
                    $titulo = $_POST['txtarticulo_colab'];
                    $id_tipo = $_POST['txttipo_colab'];
                    break;

                default:
                    // Manejar aquí el caso por defecto (opcional)
            }

            // Insertar valores en la tabla 'resolucion'
            $sql = "INSERT INTO resolucion (num_resol, fecha, titulo, id_tipo, urls, id_usuario, hora) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIME)";
            $statement = $conn->prepare($sql);
            $statement->bind_param('sssisi', $num_resol, $fecha, $titulo, $id_tipo, $nuevo_nombre, $usuario);

            if ($statement->execute()) {
                $resolucion_id = $statement->insert_id;
                echo "<script>alert('Los valores se han insertado correctamente en la tabla \'resolucion\'. ID de la resolución: $resolucion_id');</script>";
            } else {
                // Si ocurrió un error, muestra un mensaje de error
                echo "<script>alert('Error al insertar valores en la tabla \'resolucion\': " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('No se pudo guardar el documento');</script>";
    }
}

redireccionarSegunCargo();

$conn->close();

?>
