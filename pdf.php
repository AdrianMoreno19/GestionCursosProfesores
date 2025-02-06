<?php
    require 'fpdf/fpdf.php';
    session_start();  // Asegúrate de iniciar la sesión si es que no lo has hecho
    $usuario = $_SESSION['inicioSesion'];

    // Crear objeto PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Agregar imagen
    $pdf->Image('./imagenes/imagenScarlatti.jpg', 10, 10, 30);  // Ajusta la ruta de la imagen

    // Título
    $pdf->SetFont("Arial", "B", 15);
    $pdf->Cell(100, 10, "Recepcion inscripcion, muchas gracias $usuario", 1, 1, "C");

    // Contenido
    $pdf->MultiCell(100, 5, "Tu inscripcion ha sido registrada correctamente", 0, "C", 0);

    // Generar el PDF como string (para enviarlo por correo)
    $pdfContent = $pdf->Output('', 'S'); // El '' es para no especificar el nombre, y 'S' lo devuelve como string
?>
