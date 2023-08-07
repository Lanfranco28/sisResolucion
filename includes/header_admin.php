<header>
    <div class="container-fluid">
    <div class="row">
        <div class="col-1">        
            <nav class="navbar navbar-dark">
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="offcanvasWithBackdrop">
                <span class="navbar-toggler-icon"></span>
              </button>
              <section class="offcanvas offcanvas-start" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel" id="menuLateral" >
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-dark">Menu Administrador</h5>
                    <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column justify-content-between px-0">
                    <ul class="navbar-nav fs-5">
                        <li class="nav-item p-2 py-md-1"><a href="index_admin.php" class="nav-link text-dark"><i class="bi bi-file-earmark-arrow-up"></i>Registrar resolucion</a></li>
                        <li class="nav-item p-2 py-md-1"><a href="ver_resoluciones.php" class="nav-link text-dark"><i class="bi bi-file-earmark-pdf"></i>Ver resoluciones</a></li>
                        <li class="nav-item p-2 py-md-1"><a href="usuario.php" class="nav-link text-dark"><i class="bi bi-person-fill"></i>Usuarios</a></li>
                        <li class="nav-item p-2 py-md-1"><a href="historial.php" class="nav-link text-dark"><i class="bi bi-person-lines-fill"></i>Historial de usuarios</a></li>
                        <li class="nav-item p-2 py-md-1"><a href="tipo_resoluciones.php" class="nav-link text-dark"><i class="bi bi-text-wrap"></i>Tipos de resoluciones</a></li>
                    </ul>
                </div>
            </section>
        </nav>
        </div>
        <div class="col-9"><p style="padding-top: 25px;">SISTEMA GESTOR DE RESOLUCIONES ADMIN</p></div>
        <div class="col-1 d-flex align-items-center justify-content-end">
            <a href="login.php?cerrar_sesion=1" class="btn btn-sm btn-light d-inline-flex align-items-center">
              <i class="fa fa-sign-out me-2"></i>
              <span style="white-space: nowrap;">Cerrar sesión</span>
            </a>
        </div>
    </div>
    </div>
</header>