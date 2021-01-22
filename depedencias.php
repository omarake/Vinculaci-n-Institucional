<?php
include("mantener_session.php");
include('Conexion.php');

// ===================
// ELIMINAR DEPEDENCIA
// ===================

if (isset($_GET['delete'])) {
    $stmt = $DB_con->prepare('DELETE FROM dependencias WHERE id_dependencia = :id_dependencia');
    $stmt->bindParam(':id_dependencia', $_GET['delete']);
    if ($stmt->execute()) {
        // EXITO
        // print('<script>alert("Registro eliminado exitosamente");window.location="estados.php"</script>');
        header('location:depedencias.php');
    } else {
        echo $errMSG = "Error al eliminar la información";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

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
                                        <li class="list-inline-item">Depedencias</li>
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
                            <h1 class="title-4">Depedencias
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
                                </div>
                                <div class="table-data__tool-right">
                                    <a href="agregar_depedencia.php">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Agregar</button>
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>

                                            <th>Depedencia</th>
                                            <th>Ciudad</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $consulta = $DB_con->prepare("SELECT dependencias.*, estados.*, ciudades.* FROM ((dependencias INNER JOIN ciudades ON dependencias.ciudad_dependencia = ciudades.id_ciudades) INNER JOIN estados ON ciudades.id_estado = estados.id_estado)
                                        ORDER BY nombre_indepedencia ASC");
                                        $consulta->execute();
                                        while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                            echo '<tr class="tr-shadow">
<td>' . $row->nombre_indepedencia . '</td>
<td>' . $row->nombre_ciudad . ', ' . $row->nombre_estado . '</td>
<td>' . $row->correo_dependencia . '</td>
<td>' . $row->telefono_dependencia . '</td>
<td>' . $row->numero_convenios . '</td>
<td>
    <div class="table-data-feature">
        <a href="editar_depedencia.php?id=' . $row->id_dependencia   . '">
            <button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                <i class="zmdi zmdi-edit"></i>
            </button>
        </a>
            <button class="item" Onclick="eliminar' . $row->id_dependencia   . '();"  data-toggle="tooltip" data-placement="top" title="Eliminar">
            <i class="zmdi zmdi-delete"></i>
            </button>
                                            <script type="text/javascript">
                                                function eliminar' . $row->id_dependencia   . '() {
                                                    if (window.confirm("¿Desea eliminar el registro?") == true) {
                                                        window.location = "depedencias.php?delete=' . $row->id_dependencia   . '";
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