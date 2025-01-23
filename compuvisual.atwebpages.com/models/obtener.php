<?php
include 'conexion.php';
$con = new Conexion();
$conn = $con->conectar();
$buscar = "";
if (isset($_POST["cedula"])) {
    $buscar = $_POST["cedula"];
}
$respuesta = $conn->query("SELECT e.estcedula as cedula, e.estnombre as nombre,e.estapellido as apellido,e.esttelefono as telefono,e.estdireccion as direccion FROM estudiantes e where estcedula like '".$buscar."%'");
$resultado = array();

if ($respuesta->num_rows > 0) {
    while ($fila = $respuesta->fetch_assoc()) {
        array_push($resultado, $fila);
    }
} else {
    $resultado = "No hay estudiantes";
}

echo json_encode($resultado);
