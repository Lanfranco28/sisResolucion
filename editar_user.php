<?php
include_once './conexion/conection.php';
session_start();

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit();
}

$idUser = $_GET['id_usuario']; // Reemplaza 'idUser' con la variable donde almacenas el ID del usuario a editar

$sql = "SELECT * FROM usuario WHERE id_usuario=$idUser";

//Ejecutar la sentencia y recepcionar
$result = mysqli_query($conn, $sql);

// Verificar si hay resultado y obtener los datos del usuario
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nombreUser = $row['nom_usuario'];
    $contraseñaUser = $row['contraseña'];
    $cargoUser = $row['id_cargo'];
} else {
    echo '<script>alert("No se encontró el usuario.");</script>';
    echo '<script>window.location.href = "usuario.php";</script>';
    exit();
}

// Función para manejar la edición de un usuario existente
function editar_user($conn, $idUser, $nombreUser, $contraseñaUser, $cargoUser)
{
    // Verificar si algún campo está vacío
    if (empty($nombreUser) || empty($contraseñaUser) || empty($cargoUser)) {
        echo '<script>alert("Datos incompletos. Por favor, llene todos los campos.");</script>';
    } else {
        $sql = "UPDATE usuario SET nom_usuario=?, contraseña=?, id_cargo=? WHERE id_usuario=?";
        $statement = $conn->prepare($sql);
        $statement->bind_param('ssii', $nombreUser, $contraseñaUser, $cargoUser, $idUser);

        if ($statement->execute()) {
            echo '<script>alert("El usuario se actualizó correctamente");</script>';
            echo '<script>window.location.href = "usuario.php";</script>';
            exit();
        } else {
            // Si ocurrió un error, muestra un mensaje de error
            echo '<script>alert("Error al actualizar el usuario: ' . $conn->error . '");</script>';
        }
    }
}

// Verificar si se ha enviado el formulario para editar el usuario
if (isset($_POST['edit'])) {
    // Obtener los datos del formulario
    $nombreUser = $_POST['txtNomUsuario'];
    $contraseñaUser = $_POST['txtContraseñaUsuario'];
    $cargoUser = $_POST['txtCargoUsuario'];

    // Llamar a la función editar_user con los datos obtenidos
    editar_user($conn, $idUser, $nombreUser, $contraseñaUser, $cargoUser);
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
                                <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
                                <div class="form-group">
                                    <label>Nombre de usuario:</label>
                                    <input type="text" name="txtNomUsuario" class="form-control" value="<?php echo $nombreUser; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña:</label>
                                    <input type="text" name="txtContraseñaUsuario" class="form-control" value="<?php echo $contraseñaUser; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Cargo:</label>
                                    <select name="txtCargoUsuario" id="txtCargoUsuario">
                                        <?php
                                        $sql = "select * from cargo";
                                        $result = $conn->query($sql);

                                        while ($row = mysqli_fetch_array($result)) {
                                            $selected = ($row['id_cargo'] == $cargoUser) ? 'selected' : '';
                                            echo "<option value='" . $row['id_cargo'] . "' $selected>" . $row['descripcion'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" name="edit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>Guardar
                                    </button>
                                    <a href="usuario.php" class="btn btn-danger">
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
