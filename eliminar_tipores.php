<?php
include_once './conexion/conection.php';

session_start();

// Verificar el rol del tipo_resol autenticado
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id_tipo'])) {
    $idTipoResol = $_GET['id_tipo'];

    // Verificar si el tipo_resol existe antes de eliminarlo
    $checktiporesQuery = "SELECT nom_resol FROM tipo_resol WHERE id_tipo=?";
    $statement = $conn->prepare($checktiporesQuery);
    $statement->bind_param('i', $idTipoResol);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        // El tipo_resol existe, obtener su nombre
        $row = $result->fetch_assoc();
        $nombreTipoResol = $row['nom_resol'];

        // Mostrar alerta de confirmación de eliminación usando JavaScript
        echo '<script>
            var confirmDelete = confirm("¿Seguro que quieres eliminar el tipo: ' . $nombreTipoResol . ' ?");
            if (confirmDelete) {
                // Proceder con la eliminación si el usuario confirma
                window.location.href = "eliminar_tipores.php?action=delete_tipores&id_tipo=' . $idTipoResol . '";
            } else {
                // Redireccionar a la página de listado de tipo_resols si el usuario cancela
                window.location.href = "tipo_resoluciones.php";
            }
        </script>';

        // Salir del script después de mostrar la alerta de confirmación
        exit;
    } else {
        // El tipo_resol no existe, mostrar mensaje de error
        echo '<script>alert("No se encontró el tipo_resol.");</script>';
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete_tipores' && isset($_GET['id_tipo'])) {
    // Acción para eliminar el tipo_resol
    $idTipoResol = $_GET['id_tipo'];

    // Eliminar al tipo_resol de la base de datos
    $deleteTipoResQuery = "DELETE FROM tipo_resol WHERE id_tipo=?";
    $statement = $conn->prepare($deleteTipoResQuery);
    $statement->bind_param('i', $idTipoResol);

    if ($statement->execute()) {
        // Eliminación exitosa, mostrar alerta de éxito y redireccionar a la página de listado de tipo_resols
        echo '<script>alert("El tipo de resolución fue eliminado con éxito.");</script>';
    } else {
        // Error al eliminar el tipo_resol, mostrar mensaje de error
        echo '<script>alert("Error al eliminar el tipo de resolución: ' . $conn->error . '");</script>';
    }

    // Redireccionar a la página de listado de tipo_resols después de mostrar el mensaje de éxito o error
    echo '<script>window.location.href = "tipo_resoluciones.php";</script>';
    exit;
} else {
    // Redireccionar a la página de listado de tipo_resols si no se proporcionó el ID de tipo_resol o la acción
    header('Location: tipo_resolucion.php');
    exit;
}
?>
