<?php
class AccessView
{

    //Constructor
    function __construct() {
    }

    function showFormSession()
    {
?>
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Odonto K</title>
            <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/EstiloLogi.css">

        </head>

        <body>
            <div class="d-flex align-items-center" style="height: 100vh;">
                <div class="container my-auto mx-auto row contenedor">
                    <div class="col contenedorForm">
                        <div>
                            <img src="img/logoOdontoK.png" class="logo">
                        </div>

                        <form action="" id="formLogin" method="POST" class="d-block mx-auto formulario">
                            <div class="mt-5">
                                <label for="usser" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usser" id="usser" placeholder="Por favor ingrese su Usuario">
                            </div>
                            <div class="mt-4">
                                <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password_user" id="password_user" placeholder="Por favor ingrese su contraseña">
                            </div>
                            <button type="submit" class="d-block btn btn-primary mx-auto ingresar">Ingresar</button>
                        </form>
                    </div>
                    <div class="col imagen">
                    </div>
                </div>
            </div>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="js/LoginV.js"></script>
        </body>

        </html>

<?php
    }
}
?>