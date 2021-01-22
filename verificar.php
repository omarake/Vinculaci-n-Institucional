<?php 
include ("Conexion.php");
try {

   if(isset($_POST["login"]))  
      {  
           if(empty($_POST["usuario"]) || empty($_POST["password"]))       
           {  
               $errMSG = 'Todos los campos son requeridos';  
               print "<script>window.location='login.php';</script>";				
           }  
           else  
           {  
               $nombre=htmlentities(addslashes($_POST['usuario']));
               $clave=htmlentities(addslashes($_POST['password']));

               //consulta SQL - Buscamos el usuario
               $id_user=0;
               $sql = "SELECT * FROM users WHERE correo_user = :nombre";
               $resultado=$DB_con->prepare($sql);
               $resultado->execute(array(":nombre"=>$nombre));

                  // Verificamos el Password
                  while($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
                     
                     if(password_verify($clave, $registro['password_user'])) {
                        $id_user = $registro['id_user'];
                     }else{
                        print "<script>window.location='login.php';</script>";				
                     }
                  }
               // Redireccionamiento
               if($id_user==0){
                  print "<script>window.location='login.php';</script>";				
               }elseif($id_user <> 0){
                  session_start();
                  $_SESSION["id_user"]=$id_user;
                  print "<script>window.location='index.php';</script>";				
               }
            } 
      } else {
         print "<script>window.location='login.php';</script>";				
      }

 //cierro la conexion
 $conexion = null;
} catch(Exception $e) {
   die($e->getMessage());
echo "Error!, Por favor contacte a soporte";
}
