﻿<?php
include("mantener_session.php");
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


if (isset($_POST['editar_convenio'])) {
    // SACAR ID ENVIADO
    $consulta = $DB_con->prepare("SELECT * FROM convenios WHERE id_convenio  = :id_convenio ");
    $consulta->execute(array(':id_convenio' => $_POST['id_convenio']));
    $infoDocumento = $consulta->fetch(PDO::FETCH_ASSOC);
    // $infoDocumento['documento_convenio'];

    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if (empty($_POST['nombre_convenio'])) {
        $errMSG = "El campo nombre no puede estar vacío.";
    } else {
        if ($imgFile) {
            $upload_dir = 'documentos/';
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('pdf'); // valid extensions
            $userpic = rand(1000, 3000000) . "." . $imgExt;
            if (in_array($imgExt, $valid_extensions)) {
                if ($imgSize < 3000000) {
                    unlink($upload_dir . $infoDocumento['documento_convenio']); //Elimina el pdf de la carpeta
                    move_uploaded_file($tmp_dir, $upload_dir . $userpic);
                } else {
                    $errMSG = "El archivo es demasiado pesado, Tamaño máximo 3Mb";
                }
            } else {
                $errMSG = "Solo archivos PDF.";
            }
        } else {
            $userpic = $infoDocumento['documento_convenio'];
        }

        if (!isset($errMSG)) {
            $statement = $DB_con->prepare('UPDATE convenios SET nombre_convenio=:nombre_convenio ,dependencia_convenio=:dependencia_convenio, fechaInicio_convenio=:fechaInicio_convenio ,fechafinal_convenio=:fechafinal_convenio,documento_convenio=:documento_convenio,concepto=:concepto, tipo=:tipo, producto=:producto, evidencia=:evidencia WHERE id_convenio =:id_convenio');
            $statement->execute([
                'nombre_convenio' => $_POST['nombre_convenio'],
                'dependencia_convenio' =>  $_POST['dependencia_convenio'],
                'fechaInicio_convenio' =>  $_POST['fechaInicio_convenio'],
                'fechafinal_convenio' =>  $_POST['fechafinal_convenio'],
                'documento_convenio' =>  $userpic,
                'concepto' =>  $_POST['concepto'],
                'tipo' =>  $_POST['tipo'],
                'producto' =>  $_POST['producto'],
                'evidencia' =>  $_POST['evidencia'],
                'id_convenio' =>  $_POST['id_convenio'],
            ]);
            print('<script>alert("Información editada exitosamente");window.location="convenios.php"</script>');

            // tabla archivos
            // $upArchivo = $DB_con->prepare("UPDATE archivos_empresas SET titulo=:titulo,url_archivo=:url_archivo,archivo=:archivo WHERE id_user = :id_user");
            // $upArchivo->execute(array(':titulo' => $titulo, ':url_archivo' => $url_archivo, ':archivo' => $userpic, ':id_user' => $_SESSION["id_user"]));

            // header('location: mi_qr.php');
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
                            <h1 class="title-4">Editar Convenio
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
                                    <div class="col-8">
                                        <form method="POST" action="editar_convenio.php" enctype="multipart/form-data">
                                            <input type="hidden" name="id_convenio" value="<?php echo $info['id_convenio']; ?>">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Título</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="nombre_convenio" maxlength="100" placeholder="Nombre del convenio" value="<?php echo $info['nombre_convenio'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Elegir depedencia</label>
                                                <div class="form-group">
                                                    <select id="my-select" class="form-control" name="dependencia_convenio" required>
                                                        <?php
                                                        $consulta = $DB_con->prepare("SELECT * FROM dependencias ORDER BY nombre_indepedencia ASC");
                                                        $consulta->execute();
                                                        while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                                            if ($row->id_dependencia == $info['dependencia_convenio']) {
                                                                echo '<option value="' . $row->id_dependencia . '" selected>' . $row->nombre_indepedencia . '</option>';
                                                            } else {
                                                                echo '<option value="' . $row->id_dependencia . '">' . $row->nombre_indepedencia . '</option>';
                                                            }
                                                        } ?>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="exampleInputEmail1">Fecha de inicio</label>
                                                    <input type="date" class="form-control" value="<?php echo $info['fechaInicio_convenio'] ?>" name="fechaInicio_convenio" required>
                                                </div>
                                                <div class="col">
                                                    <label for="f2">Fecha de finalización</label>
                                                    <input type="date" class="form-control" value="<?php echo $info['fechafinal_convenio'] ?>" name="fechafinal_convenio" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="producto">Producto del convenio</label>
                                                <textarea id="producto" class="form-control" name="producto" rows="3" placeholder="Describe el producto del convenio" required><?php echo $info['producto'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="producto">Evidencia del convenio</label>
                                                <textarea id="producto" class="form-control" name="evidencia" rows="3" placeholder="Describe las evidencias del convenio" required><?php echo $info['evidencia'] ?></textarea>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="my-select">Concepto</label>
                                                <select id="my-select" class="form-control" name="concepto">
                                                    <?php
                                                    if ($info['concepto'] == 1) {
                                                        echo '<option value="1" selected>General</option>
<option value="2">Residencias</option>
<option value="3">Servicio Social</option>
<option value="4">Responsabilidad Social</option>
<option value="5">Bolsa de Trabajo</option>
<option value="6">Educación Dual</option>
<option value="7">Investigación</option>
<option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 2) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2" selected>Residencias</option>
                                                        <option value="3">Servicio Social</option>
                                                        <option value="4">Responsabilidad Social</option>
                                                        <option value="5">Bolsa de Trabajo</option>
                                                        <option value="6">Educación Dual</option>
                                                        <option value="7">Investigación</option>
                                                        <option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 3) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2">Residencias</option>
                                                        <option value="3" selected>Servicio Social</option>
                                                        <option value="4">Responsabilidad Social</option>
                                                        <option value="5">Bolsa de Trabajo</option>
                                                        <option value="6">Educación Dual</option>
                                                        <option value="7">Investigación</option>
                                                        <option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 4) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2">Residencias</option>
                                                        <option value="3">Servicio Social</option>
                                                        <option value="4" selected>Responsabilidad Social</option>
                                                        <option value="5">Bolsa de Trabajo</option>
                                                        <option value="6">Educación Dual</option>
                                                        <option value="7">Investigación</option>
                                                        <option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 5) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2">Residencias</option>
                                                        <option value="3">Servicio Social</option>
                                                        <option value="4">Responsabilidad Social</option>
                                                        <option value="5" selected>Bolsa de Trabajo</option>
                                                        <option value="6">Educación Dual</option>
                                                        <option value="7">Investigación</option>
                                                        <option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 6) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2">Residencias</option>
                                                        <option value="3">Servicio Social</option>
                                                        <option value="4">Responsabilidad Social</option>
                                                        <option value="5">Bolsa de Trabajo</option>
                                                        <option value="6" selected>Educación Dual</option>
                                                        <option value="7">Investigación</option>
                                                        <option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 7) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2">Residencias</option>
                                                        <option value="3">Servicio Social</option>
                                                        <option value="4">Responsabilidad Social</option>
                                                        <option value="5">Bolsa de Trabajo</option>
                                                        <option value="6">Educación Dual</option>
                                                        <option value="7" selected>Investigación</option>
                                                        <option value="8">Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    } elseif ($info['concepto'] == 8) {
                                                        echo '<option value="1">General</option>
                                                        <option value="2">Residencias</option>
                                                        <option value="3">Servicio Social</option>
                                                        <option value="4">Responsabilidad Social</option>
                                                        <option value="5">Bolsa de Trabajo</option>
                                                        <option value="6">Educación Dual</option>
                                                        <option value="7">Investigación</option>
                                                        <option value="8" selected>Proyecto Vinculado con el sector productivo o gubernamental</option>';
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="my-select">Tipo</label>
                                                <select id="my-select" class="form-control" name="tipo">
                                                <?php if ($info['tipo'] == 1) {
                                                        echo '<option value="1" selected>Convenio solicitado</option>
                                                        <option value="2">Convenio firmado</option>';
                                                    }elseif ($info['tipo'] == 2) {
                                                        echo '<option value="1">Convenio solicitado</option>
                                                        <option value="2" selected>Convenio firmado</option>';
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                            <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
                                            <div class="form-group">
                                                <br>
                                                <label for="exampleFormControlFile1">Cambiar documento <b>(Solo archivos PDF, Maximo 3Mb)</b></label>
                                                <input type="file" name="user_image" class="form-control-file" id="documento" accept="application/pdf">
                                            </div>

                                            <button type="submit" class="btn btn-primary" name="editar_convenio">Guardar Cambios </button>
                                            <a href="convenios.php"><button class="btn btn-danger" type="button">Cancelar</button></a>

                                        </form>
                                    </div>
                                    <div class="col-4">
                                        <iframe src="documentos/<?php echo $info['documento_convenio'] ?>" frameborder="0" height="100%" width="100%">
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