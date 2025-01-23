<?php
require_once 'classes/User.php';

$data = json_decode(file_get_contents('php://input'), true);
$cedula = $data['cedula'];
$nombre = $data['nombre'];
$apellido = $data['apellido'];
$clave = $data['clave'];

$user = new User();
$result = $user->register($cedula, $nombre, $apellido, $clave);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al registrar']);
}
?>
