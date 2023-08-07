<?php
include_once './conexion/conection.php';
session_start();

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit();
}

$idTipoResol = $_GET['id_tipo']; // Reemplaza 'idUser' con la variable donde almacenas el ID del usuario a editar

$sql = "SELECT * FROM tipo_resol WHERE id_tipo=$idTipoResol";

//Ejecutar la sentencia y recepcionar
$result = mysqli_query($conn, $sql);

// Verificar si hay resultado y obtener los datos del usuario
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nombreTipoResol = $row['nom_resol'];

} else {
    echo '<script>alert("No se encontró el tipo de resolución.");</script>';
    echo '<script>window.location.href = "tipo_resoluciones.php";</script>';
    exit();
}

// Función para manejar la edición de un usuario existente
function editar_tiporesol($conn, $idTipoResol, $nombreTipoResol)
{
    // Verificar si algún campo está vacío
    if (empty($nombreTipoResol)) {
        echo '<script>alert("Datos incompletos. Por favor, llene todos los campos.");</script>';
    } else {
        $sql = "UPDATE tipo_resol SET nom_resol=? WHERE id_tipo=?";
        $statement = $conn->prepare($sql);
        $statement->bind_param('si', $nombreTipoResol, $idTipoResol);

        if ($statement->execute()) {
            echo '<script>alert("El tipo de resolucion se actualizó correctamente");</script>';
            echo '<script>window.location.href = "tipo_resoluciones.php";</script>';
            exit();
        } else {
            // Si ocurrió un error, muestra un mensaje de error
            echo '<script>alert("Error al actualizar el tipo de resolución: ' . $conn->error . '");</script>';
        }
    }
}

// Verificar si se ha enviado el formulario para editar el usuario
if (isset($_POST['edit'])) {
    // Obtener los datos del formulario
    $nombreTipoResol = $_POST['txtNomTipoResol'];
    $nombreTipoResol = strtoupper($nombreTipoResol);
    // Llamar a la función editar_user con los datos obtenidos
    editar_tiporesol($conn, $idTipoResol, $nombreTipoResol);
}
?>


<!DOCTYPE html>
<html lang="en">
<?php
include_once './includes/head.php';
include_once './includes/header_admin.php';
?>
<body>
    <form action="" method="POST">
        <div class="container" id="login">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h3>Editar usuario</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="idTipoResol" value="<?php echo $idTipoResol; ?>">
                                <div class="form-group">
                                    <label>Nombre del tipo de resolucion:</label>
                                    <input type="text" name="txtNomTipoResol" class="form-control" value="<?php echo $nombreTipoResol; ?>">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" name="edit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar
                                    </button>
                                    <a href="tipo_resoluciones.php" class="btn btn-danger">
                                        <i class="fa fa-ban" aria-hidden="true"></i>Cancelar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
