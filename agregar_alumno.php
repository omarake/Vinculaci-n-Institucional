<?php
include("mantener_session.php");
include('Conexion.php');

// ===================
// GUARDAR
// ===================
if (isset($_POST['agregar_alumno'])) {
    $stmt = $DB_con->prepare("INSERT INTO alumnos(nombre_alumno, genero_alumno, carrera_alumno, matricula_alumno, semestres_alumno, discapacidad_alumno, maya_alumno) VALUES (?,?,?,?,?,?,?)");
    $stmt->bindParam(1, $_POST['nombre_alumno']);
    $stmt->bindParam(2, $_POST['genero_alumno']);
    $stmt->bindParam(3, $_POST['carrera_alumno']);
    $stmt->bindParam(4, $_POST['matricula_alumno']);
    $stmt->bindParam(5, $_POST['semestres_alumno']);
    $stmt->bindParam(6, $_POST['discapacidad_alumno']);
    $stmt->bindParam(7, $_POST['maya_alumno']);
    if ($stmt->execute()) {
        // EXITO
        print('<script>alert("Se guardo exitosamente");window.location="alumnos.php"</script>');
    } else {
        $errMSG = "Error al guargar la información";
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
                                        <li class="list-inline-item">Agregar Alumno </li>
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
                            <h1 class="title-4">Agregar Alumno
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
                                        <label for="exampleInputEmail1">Nombre</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" maxlength="100" name="nombre_alumno" placeholder="Nombre del alumno" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Matrícula</label>
                                        <div class="form-group">
                                            <input type="number" min="1" class="form-control" placeholder="Matrícula del alumno" name="matricula_alumno" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="my-select">Género</label>
                                            <select id="my-select" class="form-control" name="genero_alumno" required>
                                                <option>Masculino</option>
                                                <option>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="my-select">Semestre y Grupo</label>
                                            <select id="my-select" class="form-control" name="semestres_alumno" required>
                                                <option>1° 'A'</option>
                                                <option>1° 'B'</option>
                                                <option>2° 'A'</option>
                                                <option>2° 'B'</option>
                                                <option>3° 'A'</option>
                                                <option>3° 'B'</option>
                                                <option>4° 'A'</option>
                                                <option>4° 'B'</option>
                                                <option>5° 'A'</option>
                                                <option>5° 'B'</option>
                                                <option>6° 'A'</option>
                                                <option>6° 'B'</option>
                                                <option>7° 'A'</option>
                                                <option>7° 'B'</option>
                                                <option>8° 'A'</option>
                                                <option>8° 'B'</option>
                                                <option>9° 'A'</option>
                                                <option>9° 'B'</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">Carrera</label>
                                        <select id="my-select" class="form-control" name="carrera_alumno" required>
                                            <option>Ingeniería Ambiental</option>
                                            <option>Ingeniería Civil</option>
                                            <option>Ingeniería en Sistemas Computacionales</option>
                                            <option>Ingeniería en Administración</option>
                                            <option>Ingeniería Industrial</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="my-select">¿El alumno es maya hablante?</label>
                                        <select id="my-select" class="form-control" name="maya_alumno" required>
                                            <option>No</option>
                                            <option>Si</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">¿El alumno tiene alguna discapacidad?</label>
                                        <select id="my-select" class="form-control" name="discapacidad_alumno" required>
                                            <option>Ninguna</option>
                                            <option>Discapacidad física</option>
                                            <option>Discapacidad sensorial</option>
                                            <option>Discapacidad auditiva</option>
                                            <option>Discapacidad visual</option>
                                            <option>Discapacidad intelectual</option>
                                            <option>Discapacidad mental</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="agregar_alumno" class="btn btn-primary">Guardar</button>
                                    <a href="alumnos.php"><button class="btn btn-danger" type="button">Cancelar</button></a>
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