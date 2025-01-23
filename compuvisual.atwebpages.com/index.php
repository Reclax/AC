<?php
require_once "controllers/controller.php";
require_once "models/model.php";


session_start();

if (!isset($_SESSION['logueado'])) {
    $_SESSION['logueado'] = false;
}
if(!isset($_SESSION["action"])){
    $_SESSION['action'] = "inicio";
}
$contr = new mvcController();
if(isset($_GET['action'])&&$_GET['action']=="reporte"){
    $contr->enlacesPaginasController();
}else{
    $contr->template();
}
