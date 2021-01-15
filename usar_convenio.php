<?php
include('Conexion.php');

// ===================
// EDITAR DEPEDENCIA
// ===================
if (isset($_GET['id'])) {
    $consulta = $DB_con->prepare("SELECT * FROM convenios WHERE id_convenio  = :id_convenio ");
    $consulta->execute(array(':id_convenio' => $_GET['id']));
    $info = $consulta->fetch(PDO::FETCH_ASSOC);
    // echo $info['id_convenio'];

    // COMPROBAMOS SI EXITE LA DEPEDENCIA ENVIADO
    if (!isset($info['id_convenio'])) {
        header('location:convenios.php');
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
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="css/theme.css" rel="stylesheet" media="all">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

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
                            <h1 class="title-4 text-center"><?php echo $info['nombre_convenio']; ?>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <section class="statistic statistic2">
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="convenios.php" method="GET">
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Alumno</label>
                                                <br>
                                                <select class="selectpicker form-control" name="id_alumno" data-live-search="true" required>
                                                    <?php
                                                    $consulta = $DB_con->prepare("SELECT * FROM alumnos ORDER BY nombre_alumno ASC");
                                                    $consulta->execute();
                                                    while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                                        echo '<option value="'.$row->id_alumno .'">'.$row->nombre_alumno.'</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="exampleInputEmail1">Fecha de inicio</label>
                                                    <input type="date" class="form-control" min="<?php echo $info['fechaInicio_convenio']; ?>" max="<?php echo $info['fechafinal_convenio']; ?>" name="fechaInicio" required>
                                                </div>
                                                <div class="col">
                                                    <label for="exampleInputEmail1">Fecha de finalización</label>
                                                    <input type="date" min="<?php echo $info['fechaInicio_convenio']; ?>" max="<?php echo $info['fechafinal_convenio']; ?>" class="form-control" name="fechaFinal" required>
                                                </div>
                                            </div>
                                            <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
                                            <div class="form-group">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                <a href="convenios.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <iframe src="documentos/<?php echo $info['documento_convenio']; ?>" frameborder="0" height="400" width="100%">
                                        </iframe>
                                    </div>
                                </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

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