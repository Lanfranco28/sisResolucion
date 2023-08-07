<?php
// Verificar el inicio de sesión y redirigir si no está autenticado
session_start();

if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
include_once './includes/head.php';

include_once './includes/header_admin.php';

?>
<body>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="uploaded.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h3>Cargar resolucion</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Numero de resolucion:</label>
                            <input type="text" name="txtresol" class="form-control" placeholder="Ingrese el numero de resolucion">
                        </div>
                        <div class="form-group">
                            <label>Titulo de resolucion:</label>
                            <input type="text" name="txtarticulo" class="form-control" placeholder="Ingrese el titulo de resolucion">
                        </div>
                        <div class="form-group">
                            <label>Fecha:</label>
                            <input type="date" name="txtfecha" class="form-control" placeholder="Ingrese la fecha">
                        </div>
                        <div class="form-group">
                            <label>Tipo de resolucion:</label>
                            <select id="txttipo" name="txttipo">
                                <?php include('./conexion/conection.php');
                                $sql = "select * from tipo_resol";
                                $result = $conn->query($sql);

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['id_tipo'] . "'>" . $row['nom_resol'] . "</option>";
                                        }
                                        ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Importar resolucion:</label>
                            <input type="file" name="file" id="file" class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <input type="submit" value="Subir Resolucion" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
