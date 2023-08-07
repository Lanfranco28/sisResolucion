<?php
include_once './conexion/conection.php';

session_start();

if (isset($_GET['cerrar_sesion'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['cargo'])) {
    switch ($_SESSION['cargo']) {
        case 1:
            header('Location: index_admin.php');
            exit;
        
        case 2:
            header('Location: index_colab.php');
            exit;

        default:
    }
}

if (isset($_POST["txtUsuario"]) && isset($_POST["txtPass"])) {
    $usuario = $_POST["txtUsuario"];
    $password = $_POST["txtPass"];
        
    $sql = "SELECT * FROM usuario WHERE nom_usuario='$usuario' AND contraseña='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        $_SESSION['cargo'] = $row['id_cargo'];
        $_SESSION['id_usuario'] = $row['id_usuario'];

        switch ($_SESSION['cargo']) {
            case 1:
                header('Location: index_admin.php');
                exit;
            
            case 2:
                header('Location: index_colab.php');
                exit;
    
            default:
        }
    } else {       
        echo '<script language="javascript">alert("Usuario o contraseña incorrectos.");window.location.href="login.php"</script>';
    }
}

$conn->close();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS RESOLUCION</title>
    <link href="css/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
    <div class="overlay">
        <p style="padding-top:50px;">SISTEMA GESTOR DE RESOLUCIONES</p>
    </div>
</header>
<body>
    <center>
        <form action="#" method="post" id="formulario">
            <div class="card" style="width:28rem;">
                <div class="card-header">
                    <h3>Login de Acceso</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-8 col-form-label">Usuario</label>
                        <div class="col-sm-15">
                            <input type="text" name="txtUsuario" placeholder="Ingrese su Usuario">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-9 col-form-label">Contraseña</label>
                        <div class="col-sm-15">
                            <input type="password" name="txtPass" placeholder="Ingrese su Contraseña">

                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <input type="reset" class="btn btn-danger btn-lg" name="btnCancel" value="Cancelar">
                        </div>
                        <div class="col-sm-5">
                            <input type="submit" class="btn btn-success btn-lg" name="btnEnviar" value="Enviar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </center>
</body>
</html>
