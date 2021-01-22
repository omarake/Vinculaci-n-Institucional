<?php
include("mantener_session.php");
include('Conexion.php');

// ===================
// GUARDAR CIUDAD
// ===================

if (isset($_POST['guardar_ciudad'])) {
    $statement = $DB_con->prepare('INSERT INTO ciudades(nombre_ciudad, id_estado) VALUES (:nombre_ciudad, :id_estado)');
    $statement->bindParam(':nombre_ciudad', $_POST['ciudad']);
    $statement->bindParam(':id_estado', $_POST['id_estado']);
    if ($statement->execute()) {
        // EXITO
        print('<script>alert("Se guardo exitosamente");window.location="ciudades.php"</script>');
    } else {
        $errMSG = "Error al guargar la información";
    }
}

// ===================
// EDITAR ESTADO
// ===================
if (isset($_GET['id'])) {
    $consulta = $DB_con->prepare("SELECT estados.*, ciudades.* FROM estados INNER JOIN ciudades ON estados.id_estado = ciudades.id_estado WHERE ciudades.id_ciudades  =:id_ciudades");
    $consulta->execute(array(':id_ciudades' => $_GET['id']));
    $infoEstado = $consulta->fetch(PDO::FETCH_ASSOC);
    // echo $infoEstado['id_ciudades'];

    // COMPROBAMOS SI EXITE EL ESTADO ENVIADO
    if (!isset($infoEstado['id_estado'])) {
        header('location:estados.php');
    }
}


if (isset($_POST['editar_estado'])) {
    echo $_POST['id_estado'];

    $statement = $DB_con->prepare('UPDATE ciudades SET nombre_ciudad=:nombre_ciudad ,id_estado=:id_estado WHERE id_ciudades =:id_ciudades');
    $statement->execute([
        'nombre_ciudad' => $_POST['ciudad'],
        'id_estado' =>  $_POST['id_estado'],
        'id_ciudades' =>  $_POST['id_ciudades'],
    ]);

    if ($statement->execute()) {
        // EXITO
        print('<script>alert("Información editada exitosamente");window.location="ciudades.php"</script>');
    } else {
        $errMSG = "Error al editar la información";
    }
}

// ===================
// ELIMINAR CIUDAD
// ===================

if (isset($_GET['delete'])) {
    $stmt = $DB_con->prepare('DELETE FROM ciudades WHERE id_ciudades = :id_ciudades');
    $stmt->bindParam(':id_ciudades', $_GET['delete']);
    if ($stmt->execute()) {
        // EXITO
        // print('<script>alert("Registro eliminado exitosamente");window.location="estados.php"</script>');
        header('location:ciudades.php');
    } else {
        echo $errMSG = "Error al eliminar la información";
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

        <?php if (isset($_GET['id'])) { ?>
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
                                            <li class="list-inline-item">Ciudades </li>
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
                                <h1 class="title-4">Editar Ciudad
                                </h1>
                                <hr class="line-seprate">
                                <?php if (isset($errMSG)) {
                                    // Mensaje en caso de error
                                    echo '<div class="alert alert-danger" role="alert"> ' . $errMSG . ' </div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="statistic statistic2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive table-responsive-data2">
                                    <form method="POST" action="ciudad.php">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ciudad</label>
                                            <div class="form-group">
                                                <input type="text" name="ciudad" class="form-control" value="<?php echo $infoEstado['nombre_ciudad']; ?>" placeholder="Nombre de la ciudad" maxlength="35" required>

                                                
                                                <input type="hidden" name="id_ciudades" value="<?php echo $infoEstado['id_ciudades']; ?>">
                                            </div>

                                            <div class="form-group">
                                            <label for="my-select">Estado</label>
                                            <select id="my-select" class="form-control" name="id_estado">
                                                <?php
                                                $consulta = $DB_con->prepare("SELECT * FROM estados");
                                                $consulta->execute();
                                                while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                                    if ($infoEstado['id_estado'] == $row->id_estado) {
                                                        echo '<option value="' . $row->id_estado . '" selected>' . $row->nombre_estado . '</option>';
                                                    }else {
                                                        echo '<option value="' . $row->id_estado . '" >' . $row->nombre_estado . '</option>';
                                                    }
                                                } ?>

                                            </select>
                                        </div>

                                        </div>
                                        <button type="submit" name="editar_estado" class="btn btn-primary">Guardar Cambios</button>
                                        <a href="estados.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
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
        <?php } else { ?>
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
                                            <li class="list-inline-item">Ciudades </li>
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
                                <h1 class="title-4">Agregar Ciudad
                                </h1>
                                <hr class="line-seprate">
                                <?php if (isset($errMSG)) {
                                    // Mensaje en caso de error
                                    echo '<div class="alert alert-danger" role="alert"> ' . $errMSG . ' </div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="statistic statistic2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="table-responsive table-responsive-data2">
                                    <form method="POST" action="ciudad.php">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ciudad</label>
                                            <div class="form-group">
                                                <input type="text" name="ciudad" class="form-control" placeholder="Nombre de la ciudad" maxlength="35" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="my-select">Estado</label>
                                            <select id="my-select" class="form-control" name="id_estado">
                                            <?php
                                        $consulta = $DB_con->prepare("SELECT * FROM estados");
                                        $consulta->execute();
                                        while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                                            echo '<option value="'. $row->id_estado .'" >'. $row->nombre_estado .'</option>';
                                        }?>
                                                
                                            </select>
                                        </div>
                                        <button type="submit" name="guardar_ciudad" class="btn btn-primary">Guardar</button>
                                        <a href="ciudades.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
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
        <?php } ?>


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