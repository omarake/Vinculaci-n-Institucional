<?php
include("mantener_session.php");
include('Conexion.php');

// ===================
// EDITAR DEPEDENCIA
// ===================
if (isset($_GET['id'])) {
    $consulta = $DB_con->prepare("SELECT * FROM alumnos WHERE id_alumno  = :id_alumno ");
    $consulta->execute(array(':id_alumno' => $_GET['id']));
    $info = $consulta->fetch(PDO::FETCH_ASSOC);
    // echo $info['id_alumno'];

    // COMPROBAMOS SI EXITE LA DEPEDENCIA ENVIADO
    if (!isset($info['id_alumno'])) {
        header('location:alumnos.php');
    }
}

if (isset($_POST['editar_alumno'])) {
    $statement = $DB_con->prepare('UPDATE alumnos SET nombre_alumno=:nombre_alumno ,genero_alumno=:genero_alumno, carrera_alumno=:carrera_alumno ,matricula_alumno=:matricula_alumno,semestres_alumno=:semestres_alumno, discapacidad_alumno = :discapacidad_alumno, maya_alumno = :maya_alumno	WHERE id_alumno  =:id_alumno');
    $statement->execute([
        'nombre_alumno' => $_POST['nombre_alumno'],
        'genero_alumno' =>  $_POST['genero_alumno'],
        'carrera_alumno' =>  $_POST['carrera_alumno'],
        'matricula_alumno' =>  $_POST['matricula_alumno'],
        'semestres_alumno' =>  $_POST['semestres_alumno'],
        'discapacidad_alumno' =>  $_POST['discapacidad_alumno'],
        'maya_alumno' =>  $_POST['maya_alumno'],
        'id_alumno' =>  $_POST['id_alumno'],
    ]);

    if ($statement->execute()) {
        // EXITO
        print('<script>alert("Información editada exitosamente");window.location="alumnos.php"</script>');
    } else {
        $errMSG = "Error al editar la información";
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
                                        <li class="list-inline-item">Editar Alumno </li>
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
                            <h1 class="title-4">Editar Alumno
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
                                    <input type="hidden" name="id_alumno" value="<?php echo $info['id_alumno']; ?>">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nombre</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" maxlength="100" name="nombre_alumno" placeholder="Nombre del alumno" value="<?php echo $info['nombre_alumno']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Matricula</label>
                                        <div class="form-group">
                                            <input type="number" min="1" class="form-control" placeholder="Matricula del alumno" name="matricula_alumno" value="<?php echo $info['matricula_alumno']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="my-select">Genero</label>
                                            <select id="my-select" class="form-control" name="genero_alumno" required>
                                                <?php if ($info['genero_alumno'] == 'Masculino') {
                                                    echo ' <option selected>Masculino</option>
                                              <option>Femenino</option>';
                                                } elseif ($info['genero_alumno'] == 'Femenino') {
                                                    echo ' <option>Masculino</option>
                                              <option selected>Femenino</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="my-select">Semestre y Grupo</label>
                                            <select id="my-select" class="form-control" name="semestres_alumno" required>
                                                <?php switch ($info['semestres_alumno']) {
                                                    case "1° 'A'":
                                                        echo "<option selected>1° 'A'</option>
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
                                                        <option>9° 'B'</option>";
                                                        break;
                                                    case "1° 'B'":
                                                        echo "<option>1° 'A'</option>
                                                        <option selected>1° 'B'</option>
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
                                                        <option>9° 'B'</option>";
                                                        break;
                                                    case "2° 'A'":
                                                        echo "<option>1° 'A'</option>
                                                        <option>1° 'B'</option>
                                                        <option selected>2° 'A'</option>
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
                                                        <option>9° 'B'</option>";
                                                        break;
                                                    case "2° 'B'":
                                                        echo "<option>1° 'A'</option>
                                                            <option>1° 'B'</option>
                                                            <option>2° 'A'</option>
                                                            <option selected>2° 'B'</option>
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
                                                            <option>9° 'B'</option>";
                                                        break;
                                                    case "3° 'A'":
                                                        echo "<option>1° 'A'</option>
                                                            <option>1° 'B'</option>
                                                            <option>2° 'A'</option>
                                                            <option>2° 'B'</option>
                                                            <option selected>3° 'A'</option>
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
                                                            <option>9° 'B'</option>";
                                                        break;
                                                    case "3° 'B'":
                                                        echo "<option>1° 'A'</option>
                                                        <option>1° 'B'</option>
                                                        <option>2° 'A'</option>
                                                        <option>2° 'B'</option>
                                                        <option selected>3° 'A'</option>
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
                                                        <option>9° 'B'</option>";
                                                        break;
                                                    case "4° 'A'":
                                                        echo "<option>1° 'A'</option>
                                                        <option>1° 'B'</option>
                                                        <option>2° 'A'</option>
                                                        <option>2° 'B'</option>
                                                        <option>3° 'A'</option>
                                                        <option>3° 'B'</option>
                                                        <option selected>4° 'A'</option>
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
                                                        <option>9° 'B'</option>";
                                                        break;
                                                    case "4° 'B'":
                                                        echo "<option>1° 'A'</option>
                                                    <option>1° 'B'</option>
                                                    <option>2° 'A'</option>
                                                    <option>2° 'B'</option>
                                                    <option>3° 'A'</option>
                                                    <option>3° 'B'</option>
                                                    <option>4° 'A'</option>
                                                    <option selected>4° 'B'</option>
                                                    <option>5° 'A'</option>
                                                    <option>5° 'B'</option>
                                                    <option>6° 'A'</option>
                                                    <option>6° 'B'</option>
                                                    <option>7° 'A'</option>
                                                    <option>7° 'B'</option>
                                                    <option>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "5° 'A'":
                                                        echo "<option>1° 'A'</option>
                                                        <option>1° 'B'</option>
                                                        <option>2° 'A'</option>
                                                        <option>2° 'B'</option>
                                                        <option>3° 'A'</option>
                                                        <option>3° 'B'</option>
                                                        <option>4° 'A'</option>
                                                        <option>4° 'B'</option>
                                                        <option selected>5° 'A'</option>
                                                        <option>5° 'B'</option>
                                                        <option>6° 'A'</option>
                                                        <option>6° 'B'</option>
                                                        <option>7° 'A'</option>
                                                        <option>7° 'B'</option>
                                                        <option>8° 'A'</option>
                                                        <option>8° 'B'</option>
                                                        <option>9° 'A'</option>
                                                        <option>9° 'B'</option>";
                                                        break;
                                                    case "5° 'B'":
                                                        echo "<option>1° 'A'</option>
                                                    <option>1° 'B'</option>
                                                    <option>2° 'A'</option>
                                                    <option>2° 'B'</option>
                                                    <option>3° 'A'</option>
                                                    <option>3° 'B'</option>
                                                    <option>4° 'A'</option>
                                                    <option>4° 'B'</option>
                                                    <option>5° 'A'</option>
                                                    <option selected>5° 'B'</option>
                                                    <option>6° 'A'</option>
                                                    <option>6° 'B'</option>
                                                    <option>7° 'A'</option>
                                                    <option>7° 'B'</option>
                                                    <option>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "6° 'A'":
                                                        echo "<option>1° 'A'</option>
                                                    <option>1° 'B'</option>
                                                    <option>2° 'A'</option>
                                                    <option>2° 'B'</option>
                                                    <option>3° 'A'</option>
                                                    <option>3° 'B'</option>
                                                    <option>4° 'A'</option>
                                                    <option>4° 'B'</option>
                                                    <option>5° 'A'</option>
                                                    <option>5° 'B'</option>
                                                    <option selected>6° 'A'</option>
                                                    <option>6° 'B'</option>
                                                    <option>7° 'A'</option>
                                                    <option>7° 'B'</option>
                                                    <option>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "6° 'B'":
                                                        echo "<option>1° 'A'</option>
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
                                                    <option selected>6° 'B'</option>
                                                    <option>7° 'A'</option>
                                                    <option>7° 'B'</option>
                                                    <option>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "7° 'A'":
                                                        echo "<option>1° 'A'</option>
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
                                                    <option selected>7° 'A'</option>
                                                    <option>7° 'B'</option>
                                                    <option>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "7° 'B'":
                                                        echo "<option>1° 'A'</option>
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
                                                    <option selected>7° 'B'</option>
                                                    <option>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "8° 'A'":
                                                        echo "<option>1° 'A'</option>
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
                                                    <option selected>8° 'A'</option>
                                                    <option>8° 'B'</option>
                                                    <option>9° 'A'</option>
                                                    <option>9° 'B'</option>";
                                                        break;
                                                    case "8° 'B'":
                                                        echo "<option>1° 'A'</option>
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
                                                <option selected>8° 'B'</option>
                                                <option>9° 'A'</option>
                                                <option>9° 'B'</option>";
                                                        break;
                                                    case "9° 'A'":
                                                        echo "<option>1° 'A'</option>
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
                                                <option selected>9° 'A'</option>
                                                <option>9° 'B'</option>";
                                                        break;
                                                    case "9° 'B'":
                                                        echo "<option>1° 'A'</option>
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
                                        <option selected>9° 'B'</option>";
                                                        break;
                                                    default:
                                                        echo '';
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">Carrera</label>
                                        <select id="my-select" class="form-control" name="carrera_alumno" required>
                                            <?php if ($info['carrera_alumno'] == 'Ingenieria Ambiental') {
                                                echo ' <option selected>Ingenieria Ambiental</option>
                                                <option>Ingenieria Civil</option>
                                                <option>Ingenieria en Sistemas Computacionales</option>
                                                <option>Ingenieria en Administración</option>
                                                <option>Ingenieria Insdustrial</option>';
                                            } elseif ($info['carrera_alumno'] == 'Ingenieria Civil') {
                                                echo ' <option>Ingenieria Ambiental</option>
                                                <option selected>Ingenieria Civil</option>
                                                <option>Ingenieria en Sistemas Computacionales</option>
                                                <option>Ingenieria en Administración</option>
                                                <option>Ingenieria Insdustrial</option>';
                                            } elseif ($info['carrera_alumno'] == 'Ingenieria en Sistemas Computacionales') {
                                                echo ' <option>Ingenieria Ambiental</option>
                                                <option>Ingenieria Civil</option>
                                                <option selected>Ingenieria en Sistemas Computacionales</option>
                                                <option>Ingenieria en Administración</option>
                                                <option>Ingenieria Insdustrial</option>';
                                            } elseif ($info['carrera_alumno'] == 'Ingenieria en Administración') {
                                                echo ' <option>Ingenieria Ambiental</option>
                                                <option>Ingenieria Civil</option>
                                                <option>Ingenieria en Sistemas Computacionales</option>
                                                <option selected>Ingenieria en Administración</option>
                                                <option>Ingenieria Insdustrial</option>';
                                            } elseif ($info['carrera_alumno'] == 'Ingenieria Insdustrial') {
                                                echo ' <option>Ingenieria Ambiental</option>
                                                <option>Ingenieria Civil</option>
                                                <option>Ingenieria en Sistemas Computacionales</option>
                                                <option>Ingenieria en Administración</option>
                                                <option selected>Ingenieria Insdustrial</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="my-select">¿El alumno es maya hablante?</label>
                                        <select id="my-select" class="form-control" name="maya_alumno" required>
                                            <?php if ($info['maya_alumno'] == 'No') {
                                                echo ' <option selected>No</option>
                                                    <option>Si</option>';
                                            } elseif ($info['maya_alumno'] == 'Si') {
                                                echo ' <option>No</option>
                                                    <option selected>Si</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="my-select">¿El alumno tiene alguna discapacidad?</label>
                                        <select id="my-select" class="form-control" name="discapacidad_alumno" required>
                                            <?php if ($info['discapacidad_alumno'] == 'Ninguna') {
                                                echo '<option selected>Ninguna</option>
                                                <option>Discapacidad física</option>
                                                <option>Discapacidad sensorial</option>
                                                <option>Discapacidad auditiva</option>
                                                <option>Discapacidad visual</option>
                                                <option>Discapacidad intelectual</option>
                                                <option>Discapacidad mental</option>';
                                            } elseif ($info['discapacidad_alumno'] == 'Discapacidad física') {
                                                 echo '<option>Ninguna</option>
                                                <option selected>Discapacidad física</option>
                                                <option>Discapacidad sensorial</option>
                                                <option>Discapacidad auditiva</option>
                                                <option>Discapacidad visual</option>
                                                <option>Discapacidad intelectual</option>
                                                <option>Discapacidad mental</option>';
                                            }elseif ($info['discapacidad_alumno'] == 'Discapacidad sensorial') {
                                                echo '<option>Ninguna</option>
                                                <option>Discapacidad física</option>
                                                <option selected>Discapacidad sensorial</option>
                                                <option>Discapacidad auditiva</option>
                                                <option>Discapacidad visual</option>
                                                <option>Discapacidad intelectual</option>
                                                <option>Discapacidad mental</option>';
                                            }elseif ($info['discapacidad_alumno'] == 'Discapacidad auditiva') {
                                                echo '<option>Ninguna</option>
                                                <option>Discapacidad física</option>
                                                <option>Discapacidad sensorial</option>
                                                <option selected>Discapacidad auditiva</option>
                                                <option>Discapacidad visual</option>
                                                <option>Discapacidad intelectual</option>
                                                <option>Discapacidad mental</option>';
                                            }elseif ($info['discapacidad_alumno'] == 'Discapacidad visual') {
                                                echo '<option>Ninguna</option>
                                                <option>Discapacidad física</option>
                                                <option>Discapacidad sensorial</option>
                                                <option>Discapacidad auditiva</option>
                                                <option selected>Discapacidad visual</option>
                                                <option>Discapacidad intelectual</option>
                                                <option>Discapacidad mental</option>';
                                            }elseif ($info['discapacidad_alumno'] == 'Discapacidad intelectual') {
                                                echo '<option>Ninguna</option>
                                                <option>Discapacidad física</option>
                                                <option>Discapacidad sensorial</option>
                                                <option>Discapacidad auditiva</option>
                                                <option>Discapacidad visual</option>
                                                <option selected>Discapacidad intelectual</option>
                                                <option>Discapacidad mental</option>';
                                            }elseif ($info['discapacidad_alumno'] == 'Discapacidad mental') {
                                                echo '<option>Ninguna</option>
                                                <option>Discapacidad física</option>
                                                <option>Discapacidad sensorial</option>
                                                <option>Discapacidad auditiva</option>
                                                <option>Discapacidad visual</option>
                                                <option>Discapacidad intelectual</option>
                                                <option selected>Discapacidad mental</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="editar_alumno" class="btn btn-primary">Guardar Cambios</button>
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