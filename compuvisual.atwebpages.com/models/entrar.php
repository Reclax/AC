<?php
include 'conexion.php';
session_start();
$con = new Conexion();
$conn = $con->conectar();
$respuesta = $conn->query('SELECT * FROM usuarios e where user = \''.$_POST["usuario"].'\' and password = \''.$_POST["clave"].'\'');

if ($respuesta->num_rows > 0) {
   $_SESSION['logueado']=true;
   header("Location: ../index.php?action=".$_SESSION["action"]);
}else{
    header("Location: ../index.php?action=login&error");
} 


?>

