<?php
include_once './conexion/conection.php';

session_start();

if (!isset($_SESSION['cargo'])) {
    header('location: login.php');
} else {
    if ($_SESSION['cargo'] != 1) {
        header('location: login.php');
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Historial de Resoluciones Registradas</h1>

                <div class="mb-3">
                    <label>Buscar por texto:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar resolución" oninput="search()">
                </div>
                <div class="mb-3">
                    <label>Buscar por rango de fecha:</label>
                    <input type="text" id="fechaInput" class="form-control" placeholder="(AÑO MES DIA - AÑO MES DIA) o (AÑO/MES/DIA - AÑO/MES/DIA)" oninput="search()">
                </div>

                <table class="table wide-table" id="resolutionsTable">
                    <thead>
                        <tr>
                            <th>N° de Resolución</th>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Hora de registro</th>                            
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener las resoluciones con los datos del archivo PDF
                        $sql = "SELECT resolucion.num_resol, resolucion.titulo, resolucion.fecha, resolucion.hora, usuario.nom_usuario
                        FROM resolucion
                        INNER JOIN usuario ON resolucion.id_usuario = usuario.id_usuario";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['num_resol'] . "</td>";
                                echo "<td>" . $row['titulo'] . "</td>";
                                echo "<td>" . $row['fecha'] . "</td>";
                                echo "<td>" . $row['hora'] . "</td>";
                                echo "<td>" . $row['nom_usuario'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No se encontraron resoluciones registradas.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/search.js"></script>
</body>

</html>

<?php
$conn->close();
?>
