<?php 
include 'conexion.php';
$con=new Conexion();
$conn=$con->conectar();
$sql='insert into estudiantes (estcedula,estnombre,estapellido,estdireccion,esttelefono) values (\''.$_POST['cedula'].'\',\''.$_POST['nombre'].'\',\''.$_POST['apellido'].'\',\''.$_POST['direccion'].'\',\''.$_POST['telefono'].'\')';
if($conn->query($sql)===true){
    echo json_encode(value: ["success"=>true]);
}else{
    echo json_encode(value: ["success"=>false]);
}

?>