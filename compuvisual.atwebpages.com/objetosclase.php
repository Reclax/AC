<?php 
class Automovil{

    public $marca;
    public $modelo;
    public $color;

    function mostrar(){
        echo("El auto: ".$this->marca.", de modelo ".$this->modelo.", y de color ".$this->color);
    }
}

$carro =new Automovil();
$carro->marca="Toyota";
$carro->modelo="RAV";
$carro->color="rojo";
$carro->mostrar();
?>xx