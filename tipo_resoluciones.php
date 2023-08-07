<?php
include_once './conexion/conection.php';

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
            <div class="col-md-8">
                <h1>Tipos de Resoluciones</h3>
    
                <div class="col-md-4 text-right">
                <a href="listar_tipores.php" class="btn btn-success">
                    <i class="fa fa-newspaper-o"></i> Agregar</a>
                 </div>
                <table class="table wide-table" id="resolutionsTable">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        // Consulta para obtener las resoluciones con los datos del archivo PDF
                        $sql = "SELECT tipo_resol.id_tipo, tipo_resol.nom_resol
                        FROM tipo_resol";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_tipo'] . "</td>";
                                echo "<td>" . $row['nom_resol'] . "</td>";
                                echo "<td>" . '<a href="editar_tipores.php?id_tipo='. $row['id_tipo'] .'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>'.' 
                                            <a href="eliminar_tipores.php?action=delete&id_tipo='. $row['id_tipo']. '" class="btn btn-danger"><i class="fa fa-trash"></i></a>'."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No se encontraron tipos de resoluciones registrados.</td></tr>";
                        }
                        ?>
                 </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php
$conn->close();
?>