<?php 

$automovil=(object)["marca"=>"toyota","modelo"=>"RAV","color"=>"negro"];

function mostrar($auto){
    echo("El auto: ".$auto->marca.", de modelo ".$auto->modelo.", y de color ".$auto->color);
}

mostrar($automovil);
?>