<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';
    include 'pdf.php';

    $usuario = $_SESSION['inicioSesion'];

    try {
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Gmail</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<button><a href='index.php'>Volver</a></button>";
        echo "<h1>Formulario Gmail</h1>";
            spl_autoload_register(function ($clase){
                $fullpath = "/var/www/html/phpmainler/PHPMailer2/src/".$clase.".php";
                if (file_exists($fullpath)) {
                    require_once($fullpath);
                } else {
                    echo "<p>La clase $fullpath no se encuentra </p>";
                }
            });
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'localhost';
            $mail->SMTPAuth = false;
            $mail->Username = 'Adrian';
            $mail->Password = 'adrian';
            $mail->Port = 587;
            try {
                $mail->setFrom('Adrian@adrian.es', 'Adrian');
                $mail->addAddress("$usuario@adrian.es", 'Receptor');
                echo "<br><br>";
                $mail->Subject = 'Pdf';
                $mail->Body = "PrubaMandaCorreo";
                $mail->addStringAttachment($pdfContent, 'documento.pdf', 'base64', 'application/pdf');
                $mail->send();
            } catch (Exception $e) {
                echo 'El mensaje no pudo ser enviado.';
                echo 'Error de correo: ' . $mail->ErrorInfo;
            }
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>