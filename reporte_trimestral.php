<?php
include("mantener_session.php");
include("Conexion.php");

if (isset($_GET['fecha'])) { //BUSCAR CONVENIOS

    // RANGO DE FECHA A COMPARAR
    $fecha = date_create($_GET['fecha']);
    date_add($fecha, date_interval_create_from_date_string("-3 months"));

    $mes_i = date_format($fecha, "Y-m-d"); //mes inicio
    $mes_f = $_GET['fecha']; // mes final

    // FORMATEAR FECHAS 
    $mes_inicio = strtotime($mes_i, time());
    $mes_final = strtotime($mes_f);

    // VARIABLES NESESARIAS
    $contadorConvenios = 0;
    $contMicro = 0;
    $contPeque = 0;
    $contMediana = 0;
    $contGrande = 0;

    $mayaHablanteM = 0;
    $mayaHablanteF = 0;

    $fisicaM =0;
    $fisicaF =0;

    $sensorialM =0;
    $sensorialF =0;

    $auditivaM =0;
    $auditivaF =0;

    $visualM =0;
    $visualF =0;

    $intelectualM =0;
    $intelectualF =0;

    $mentalM =0;
    $mentalF =0;


    $infoConvenios = $DB_con->prepare("SELECT dependencias.*, convenios.* FROM convenios INNER JOIN dependencias ON convenios.dependencia_convenio = dependencias.id_dependencia");
    $infoConvenios->execute();
    while ($rowLista = $infoConvenios->fetch(PDO::FETCH_OBJ)) {
        // FECHAS DEL CONVENIO
        $fecha_convenio_inicio = strtotime($rowLista->fechaInicio_convenio);
        $fecha_convenio_final = strtotime($rowLista->fechafinal_convenio);

        // COMPARAR EL RANGO DE FECHAS
        if ((($fecha_convenio_inicio >= $mes_inicio) && ($fecha_convenio_inicio <= $mes_final)) || (($fecha_convenio_final >= $mes_inicio) && ($fecha_convenio_final <= $mes_final))) {

// echo $rowLista->nombre_convenio;
// echo '<br>';

            // DEPEDENCIAS + CONVENIOS
            $infoDepedencias = $DB_con->prepare("SELECT * FROM convenios INNER JOIN dependencias ON convenios.id_convenio = dependencias.id_dependencia WHERE convenios.id_convenio = :id_convenio");
            $infoDepedencias->execute(array('id_convenio' => $rowLista->id_convenio));
            while ($rowDepededencia = $infoDepedencias->fetch(PDO::FETCH_OBJ)) {
                $contadorConvenios++;
                if ($rowDepededencia->tamano_dependencia == 1) { //MICRO
                    $contMicro++;
                } elseif ($rowDepededencia->tamano_dependencia == 2) { //PEQUEÑA
                    $contPeque++;
                } elseif ($rowDepededencia->tamano_dependencia == 3) { //MEDIANA
                    $contMediana++;
                } elseif ($rowDepededencia->tamano_dependencia == 4) { //GRANDE
                    $contGrande++;
                }

                // ALUMNOS DE ESTE CONVENIO
                $infoAlumnos = $DB_con->prepare("SELECT alumnos.*, convenios.*, convenio_alumno.* FROM ((convenio_alumno INNER JOIN alumnos ON convenio_alumno.id_alumno = alumnos.id_alumno) INNER JOIN convenios ON convenios.id_convenio = convenio_alumno.id_convenio) WHERE convenios.id_convenio = :id_convenio");
                $infoAlumnos->execute(array('id_convenio' => $rowDepededencia->id_convenio));
                while ($rowAlumnos = $infoAlumnos->fetch(PDO::FETCH_OBJ)) {

                    if ($rowAlumnos->genero_alumno == 'Masculino') {
                        if ($rowAlumnos->maya_alumno == 'Si') {
                            $mayaHablanteM++;
                        }

                        if ($rowAlumnos->discapacidad_alumno == 'Discapacidad física') {
                            $fisicaM++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad sensorial') {
                            $sensorialM++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad auditiva') {
                            $auditivaM++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad visual') {
                            $visualM++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad intelectual') {
                            $intelectualM++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad mental') {
                            $mentalM++;
                        }
                    }elseif ($rowAlumnos->genero_alumno == 'Femenino') {
                        if ($rowAlumnos->maya_alumno == 'Si') {
                            $mayaHablanteF++;
                        }
                        if ($rowAlumnos->discapacidad_alumno == 'Discapacidad física') {
                            $fisicaF++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad sensorial') {
                            $sensorialF++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad auditiva') {
                            $auditivaF++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad visual') {
                            $visualF++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad intelectual') {
                            $intelectualF++;
                        }elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad mental') {
                            $mentalF++;
                        }
                    }
                }
            }
        }
    }
} else {
    print "<script>window.location='index.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte Trimestral</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 30px;
            /* this affects the margin in the printer settings */
        }
    </style>
    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .control-bar {
            background-color: #333 !important;
        }

        h1 {
            color: #ed1b24 !important;
        }

        hr {
            height: 2px;
            border-width: 0;
            color: gray;
            background-color: gray;
            margin-top: 35px;
        }
    </style>


    <style>
        #customers {
            font-family: 'Century Gothic';
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* #customers tr:nth-child(even){background-color: #f2f2f2;} */

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            /* background-color: #4CAF50; */
            color: black;
        }

        h1 {
            color: black !important;
            font-family: 'Century Gothic';
        }
    </style>

    <script type='text/javascript'>
        document.oncontextmenu = function() {
            return false
        }
    </script>
