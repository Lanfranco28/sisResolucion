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
                <h1>Listado de Usuarios</h3>
    
                <div class="col-md-4 text-right">
                <a href="listar_user.php" class="btn btn-success">
                    <i class="fa fa-newspaper-o"></i> Agregar</a>
                 </div>
                <table class="table wide-table" id="resolutionsTable">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>CONTRASEÑA</th>
                        <th>CARGO</th>
                        <th>OPCIONES</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                        // Consulta para obtener las resoluciones con los datos del archivo PDF
                        $sql = "SELECT usuario.id_usuario, usuario.nom_usuario, usuario.contraseña, cargo.descripcion
                        FROM usuario
                        INNER JOIN cargo ON usuario.id_cargo = cargo.id_cargo";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_usuario'] . "</td>";
                                echo "<td>" . $row['nom_usuario'] . "</td>";
                                echo "<td>" . $row['contraseña'] . "</td>";
                                echo "<td>" . $row['descripcion'] . "</td>";
                                echo "<td>" . '<a href="editar_user.php?id_usuario='. $row['id_usuario'] .'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>'.' 
                                            <a href="eliminar_user.php?action=delete&id_usuario='. $row['id_usuario']. '" class="btn btn-danger"><i class="fa fa-trash"></i></a>'."</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No se encontraron usuarios registrados.</td></tr>";
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