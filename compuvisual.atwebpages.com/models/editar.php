<?php 
include 'conexion.php';
$con=new Conexion();
$conn=$con->conectar();
$sql='update estudiantes set estnombre=\''.$_POST['nombre'].'\',estapellido=\''.$_POST['apellido'].'\',estdireccion=\''.$_POST['direccion'].'\',esttelefono= \''.$_POST['telefono'].'\' where estcedula=\''.$_GET['cedula'].'\'';
if($conn->query($sql)===true){
    echo json_encode(value: ["success"=>true]);
}else{
    echo json_encode(value: ["success"=>false]);
}

?>