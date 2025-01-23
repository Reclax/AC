<?php
require_once 'fpdf/fpdf.php';
include 'Models/conexion.php';

// Crear instancia de la conexión
$conn = new conexion();
$con = $conn->conectar();


// Verificar si la conexión es válida
if (!$con) {
    die("Error en la conexión a la base de datos");
}

// Ejecutar la consulta
if (isset($_GET['ced_est'])) {
    $SqlSelect = 'Select * from estudiantes where ced_est=' . $_GET["ced_est"];

} else {
    $SqlSelect = "select * from estudiantes";
}
$result = $con->query($SqlSelect);

// Verificar si la consulta es válida
if (!$result) {
    die("Error en la consulta: " . $con->error);
}

if (isset($_GET['ced_est'])) {
    $sql = 'Select * from estudiantes where ced_est=' . $_GET["ced_est"];

}

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "B", 16);

// Título del documento
$pdf->Cell(0, 10, "CUARTO", 0, 1, "C");
$pdf->Ln(5);

// Encabezados de la tabla
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(30, 10, "Cedula", 1);
$pdf->Cell(30, 10, "Nombre", 1);
$pdf->Cell(30, 10, "Apellido", 1);
$pdf->Cell(30, 10, "Telefono", 1);
$pdf->Cell(30, 10, "Direccion", 1);

$pdf->Ln();

// Iterar sobre los resultados
$pdf->SetFont("Arial", "", 12);
while ($fila = $result->fetch_assoc()) {
    $cedula = $fila['ced_est'];
    $nombre = $fila['nom_est'];
    $apellido = $fila['ape_est'];
    $telefono = $fila['tel_est'];
    $direccion = $fila['dir_est'];

    $pdf->Cell(30, 10, $cedula, 1);
    $pdf->Cell(30, 10, $nombre, 1);
    $pdf->Cell(30, 10, $apellido, 1);
    $pdf->Cell(30, 10, $telefono, 1);
    $pdf->Cell(30, 10, $direccion, 1);

    $pdf->Ln();
}

// Cerrar la conexión
$con->close();

// Generar el PDF
$pdf->Output();
?>