<?php
include_once("conexion.php");

session_start();

$res= $conn->query("select usuario, clave from usuarios where usuario= \"".$_POST["usuario"]."\" and clave = \"".$_POST["clave"]."\"");
$usuarios=$res->fetch_assoc();
print_r( $usuarios );

if($usuarios == null){
header("Location: index.php?error");
}

if($usuarios["usuario"]== $_POST['usuario']&&$usuarios['clave']==$_POST['clave']){
    $_SESSION['activo']=true;
    header('Location: home.php');
}


?>