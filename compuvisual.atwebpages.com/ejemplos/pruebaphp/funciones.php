<?php
function promedio(){
    $cantidad=$_POST["cantidad"];
    $promedio=0;
    for($i=0;$i<$cantidad;$i++){
        $promedio=$promedio+$_POST["numero".$i];
    }
    $promedio=$promedio/$cantidad;
    return $promedio;
}

function invertir(){
    $cantidad=$_POST["cantidad"];
    $numero=$cantidad-1;
    for($i=0;$i<$cantidad;$i++){
        $array[$numero]=$_POST["numero".$i];
        $numero--;
    }
    return $array;
}


echo("El promedio es: ".promedio()."<br/>");

echo("El array Invertido es: <br/>");
$cantidad=$_POST["cantidad"];
$arrayinvertido=invertir();
for($i=0;$i<$cantidad;$i++){
    echo($arrayinvertido[$i]);
    echo("<br/>");
}

?>