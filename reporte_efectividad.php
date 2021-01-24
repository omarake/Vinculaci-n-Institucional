<?php
include("mantener_session.php");
include("Conexion.php");

if (isset($_GET['fecha'])) { //BUSCAR CONVENIOS
    // RANGO DE FECHA A COMPARAR
    $fecha = date_create($_GET['fecha']);
    date_add($fecha, date_interval_create_from_date_string("-6 months"));

    $mes_i = date_format($fecha, "Y-m-d"); //mes inicio
    $mes_f = $_GET['fecha']; // mes final

    // FORMATEAR FECHAS 
    $mes_inicio = strtotime($mes_i, time());
    $mes_final = strtotime($mes_f);

    $conveniosSolicitados = 0;
    $conveniosFirmados = 0;

   

    $infoConvenios = $DB_con->prepare("SELECT dependencias.*, convenios.* FROM convenios INNER JOIN dependencias ON convenios.dependencia_convenio = dependencias.id_dependencia");
    $infoConvenios->execute();
    // MOSTAR LISTA
    while ($rowLista = $infoConvenios->fetch(PDO::FETCH_OBJ)) {
        // FECHAS DEL CONVENIO
        $fecha_convenio_inicio = strtotime($rowLista->fechaInicio_convenio);
        $fecha_convenio_final = strtotime($rowLista->fechafinal_convenio);

        // COMPARAR EL RANGO DE FECHAS
        if ((($fecha_convenio_inicio >= $mes_inicio) && ($fecha_convenio_inicio <= $mes_final)) || (($fecha_convenio_final >= $mes_inicio) && ($fecha_convenio_final <= $mes_final))) {
            if ($rowLista->tipo == 1) {
                $conveniosSolicitados++;
            } elseif ($rowLista->tipo == 2) {
                $conveniosFirmados++;
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
    <title>Reporte de efectividad</title>
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
            text-align: left;
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
            <h1>Reporte de efectividad
                <br>
                <small>Del <?php
                            $fecha_get = $_GET['fecha'];
                            $fecha = date_create($_GET['fecha']);
                            date_add($fecha, date_interval_create_from_date_string("-6 months"));
                            echo date_format($fecha, "d/m/Y") . ' al ' . date("d/m/Y", strtotime($fecha_get));  ?></small>
            </h1>
        </div>
    </div>

    <br>
    <br>

    <table id="customers">
        <tr>
            <th>Convenios solicitados</th>
            <th><?php echo $conveniosSolicitados; ?></th>
        </tr>
        <tr>
            <th>Convenios firmados</th>
            <th><?php echo $conveniosFirmados; ?></th>
        </tr>
    </table>
    <?php
    $listaConvenios = $DB_con->prepare("SELECT dependencias.*, convenios.* FROM convenios INNER JOIN dependencias ON convenios.dependencia_convenio = dependencias.id_dependencia WHERE convenios.tipo = :tipo");
    $listaConvenios->execute(array('tipo' => 2));
    // MOSTAR LISTA
    while ($rowConvenio = $listaConvenios->fetch(PDO::FETCH_OBJ)) {
        // FECHAS DEL CONVENIO
        $fecha_convenio_inicio = strtotime($rowConvenio->fechaInicio_convenio);
        $fecha_convenio_final = strtotime($rowConvenio->fechafinal_convenio);

        // COMPARAR EL RANGO DE FECHAS
        if ((($fecha_convenio_inicio >= $mes_inicio) && ($fecha_convenio_inicio <= $mes_final)) || (($fecha_convenio_final >= $mes_inicio) && ($fecha_convenio_final <= $mes_final))) {

            // ============================================================
            // tabla 1
            $contadorUsos = 0;
            // CONTADOR DE USOS
            $consultaUso = $DB_con->prepare("SELECT * FROM convenio_alumno WHERE id_convenio = :id_convenio");
            $consultaUso->execute(array('id_convenio' => $rowConvenio->id_convenio));
            while ($contador = $consultaUso->fetch(PDO::FETCH_OBJ)) {
                $contadorUsos++;
            }
            // ============================================================
            // tabla 2
                         // VARIBLES TABLA 2
    $mayaHablanteM = 0;
    $mayaHablanteF = 0;

    $fisicaM = 0;
    $fisicaF = 0;

    $sensorialM = 0;
    $sensorialF = 0;

    $auditivaM = 0;
    $auditivaF = 0;

    $visualM = 0;
    $visualF = 0;

    $intelectualM = 0;
    $intelectualF = 0;

    $mentalM = 0;
    $mentalF = 0;

    $beneficiarios = 0;
    $contadorMasculinos =0;
    $contadorFemeninas =0;

            // ALUMNOS DE ESTE CONVENIO
            $infoAlumnos = $DB_con->prepare("SELECT alumnos.*, convenios.*, convenio_alumno.* FROM ((convenio_alumno INNER JOIN alumnos ON convenio_alumno.id_alumno = alumnos.id_alumno) INNER JOIN convenios ON convenios.id_convenio = convenio_alumno.id_convenio) WHERE convenios.id_convenio = :id_convenio");
            $infoAlumnos->execute(array('id_convenio' => $rowConvenio->id_convenio));
            while ($rowAlumnos = $infoAlumnos->fetch(PDO::FETCH_OBJ)) {
    
                $beneficiarios++;

                if ($rowAlumnos->genero_alumno == 'Masculino') {
                    $contadorMasculinos++;
                    if ($rowAlumnos->maya_alumno == 'Si') {
                        $mayaHablanteM++;
                    }

                    if ($rowAlumnos->discapacidad_alumno == 'Discapacidad física') {
                        $fisicaM++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad sensorial') {
                        $sensorialM++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad auditiva') {
                        $auditivaM++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad visual') {
                        $visualM++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad intelectual') {
                        $intelectualM++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad mental') {
                        $mentalM++;
                    }
                } elseif ($rowAlumnos->genero_alumno == 'Femenino') {
                    $contadorFemeninas++;
                    if ($rowAlumnos->maya_alumno == 'Si') {
                        $mayaHablanteF++;
                    }
                    if ($rowAlumnos->discapacidad_alumno == 'Discapacidad física') {
                        $fisicaF++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad sensorial') {
                        $sensorialF++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad auditiva') {
                        $auditivaF++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad visual') {
                        $visualF++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad intelectual') {
                        $intelectualF++;
                    } elseif ($rowAlumnos->discapacidad_alumno == 'Discapacidad mental') {
                        $mentalF++;
                    }
                }
            }

echo '<br><br>
<br>';
            // TABLA 1
            echo '
            <table id="customers">
                <tr>
                    <th colspan="2" style="text-align: center !important;"><b>' . $rowConvenio->nombre_convenio . '</b></th>
                </tr>
                <tr>
                    <th>Depedencia</th>
                    <th>' . $rowConvenio->nombre_indepedencia . '</th>
                </tr>
                <tr>
                    <th>Producto del convenio</th>
                    <th>' . $rowConvenio->producto . '</th>
                </tr>
                <tr>
                    <th>Evidencia</th>
                    <th>' . $rowConvenio->evidencia . '</th>
                </tr>
                <tr>
                <th>Participantes en el convenio</th>
                    <th>'.$contadorUsos.'</th>
                </tr>
            </table>';

            // TABLA 2
            echo '<br>
            <table id="customers">
                <tr>
                    <th colspan="8">BENEFICIARIOS</th>
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
                    <th>'.$fisicaM.'</th>
                    <th>'.$sensorialM.'</th>
                    <th>'.$auditivaM.'</th>
                    <th>'.$visualM.'</th>
                    <th>'.$intelectualM.'</th>
                    <th>'.$mentalM.'</th>
                    <th>'.$mayaHablanteM.'</th>
                </tr>
                <tr>
                    <th>Mujeres</th>
                    <th>'.$fisicaF.'</th>
                    <th>'.$sensorialF.'</th>
                    <th>'.$auditivaF.'</th>
                    <th>'.$visualF.'</th>
                    <th>'.$intelectualF.'</th>
                    <th>'.$mentalF.'</th>
                    <th>'.$mayaHablanteF.'</th>
                </tr>
            </table>';

            // TABLA 3
            echo '<br>
            <table id="customers">
                <tr>
                    <th>Total Hombres</th>
                    <th>'.$contadorMasculinos.'</th>
                </tr>
                <tr>
                    <th>Total Mujeres</th>
                    <th>'.$contadorFemeninas.'</th>
                </tr>
            </table>';
        }
    }
    ?>

    
    
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