</head>

<body>

    <div class="control-bar">
        <div class="container">
            <div class="row">
                <div class="col-2-4">
                </div>
                <div class="col-4 text-right">
                    <a href="javascript:window.print()">Imprimir</a>
                </div>
                <!--.col-->
            </div>
            <!--.row-->
        </div>
        <!--.container-->
    </div>
    <!--.control-bar-->

    <div class="row">
        <div class="">
            <img height="100px" src="assets/img/encabezado.png">
        </div>
        <!--.logoholder-->
        <!-- <hr> -->
    </div>
    <br>
    <br>
    <br>

    <div class="row">
        <div class="text-center">
            <h1>Reporte Trimestral
                <br>
                <small>Del <?php
                            $fecha_get = $_GET['fecha'];
                            $fecha = date_create($_GET['fecha']);
                            date_add($fecha, date_interval_create_from_date_string("-3 months"));
                            echo date_format($fecha, "d/m/Y") . ' al ' . date("d/m/Y", strtotime($fecha_get));  ?></small>
            </h1>
        </div>
    </div>

    <br>
    <br>
    <table id="customers">
        <tr>
            <th>Convevios: <?php echo $contadorConvenios; ?></th>
        </tr>
    </table>
    <br>
    <br>
    <table id="customers">
        <tr>
            <td colspan="4" class="text-center">Tamaño de la empresa </td>
        </tr>
        <tr>
            <th>Micro</th>
            <th>Pequeña</th>
            <th>Mediana</th>
            <th>Grande</th>
        </tr>
        <tr>
            <th><?php echo $contMicro; ?></th>
            <th><?php echo $contPeque; ?></th>
            <th><?php echo $contMediana; ?></th>
            <th><?php echo $contGrande; ?></th>
        </tr>
    </table>
    <br>
    <br>
    <table id="customers">
        <tr>
            <td colspan="8" class="text-center">Total de beneficiarios</td>
        </tr>
        <tr>
            <th></th>
            <th>Física</th>
            <th>Sensorial</th>
            <th>Auditiva</th>
            <th>Visual</th>
            <th>Intelectual</th>
            <th>Mental</th>
            <th>Maya Hablante</th>
        </tr>
        <tr>
            <th>Hombres</th>
            <th><?php echo $fisicaM; ?></th>
            <th><?php echo $sensorialM; ?></th>
            <th><?php echo $auditivaM; ?></th>
            <th><?php echo $visualM; ?></th>
            <th><?php echo $intelectualM; ?></th>
            <th><?php echo $mentalM; ?></th>
            <th><?php echo $mayaHablanteM; ?></th>
        </tr>
        <tr>
            <th>Mujeres</th>
            <th><?php echo $fisicaF;?></th>
            <th><?php echo $sensorialF;?></th>
            <th><?php echo $auditivaF;?></th>
            <th><?php echo $visualF;?></th>
            <th><?php echo $intelectualF;?></th>
            <th><?php echo $mentalF;?></th>
            <th><?php echo $mayaHablanteF; ?></th>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="text-center" style="font-size: 12px; font-family:Century Gothic;">
            <p>___________________________________</p>
            <p contenteditable>Lic. Rubí Gutiérrez Terrones.</p>
            <p contenteditable>Jefa del Departamento de Vinculación Institucional.</p>
            <br>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/bower_components/jquery/dist/jquery.min.js"><\/script>')
    </script>
    <script src="assets/js/main.js"></script>
</body>

</html>