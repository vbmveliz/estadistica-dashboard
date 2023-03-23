<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALAB EIRL</title>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <script src="https://kit.fontawesome.com/60213d354c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="dist/img/logo.jpeg"
                    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="scripts/iniciar-sesion.php" method="POST">
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Acceso</p>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="txtLogin" class="form-control form-control-lg"
                            placeholder="Ingresar el Usuario" />
                            <label class="form-label" for="txtLogin">Usuario</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password"name="txtPassword" class="form-control form-control-lg"
                            placeholder="Ingresar Contraseña" />
                            <label class="form-label" for="txtPassword">Contraseña</label>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <input type="submit" class="btn color__alab btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Ingresar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 color__alab">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
            Copyright © 2023. Derecho de Autor.
            </div>
            <!-- Copyright -->
        </div>
    </section>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
</body>
</html>