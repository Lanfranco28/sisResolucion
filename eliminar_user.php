<?php
include_once './conexion/conection.php';

session_start();

// Verificar el rol del usuario autenticado
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id_usuario'])) {
    $idUser = $_GET['id_usuario'];

    // Verificar si el usuario existe antes de eliminarlo
    $checkUserQuery = "SELECT nom_usuario FROM usuario WHERE id_usuario=?";
    $statement = $conn->prepare($checkUserQuery);
    $statement->bind_param('i', $idUser);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        // El usuario existe, obtener su nombre
        $row = $result->fetch_assoc();
        $nombreUsuario = $row['nom_usuario'];

        // Mostrar alerta de confirmación de eliminación usando JavaScript
        echo '<script>
            var confirmDelete = confirm("¿Seguro que quieres eliminar a: ' . $nombreUsuario . ' ?");
            if (confirmDelete) {
                // Proceder con la eliminación si el usuario confirma
                window.location.href = "eliminar_user.php?action=delete_user&id_usuario=' . $idUser . '";
            } else {
                // Redireccionar a la página de listado de usuarios si el usuario cancela
                window.location.href = "usuario.php";
            }
        </script>';

        // Salir del script después de mostrar la alerta de confirmación
        exit;
    } else {
        // El usuario no existe, mostrar mensaje de error
        echo '<script>alert("No se encontró el usuario.");</script>';
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'delete_user' && isset($_GET['id_usuario'])) {
    // Acción para eliminar el usuario
    $idUser = $_GET['id_usuario'];

    // Eliminar al usuario de la base de datos
    $deleteUserQuery = "DELETE FROM usuario WHERE id_usuario=?";
    $statement = $conn->prepare($deleteUserQuery);
    $statement->bind_param('i', $idUser);

    if ($statement->execute()) {
        // Eliminación exitosa, mostrar alerta de éxito y redireccionar a la página de listado de usuarios
        echo '<script>alert("El usuario fue eliminado con éxito.");</script>';
    } else {
        // Error al eliminar el usuario, mostrar mensaje de error
        echo '<script>alert("Error al eliminar el usuario: ' . $conn->error . '");</script>';
    }

    // Redireccionar a la página de listado de usuarios después de mostrar el mensaje de éxito o error
    echo '<script>window.location.href = "usuario.php";</script>';
    exit;
} else {
    // Redireccionar a la página de listado de usuarios si no se proporcionó el ID de usuario o la acción
    header('Location: usuario.php');
    exit;
}
?>
