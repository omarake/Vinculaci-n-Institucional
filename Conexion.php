<?php

$Localhost = 'localhost';
$Usuario_BD = 'root';
$Password_BD = '';
$Nombre_BD = 'vinculacion';

try{
  $DB_con = new PDO("mysql:host={$Localhost};dbname={$Nombre_BD};",$Usuario_BD,$Password_BD);
  $DB_con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
  echo $e->getMessage();
}