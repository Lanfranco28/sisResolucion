<?php
include_once './conexion/conection.php';
session_start();

if (!isset($_SESSION['cargo']) || !$_SESSION['cargo']) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once './includes/head.php'

?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <a class="btn btn-secondary" href="<?php
                                                        switch ($_SESSION['cargo']) {
                                                            case 1:
                                                                echo "index_admin.php";
                                                                break;

                                                            case 2:
                                                                echo "index_colab.php";
                                                                break;
                                                        }
                                                        ?>">⌫ Volver</a>
                </div>
                <h1>Resoluciones Registradas</h1>

                <!-- Barra de búsqueda -->
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
                            <th>Número de Resolución</th>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Tipo de Resolución</th>
                            <th>Archivo PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT resolucion.num_resol, resolucion.titulo, resolucion.fecha, tipo_resol.nom_resol, resolucion.urls
                                FROM resolucion
                                INNER JOIN tipo_resol ON resolucion.id_tipo = tipo_resol.id_tipo";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['num_resol'] . "</td>";
                                echo "<td>" . $row['titulo'] . "</td>";
                                echo "<td>" . $row['fecha'] . "</td>";
                                echo "<td>" . $row['nom_resol'] . "</td>";
                                echo "<td><a class='btn btn-primary' href='http://" . $_SERVER['HTTP_HOST'] . "/sisResolucion/" . $row['urls'] . "' target='_blank'>Ver PDF</a></td>";
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
