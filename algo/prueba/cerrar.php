<?php
session_start();
if (isset($_SESSION["activo"])){
$_SESSION["activo"]=false;
header("Location: index.php");
}
?>