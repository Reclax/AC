<?php
require_once 'Database.php';

class Survey {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function saveSurvey($userId, $pregunta1, $pregunta2) {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO encuestas (usuario_id, pregunta1_respuesta, pregunta2_respuesta) VALUES ($userId, '$pregunta1', '$pregunta2')";
        $result = $conn->query($sql);
        $this->db->closeConnection();
        return $result;
    }

    public function hasUserCompletedSurvey($userId) {
        $conn = $this->db->getConnection();
        $sql = "SELECT COUNT(*) as total FROM encuestas WHERE usuario_id = $userId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $this->db->closeConnection();
        return $row['total'] > 0;
    }

    public function getReport() {
        $conn = $this->db->getConnection();
        $reporte1 = [];
        $reporte2 = [];

        $sql = "SELECT pregunta1_respuesta, COUNT(*) as total FROM encuestas GROUP BY pregunta1_respuesta";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $reporte1[$row['pregunta1_respuesta']] = $row['total'];
        }

        $sql = "SELECT pregunta2_respuesta, COUNT(*) as total FROM encuestas GROUP BY pregunta2_respuesta";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $reporte2[$row['pregunta2_respuesta']] = $row['total'];
        }

        $this->db->closeConnection();
        return ['pregunta1' => $reporte1, 'pregunta2' => $reporte2];
    }
}
?>

