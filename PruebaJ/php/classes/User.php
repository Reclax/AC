<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($cedula, $nombre, $apellido, $clave) {
        $conn = $this->db->getConnection();
        $hashedPassword = password_hash($clave, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (cedula, nombre, apellido, clave) VALUES ('$cedula', '$nombre', '$apellido', '$hashedPassword')";
        $result = $conn->query($sql);
        $this->db->closeConnection();
        return $result;
    }

    public function login($cedula, $clave) {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM usuarios WHERE cedula = '$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($clave, $user['clave'])) {
                $this->db->closeConnection();
                return ['success' => true, 'userId' => $user['id'], 'isAdmin' => $user['es_admin'], 'nombre' => $user['nombre'], 'apellido' => $user['apellido']];
            }
        }
        $this->db->closeConnection();
        return ['success' => false];
    }
}
?>

