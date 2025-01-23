<?php
class mvcController{
    public function template(){
        include("views/template.php");
    }
    public function enlacesPaginasController(){
        if(isset($_GET["action"])){
            $enlacesPaginaController=$_GET["action"];
        }else{
            $enlacesPaginaController="inicio.php";
        }
        $modelo=new EnlacesPaginas();
        $res=$modelo->EnlacesPaginasModel($enlacesPaginaController);
        include $res;
    }
}
?>