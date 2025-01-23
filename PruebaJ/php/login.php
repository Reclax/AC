<?php
require_once 'classes/User.php';

$data = json_decode(file_get_contents('php://input'), true);
$cedula = $data['cedula'];
$clave = $data['clave'];

$user = new User();
$result = $user->login($cedula, $clave);

echo json_encode($result);
?>
