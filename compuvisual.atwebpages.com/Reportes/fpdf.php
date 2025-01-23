<?php
require_once 'Reportes/fpdf186/fpdf.php';
include 'models/conexion.php';

$conn = new conexion();
$con = $conn->conectar();

if (!$con) {
    die("Error en la conexión a la base de datos");
}

if (isset($_GET['cedula'])) {
    $SqlSelect = 'SELECT * FROM estudiantes WHERE estCedula=' . $_GET["cedula"];
} else {
    $SqlSelect = "SELECT * FROM estudiantes";
}
$result = $con->query($SqlSelect);

if (!$result) {
    die("Error en la consulta: " . $con->error);
}

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        $this->Image('Reportes/images/logo_uta.jpeg', 15, 6, 24);
        $this->Image('Reportes/images/logo_fisei.jpeg', 173, 6, 23);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(33, 37, 41);
        $this->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "UNIVERSIDAD TÉCNICA DE AMBATO"), 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, iconv("UTF-8", "ISO-8859-1", "FACULTAD DE INGENIERÍA EN SISTEMAS, ELECTRÓNICA E INDUSTRIAL"), 0, 1, 'C');
        $this->Cell(0, 6, iconv("UTF-8", "ISO-8859-1", "CARRERA DE SOFTWARE"), 0, 1, 'C');
        $this->Ln(10);
        $this->SetLineWidth(0.5);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "Página ") . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "Reporte de Estudiantes"), 0, 1, "C");
$pdf->Ln(5);

$pdf->SetLineWidth(0.5);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(10);

if (!isset($_GET['cedula'])) {
    $totalReportes = $result->num_rows;
    $pdf->SetFont("Arial", "I", 12);
    $pdf->Cell(0, 10, iconv("UTF-8","ISO-8859-1","Número total de reportes: " . $totalReportes), 0, 1, "C");
    $pdf->Ln(10);
} else {
    $pdf->Ln(10);
}

$pdf->SetFont("Arial", "B", 12);
$pdf->SetFillColor(220, 53, 69);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(35, 10, iconv("UTF-8", "ISO-8859-1", "Cédula"), 1, 0, 'C', true);
$pdf->Cell(40, 10, "Nombre", 1, 0, 'C', true);
$pdf->Cell(40, 10, "Apellido", 1, 0, 'C', true);
$pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Teléfono"), 1, 0, 'C', true);
$pdf->Cell(35, 10, iconv("UTF-8", "ISO-8859-1", "Dirección"), 1, 0, 'C', true);
$pdf->Ln();

$pdf->SetFont("Arial", "", 8);
$pdf->SetTextColor(33, 37, 41);
$pdf->SetFillColor(245, 245, 245);
$fill = false;



while ($fila = $result->fetch_assoc()) {
    $pdf->Cell(35, 10, $fila['estCedula'], 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", $fila['estNombre']), 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", $fila['estApellido']), 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, $fila['estTelefono'], 1, 0, 'C', $fill);
    $pdf->Cell(35, 10, iconv("UTF-8", "ISO-8859-1", $fila['estDireccion']), 1, 0, 'C', $fill);
    $pdf->Ln();
    $fill = !$fill;
}

$con->close();

$pdf->Output();
?>

