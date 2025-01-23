<?php
require_once 'classes/Survey.php';

$survey = new Survey();
$report = $survey->getReport();

echo json_encode($report);
?>
