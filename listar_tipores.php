<?php
include_once './conexion/conection.php';
session_start();

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit();
}

if (isset($_POST['add'])) {
    $nombreTipoResol = $_POST["txtNomTipoResol"];
    $nombreTipoResol = strtoupper($nombreTipoResol);
    // Check if any field is empty
    if (empty($nombreTipoResol)) {
        echo '<script>alert("Datos incompletos. Por favor, llene todos los campos.");</script>';
    } else {
        $sql = "INSERT INTO tipo_resol (nom_resol) VALUES (?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param('s', $nombreTipoResol);

        if ($statement->execute()) {
            $idTipoResol = $statement->insert_id;
            echo '<script>alert("El tipo de resolucion se registró correctamente");</script>';
            echo '<script>alert("Los valores se han insertado correctamente en la tabla \'tipo_resol\'. ID de tipo de resolución: '.$idTipoResol.'");window.location.href = "listar_tipores.php";</script>';
        } else {
            // Si ocurrió un error, muestra un mensaje de error
            echo '<script>alert("Error al insertar valores en la tabla \'tipo_resol\': ' . $conn->error . '");</script>';
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
                                <h3>Registrar nuevo tipo de Resolución</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nombre del tipo de resolución:</label>
                                    <input type="text" name="txtNomTipoResol" class="form-control" placeholder="Ingrese el nombre del tipo de resolución">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-center">
                                    <button type="submit" name="add" class="btn btn-primary">
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