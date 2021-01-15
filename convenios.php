<?php
include('Conexion.php');

// ===================
// ELIMINAR DEPEDENCIA
// ===================

// ELIMINAR TALLER
if (isset($_GET['delete'])) {

    // Selecciona pdf
    $consulta = $DB_con->prepare('SELECT * FROM convenios WHERE id_convenio =:id_convenio');
    $consulta->execute(array(':id_convenio' => $_GET['delete']));
    $imgRow = $consulta->fetch(PDO::FETCH_ASSOC);
    // elimina pdf de la carpeta
    unlink("documentos/" . $imgRow['documento_convenio']);

    // Consulta para eliminar el registro de la base de datos
    $delete = $DB_con->prepare('DELETE FROM convenios WHERE id_convenio =:id_convenio');
    $delete->execute(array(':id_convenio' => $_GET['delete']));

    header("Location: convenios.php");
}
?>
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
        <?php include('header.php'); ?>


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
                                <!-- <form class="au-form-icon--sm" action="" method="post">
                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Buscar Convenio">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Convenios
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <!-- <div class="rs-select2--light rs-select2--md">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">Ver todos</option>
                                            <option value="">Activos</option>
                                            <option value="">Inactivos</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div> -->
                                </div>
                                <div class="table-data__tool-right">
                                    <a href="agregar_convenio.php">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Agregar</button>
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>Convenio</th>
                                            <th>Depedencia</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha final</th>
                                            <th>Status</th>
                                            <th>Usos</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = $DB_con->prepare("SELECT dependencias.*, convenios.* FROM convenios INNER JOIN dependencias ON convenios.dependencia_convenio = dependencias.id_dependencia");
                                        $consulta->execute();
                                        while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                            echo '<tr class="tr-shadow">
<td>' . $row->nombre_convenio . '</td>
<td>' . $row->nombre_indepedencia . '</td>
<td>' . $row->fechaInicio_convenio . '</td>
<td>' . $row->fechafinal_convenio . '</td>
<td><span class="status--process">Activo</span></td>
<td>' . $row->uso_convenios . '</td>
<td>
    <div class="table-data-feature">
    <a href="usar_convenio.php?id=' . $row->id_convenio . '">
        <button class="item" data-toggle="tooltip" data-placement="top" title="Usar">
             <i class="fa fa-plus"></i>
        </button>
    </a>
    <a href="">
        <button class="item" data-toggle="tooltip" data-placement="top" title="Mas información">
             <i class="fas fa-info-circle"></i>
        </button>
    </a>
        <a href="editar_convenio.php?id=' . $row->id_convenio . '">
            <button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                <i class="zmdi zmdi-edit"></i>
            </button>
        </a>
            <button class="item" Onclick="eliminar' . $row->id_convenio . '();"  data-toggle="tooltip" data-placement="top" title="Eliminar">
            <i class="zmdi zmdi-delete"></i>
            </button>
                <script type="text/javascript">
                    function eliminar' . $row->id_convenio    . '() {
                        if (window.confirm("¿Desea eliminar el registro?") == true) {
                                                        window.location = "convenios.php?delete=' . $row->id_convenio    . '";
                        }
                    }
                </script>

    </div>
</td>
</tr>';
                                        } ?>
                                    </tbody>
                                </table>
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
                                <p>Sistema de Administracion de Convenios</p>
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