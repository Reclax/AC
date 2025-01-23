<?php
class EnlacesPaginas{
    public function EnlacesPaginasModel($enlacesModel){
    if($enlacesModel=="nosotros" ||$enlacesModel== "servicios"||$enlacesModel== "contactanos"|| $enlacesModel=="login"||$enlacesModel=="salir"){
        $module="views/".$enlacesModel.".php";
    }
    else if($enlacesModel=="reporte"){
            $module="Reportes/".$_GET["reporte"].".php";
    }
    else{
            $module="views/inicio.php";
    }
        return $module;
    }
}
?>