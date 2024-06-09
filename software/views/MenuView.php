<?php
require_once "vendor/session.php"; //Requiere una session
class MenuView
{

    function showMenu($user, $num_users, $num_procedures, $num_patients)
    {

?>
        <!DOCTYPE html>
        <html lang="es">

        <head>

            <title>Odonto K</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Favicon -->
            <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Toastr -->
            <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
            <script src="https://kit.fontawesome.com/d2ec2ed15a.js" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="assets/css/EstiloDashboard.css">


        </head>

        <body class="hold-transition sidebar-mini">
            <div class="wrapper">
                <!------------------------------------------- Barra de navegacion ----------------------------------------->
                <nav class="main-header navbar navbar-expand navar-superior">

                    <!-- Botones izquierdos -->
                    <ul class="navbar-nav ">
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
    -->
                        <li class="nav-item d-none d-sm-inline-block">
                            <a onclick="Menu.menu('MenuController/validateHome')" class="nav-link">Inicio</a>
                        </li>
                    </ul>


                    <!--  Botones de la derecha -->
                    <ul class="navbar-nav ml-auto">


                        <!-- COLOCAR LA PANTALLA GRANDE -->
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </a>
                        </li>

                        <!-- Boton para cerrar sesion -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" role="button" onclick="Menu.closeSession()">
                                <i class="fas fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.navbar -->

                <!------------------------------------------- contenedor MENU  ----------------------------------------->
                <aside class="main-sidebar elevation-4 contenedor-botones">
                    <!-- Brand Logo -->
                    <div class="contenedorLogo">
                        <img src="img/logoOdontoK.png" class="logo" alt="">
                    </div>

                    <!-- Perfil -->
                    <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->

                        <div class="user-panel mt-5 pb-3 mb-3 d-flex align-items-center justify-content-center">

                            <div class="info text-center ">
                                <h2 class="bienvenido">¡Bienvenid@! </h2>
                                <a href="#" class="d-block text-center saludo_usuario"><br><?php echo $user[0]->username; ?></a>
                            </div>
                        </div>

                        <!-- Opciones  Menu -->
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <!-- Boton para administrar procedimientos -->
                                <?php if ($_SESSION['cod_role'] == '103'){ ?>
                                    <li class="nav-item">
                                        <a href="#" onclick="Menu.menu('UserController/paginateUsers')" class="nav-link boton">
                                            <i class="fa-solid fa-users-gear"></i>
                                            <p class="ml-2">Usuarios</p>
                                        </a>
                                    </li>
                                <?php } else { ?>

                                <li class="nav-item">
                                    <a href="#" onclick="Menu.menu('ProcedureController/paginateProcedures')" class="nav-link boton">
                                        <i class="fa-solid fa-book"></i>
                                        <p class="ml-2">Procedimientos</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" onclick="Menu.menu('PatientController/paginatePatients')" class="nav-link boton">
                                        <i class="fas fa-user-injured"></i>
                                        <p class="ml-2">Pacientes</p>
                                    </a>
                                </li>
                                <?php }  ?>

                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">

                            <!-- Aqui se carga el contenido que es requerido -->
                            <div id="content">

                                <div class="row">
                                <?php if ($_SESSION['cod_role'] == '103'){ ?>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box fondo_tarjeta">
                                            <div class="inner">
                                                <h3 class="color_texto_tarejta"><?php echo $num_users ?></h3>
                                                <p>Numero de usuarios registrados</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-user-plus "></i>
                                            </div>
                                            <a href="#" onclick="Menu.menu('UserController/paginateUsers')" class="small-box-footer"> Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box fondo_tarjeta">
                                            <div class="inner">
                                                <h3 class="color_texto_tarejta"><?php echo $num_procedures ?></h3>
                                                <p>Numero de Prodecimientos</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-tooth"></i>
                                            </div>
                                            <a href="#" onclick="Menu.menu('ProcedureController/paginateProcedures')" class="small-box-footer"> Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <div class="small-box fondo_tarjeta">
                                            <div class="inner">
                                                <h3 class="color_texto_tarejta"><?php echo $num_patients ?></h3>
                                                <p>Numero de Pacientes</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-user-injured"></i>
                                            </div>
                                            <a href="#" onclick="Menu.menu('PatientController/paginatePatients')" class="small-box-footer color_texto_tarjeta"> Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php }  ?>

                            </div>

                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->

                <!-- MODAL DONDE SE CARGARA TODO EL CONTENIDO -->
                <div id="my_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Toastr -->
            <script src="plugins/toastr/toastr.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
            <!-- Sweet alert -->


            <script src="js/Menu.js"></script>
            <script src="js/UserJs.js"></script>
            <script src="js/Religion.js"></script>
            <script src="js/Person.js"></script>
            <script src="js/ProcedureJs.js"></script>
            <script src="js/PatientJs.js"></script>


            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>

        </html>

    <?php
    }

    function showStartePage($num_users, $num_procedures, $num_patients)
    {
    ?>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box fondo_tarjeta">
                    <div class="inner">
                        <h3 class="color_texto_tarejta"><?php echo $num_users ?></h3>
                        <p>Numero de usuarios registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus "></i>
                    </div>
                    <a href="#" onclick="Menu.menu('UserController/paginateUsers')" class="small-box-footer"> Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box fondo_tarjeta">
                    <div class="inner">
                        <h3 class="color_texto_tarejta"><?php echo $num_procedures ?></h3>
                        <p>Numero de Prodecimientos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tooth"></i>
                    </div>
                    <a href="#" onclick="Menu.menu('ProcedureController/paginateProcedures')" class="small-box-footer"> Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box fondo_tarjeta">
                    <div class="inner">
                        <h3 class="color_texto_tarejta"><?php echo $num_patients ?></h3>
                        <p>Numero de Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <a href="#" onclick="Menu.menu('PatientController/paginatePatients')" class="small-box-footer color_texto_tarjeta"> Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        </div>
<?php
    }
}
?>