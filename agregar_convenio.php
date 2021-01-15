<?php
include('Conexion.php');

// ===================
// GUARDAR DEPEDENCIA
// ===================
if (isset($_POST['agregar_convenio'])) {

    $archivo_guardado = false;
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if (empty($_POST['nombre_convenio'])) {
        $errMSG = "El nombre no puede estar vacío.";
    } else if (empty($imgFile)) {
        $errMSG = "Debe cargar algun archivo PDF.";
    } else {
        $upload_dir = 'documentos/';
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('pdf'); // valid extensions
        $userpic = rand(1000, 3000000) . "." . $imgExt;
        if (in_array($imgExt, $valid_extensions)) {
            if ($imgSize < 3000000) {
                // ARCHIVO GUARDADO EN LA CARPETA
                move_uploaded_file($tmp_dir, $upload_dir . $userpic);
                $archivo_guardado = true;
            } else {
                $errMSG = "El archivo es demasiado pesado, Tamaño máximo 3Mb";
            }
        } else {
            $errMSG = "Solo archivos PDF.";
        }

        if ($archivo_guardado == true) {
            // GUARDANDO
            $upUsuario = $DB_con->prepare("INSERT INTO convenios(nombre_convenio, dependencia_convenio, fechaInicio_convenio, fechafinal_convenio, documento_convenio) VALUES (:nombre_convenio, :dependencia_convenio, :fechaInicio_convenio, :fechafinal_convenio, :documento_convenio)");
            $upUsuario->execute(array(':nombre_convenio' => $_POST['nombre_convenio'], ':dependencia_convenio' => $_POST['dependencia_convenio'], ':fechaInicio_convenio' => $_POST['fechaInicio_convenio'], ':fechafinal_convenio' => $_POST['fechafinal_convenio'], ':documento_convenio' => $userpic));

            print('<script>alert("Información guardada exitosamente");window.location="convenios.php"</script>');

        }
    }
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
                                <form method="POST" action="agregar_convenio.php"  enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nombre_convenio" maxlength="100" placeholder="Nombre del convenio" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">Depedencia</label>
                                        <select id="my-select" class="form-control" name="dependencia_convenio" required>
                                            <?php
                                            $consulta = $DB_con->prepare("SELECT * FROM dependencias ORDER BY nombre_indepedencia ASC");
                                            $consulta->execute();
                                            while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                                echo '<option value="' . $row->id_dependencia . '">' . $row->nombre_indepedencia . '</option>';
                                            } ?>

                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="f1">Fecha de inicio</label>
                                            <input type="date" class="form-control" name="fechaInicio_convenio" required>
                                        </div>
                                        <div class="col">
                                            <label for="f2">Fecha de finalización</label>
                                            <input type="date" class="form-control" name="fechafinal_convenio" required>
                                        </div>
                                    </div>
                                    <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
                                    <div class="form-group">
                                        <br>
                                        <label for="documento">Subir documento <small><b>(Solo archivos PDF, Maximo 3Mb)</small></p></label>
                                        <input type="file" name="user_image" class="form-control-file" id="documento" accept="application/pdf" required>
                                    </div>

                                    <button type="submit" name="agregar_convenio" class="btn btn-primary">Guardar</button>
                                    <a href="convenios.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
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