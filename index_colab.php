<?php

    session_start();



    if(!isset($_SESSION['cargo'])){
        header('location: login.php');
    }else{
        if($_SESSION['cargo'] != 2){
            header('location: login.php');
        }
    } 
       

?>
<!DOCTYPE html>
<html lang="en">
<?php    
include_once './includes/head.php';
?>
<body>
<header>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-10">
            <p class="text-center" style="padding-top: 20px; margin: 0;">SISTEMA GESTOR DE RESOLUCIONES COLABORADOR</p>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a href="login.php?cerrar_sesion=1" class="btn btn-sm btn-light d-inline-flex align-items-center">
              <i class="fa fa-sign-out me-2"></i>
              <span style="white-space: nowrap;">Cerrar sesión</span>
            </a>
        </div>
    </div>
</div>
</header>
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
                            <input type="text" name="txtresol_colab" class="form-control" placeholder="Ingrese el numero de resolucion">
                        </div>
                        <div class="form-group">    
                            <label>Titulo de resolucion:</label>
                            <input type="text" name="txtarticulo_colab" class="form-control" placeholder="Ingrese el titulo de resolucion">
                        </div>
                        <div class="form-group">
                            <label>Fecha:</label>
                            <input type="date" name="txtfecha_colab" class="form-control" placeholder="Ingrese la fecha">
                        </div>
                        <div class="form-group">    
                            <label>Tipo de resolucion:</label>
                            <select id="txttipo_colab" name="txttipo_colab">
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
                            <a class="btn btn-primary" href="ver_resoluciones.php">Ver resoluciones</a>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
