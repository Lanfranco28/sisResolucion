
<?php
include_once './conexion/conection.php';
session_start();

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit();
}

if (isset($_POST['add'])) {
    $nombreUser = $_POST["txtNomUsuario"];
    $contraseñaUser = $_POST["txtContraseñaUsuario"];
    $cargoUser = $_POST["txtCargoUsuario"];

    // Check if any field is empty
    if (empty($nombreUser) || empty($contraseñaUser) || empty($cargoUser)) {
        echo '<script>alert("Datos incompletos. Por favor, llene todos los campos.");</script>';
    } else {
        $sql = "INSERT INTO usuario (nom_usuario, contraseña, id_cargo) VALUES (?, ?, ?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param('ssi', $nombreUser, $contraseñaUser, $cargoUser);

        if ($statement->execute()) {
            $idUser = $statement->insert_id;
            echo '<script>alert("El usuario se registró correctamente");</script>';
            echo '<script>alert("Los valores se han insertado correctamente en la tabla \'usuario\'. ID de usuario: '.$idUser.'");window.location.href = "listar_user.php";</script>';
        } else {
            // Si ocurrió un error, muestra un mensaje de error
            echo '<script>alert("Error al insertar valores en la tabla \'usuario\': ' . $conn->error . '");</script>';
        }
    }
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
                                <h3>Agregar usuario</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="idUser" value="<?php echo $idUser; ?>">
                                <div class="form-group">
                                    <label>Nombre de usuario:</label>
                                    <input type="text" name="txtNomUsuario" class="form-control" placeholder="Ingrese el nombre de usuario"">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña:</label>
                                    <input type="text" name="txtContraseñaUsuario" class="form-control" placeholder="Ingrese la contraseña"">
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
                                    <button type="submit" name="add" class="btn btn-primary">
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