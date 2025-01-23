<?php
require_once 'classes/Survey.php';

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$pregunta1 = $data['pregunta1'];
$pregunta2 = $data['pregunta2'];

$survey = new Survey();
if ($survey->hasUserCompletedSurvey($userId)) {
    echo json_encode(['success' => false, 'message' => 'Ya has completado la encuesta']);
} else {
    $result = $survey->saveSurvey($userId, $pregunta1, $pregunta2);
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al guardar la encuesta']);
    }
}
?>
