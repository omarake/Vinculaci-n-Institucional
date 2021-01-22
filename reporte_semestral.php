<?php
include("mantener_session.php");
include("Conexion.php");

if (isset($_GET['fecha'])) { //BUSCAR CONVENIOS
    $infoConvenios = $DB_con->prepare("SELECT dependencias.*, convenios.* FROM convenios INNER JOIN dependencias ON convenios.dependencia_convenio = dependencias.id_dependencia");
    $infoConvenios->execute();
 
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
            <h1>Reporte Semestral
                <br>
                <small>Del <?php 
                $fecha = date_create($_GET['fecha']);
date_add($fecha, date_interval_create_from_date_string("-6 months"));
echo date_format($fecha,"d-m-Y"). ' al ' . $_GET['fecha']; ?></small>
            </h1>
        </div>
    </div>

    <br>
    <br>

    <table id="customers">
        <tr>
            <th>Convenio</th>
            <th>Depedencia</th>
            <th>Fecha</th>
            <th>Status</th>
            <th>Usos</th>
        </tr>


        <?php
        // MOSTAR LISTA

        while ($rowLista = $infoConvenios->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td> <?php echo $rowLista->nombre_convenio; ?> </td>
                <td> <?php echo $rowLista->nombre_indepedencia; ?> </td>
                <td> <?php echo $rowLista->fechaInicio_convenio; ?> </td>
                <td>Activo</td>
                <td>5</td>
            </tr>
        <?php }  ?>
    </table>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/bower_components/jquery/dist/jquery.min.js"><\/script>')
    </script>
    <script src="assets/js/main.js"></script>
</body>

</html>