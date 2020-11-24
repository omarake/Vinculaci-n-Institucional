<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="omar">
    <title>Sistema de Administración de Convenios.</title>

    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="https://www.remtur.com/admin/img/instituciones/itsva%20LOGO.png" width="50" alt="Vinculación">
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="index.php">
                                    <i class="fas fa-home"></i>Inicio
                                    <span class="bot-line"></span>
                                </a>
                            </li>
                            <li>
                                <a href="convenios.php">
                                    <i class="fas fa-file-text"></i>
                                    <span class="bot-line"></span>Convenios</a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fas fa-flag"></i>
                                    <span class="bot-line"></span>Depedencias</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item js-item-menu">
                            <i class="fas fa-power-off" title="Cerrar Sesión"></i>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="https://www.remtur.com/admin/img/instituciones/itsva%20LOGO.png" width="50" alt="Vinculación">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-home"></i>Inicio</a>
                        </li>
                        <li>
                            <a href="convenios.php">
                                <i class="fas fa-file-text"></i>Convenios</a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fas fa-flag"></i>Depedencias</a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fas fa-power-off"></i>Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="page-content--bgf7">
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Inicio</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Convenios</li>
                                    </ul>
                                </div>
                                <form class="au-form-icon--sm" action="" method="post">
                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Buscar Convenio">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Agregar Convenio
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive table-responsive-data2">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Titulo</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Titulo de convenio">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Elejir depedencia</label>
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>UVY</option>
                                                <option>CUV</option>
                                                <option>HOTEL OCCIDENTAL</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="exampleInputEmail1">Fecha de inicio</label>

                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="exampleInputEmail1">Fecha de finalización</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleFormControlFile1">Subir Archivo</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © Sistema de Administracion de Convenios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="js/main.js"></script>
    <script defer="" src="../../beacon.min.js" data-cf-beacon='{"rayId":"5e6e91bcadc5ec32","version":"2020.9.1","si":10}'></script>
</body>

</html>