<?php 
include 'conexion.php';
$con=new Conexion();
$conn=$con->conectar();
$sql='delete from estudiantes where estcedula=\''.$_POST['cedula'].'\'';
if($conn->query($sql)===true){
    echo json_encode(value: ["success"=>true]);
}else{
    echo json_encode(value: ["success"=>false]);
}

?>