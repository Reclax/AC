<?php
$clave=$_POST["clave"];
if($clave!="1234"){
echo("Clave Incorrecta");
}else{
    $factorial=1;
    for($i=1;$i<$_POST["n1"];$i++){
        $factorial=$factorial*($i+1);
    }
    echo("El Factorial de ".$_POST["n1"]." es ".$factorial);
}

?>