<?php
include("mantener_session.php");
include('Conexion.php');

// ===================
// EDITAR DEPEDENCIA
// ===================
if (isset($_GET['id'])) {
    $consulta = $DB_con->prepare("SELECT * FROM dependencias WHERE id_dependencia = :id_dependencia");
    $consulta->execute(array(':id_dependencia' => $_GET['id']));
    $info = $consulta->fetch(PDO::FETCH_ASSOC);
    // echo $info['id_ciudades'];

    // COMPROBAMOS SI EXITE LA DEPEDENCIA ENVIADO
    if (!isset($info['id_dependencia'])) {
        header('location:depedencias.php');
    }
}


if (isset($_POST['editar_depedencia'])) {
    $statement = $DB_con->prepare('UPDATE dependencias SET nombre_indepedencia=:nombre_indepedencia ,correo_dependencia=:correo_dependencia, telefono_dependencia=:telefono_dependencia ,tamano_dependencia=:tamano_dependencia,ciudad_dependencia=:ciudad_dependencia WHERE id_dependencia  =:id_dependencia');
    $statement->execute([
        'nombre_indepedencia' => $_POST['nombre_indepedencia'],
        'correo_dependencia' =>  $_POST['correo_dependencia'],
        'telefono_dependencia' =>  $_POST['telefono_dependencia'],
        'tamano_dependencia' =>  $_POST['tamano_dependencia'],
        'ciudad_dependencia' =>  $_POST['ciudad_dependencia'],
        'id_dependencia' =>  $_POST['id_dependencia'],
    ]);

    if ($statement->execute()) {
        // EXITO
        print('<script>alert("Información editada exitosamente");window.location="depedencias.php"</script>');
    } else {
        $errMSG = "Error al editar la información";
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
                                        <li class="list-inline-item">Dependencia </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Editar Dependencia
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
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Depedencia</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nombre_indepedencia" placeholder="Nombre de la depedencia" value="<?php echo $info['nombre_indepedencia']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">Ciudad</label>
                                        <select id="my-select" class="form-control" name="ciudad_dependencia" required>
                                            <?php
                                            $consulta = $DB_con->prepare("SELECT estados.*, ciudades.* FROM estados INNER JOIN ciudades ON estados.id_estado = ciudades.id_estado ORDER BY nombre_ciudad ASC");
                                            $consulta->execute();
                                            while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                                if ($info['ciudad_dependencia'] == $row->id_ciudades) {
                                                    echo '<option value="' . $row->id_ciudades . '" selected>' . $row->nombre_ciudad . ', ' . $row->nombre_estado . '</option>';
                                                } else {
                                                    echo '<option value="' . $row->id_ciudades . '">' . $row->nombre_ciudad . ', ' . $row->nombre_estado . '</option>';
                                                }
                                            } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">Tamaño de la empresa</label>
                                        <select id="my-select" class="form-control" name="tamano_dependencia" required>
                                            <?php
                                            if ($info['tamano_dependencia'] == 'Micro') {
                                                echo '<option selected>Micro</option>
                                                    <option>Pequeña</option>
                                                    <option>Mediana</option>
                                                    <option>Macro</option>';
                                            } elseif ($info['tamano_dependencia'] == 'Pequeña') {
                                                echo '<option>Micro</option>
                                                    <option selected>Pequeña</option>
                                                    <option>Mediana</option>
                                                    <option>Macro</option>';
                                            }elseif ($info['tamano_dependencia'] == 'Mediana') {
                                                echo '<option>Micro</option>
                                                <option>Pequeña</option>
                                                <option selected>Mediana</option>
                                                <option>Macro</option>';
                                            }elseif ($info['tamano_dependencia'] == 'Macro') {
                                                echo '<option>Micro</option>
                                                <option>Pequeña</option>
                                                <option>Mediana</option>
                                                <option selected>Macro</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Correo</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="correo_dependencia" placeholder="Correo de contacto" value="<?php echo $info['correo_dependencia']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Telefono</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="telefono_dependencia" placeholder="Telefono de contacto" value="<?php echo $info['telefono_dependencia']; ?>" required>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="id_dependencia" placeholder="Telefono de contacto" value="<?php echo $info['id_dependencia']; ?>" required>
                                    <button type="submit" name="editar_depedencia" class="btn btn-primary">Guardar</button>
                                    <a href="depedencias.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
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