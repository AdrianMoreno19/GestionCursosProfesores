<?php
include 'scriptsEnlaces/conexion.php';
include 'scriptsEnlaces/sesionStar.php';
include 'pdf.php';

function mandaMails($user, $pdfContent)
{
    spl_autoload_register(function ($clase) {
        $fullpath = "/var/www/html/phpmainler/PHPMailer2/src/" . $clase . ".php";
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
        $mail->addAddress("$user@adrian.es", 'Receptor');
        echo "<br><br>";
        $mail->Subject = 'Pdf';
        $mail->Body = "PrubaMandaCorreo";
        $mail->addStringAttachment($pdfContent, "$user.pdf", 'base64', 'application/pdf');
        $mail->send();
    } catch (Exception $e) {
        echo 'El mensaje no pudo ser enviado.';
        echo 'Error de correo: ' . $mail->ErrorInfo;
    }
}

try {
    $boton = $_POST['boton'];
    $contador = 0;

    if ($boton != "Enviar") {
        $stmt = $enlace->prepare("select distinct cursos.codigo, cursos.nombre, cursos.plazoinscripcion, solicitudes.admitido from cursos inner join solicitudes on
            cursos.codigo=solicitudes.codigocurso where cursos.plazoinscripcion < Current_Date and solicitudes.admitido = 0");
        $stmt->execute();
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>VerListado</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1>Lista Admitidos Cursos</h1>";
        echo "<button><a href='index.php'>Volver</a></button>";
        echo "<form action='?' method='post'>";
        echo "<table>";
        echo "<tr><th>Codigo</th><th>nombre</th><th>plazoinscripcion</th><th>Admitidos</th><th>Enviar</th></tr>";
        while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "<tr>";
            foreach ($fila as $datos) {
                echo "<td>$datos</td>";
            }
            echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='submit' name='boton' value='Enviar'>";
        echo "</form>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        $cursos = $_POST['cursos'] ?? [];

        //Hacemos el codigo aqui para que me organice automaticamente la baremacion y me acepte a los profesores
        //en el curso dependiendo de los puntos que tenga, tengo que hacer consulta que me recoja todos los datos de solicitudes meintras que el codigo del
        //curso sea igual al codigo del curso

        //Control para no admitir mas de 1 curso a la vez
        if (count($cursos) != 1) {
            echo "<br>";
            echo "<p style='color: red'>No puedes admitir mas de 1 curso a la vez</p>";
        } else {
            $stPlaza = $enlace->prepare("select numeroplazas from cursos where codigo = (?)");
            $stPlaza->bindParam(1, $cursos[0], PDO::PARAM_INT);
            $stPlaza->execute();

            $limitePlazas = (int)$stPlaza->fetchColumn(); //uso fetch_column para poder recoger los valores directamente por que un objeto casteado siempre devuelve 1

            $stmt2 = $enlace->prepare("select cursos.codigo, cursos.numeroplazas, solicitantes.dni, solicitantes.puntos, solicitudes.admitido from cursos
                    inner join solicitudes on cursos.codigo=solicitudes.codigocurso inner join solicitantes on solicitantes.dni=solicitudes.dni where cursos.codigo = (?)
                        group by cursos.codigo, solicitantes.dni order by solicitantes.puntos desc limit $limitePlazas");
            $stmt2->bindParam(1, $cursos[0], PDO::PARAM_INT);
            $stmt2->execute();
            while ($fila2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                //Aqui tengo que hacer que se me ordene y se me actualicen los puestos a admitido
                //dependiendo de las plazas que hay, si hay 25 plazas, tendre que hacer 25 admitidos
                if ($fila2[4] == 0) {
                    $smt = $enlace->prepare("update solicitudes set admitido = admitido+1 where dni = (?) and codigocurso = (?)");
                    $smt->bindParam(1, $fila2[2], PDO::PARAM_STR);
                    $smt->bindParam(2, $fila2[0], PDO::PARAM_INT);
                    $smt->execute();
                    $smt2 = $enlace->prepare("update cursos set numeroplazas=numeroplazas-1 where codigo = (?)");
                    $smt2->bindParam(1, $fila2[0], PDO::PARAM_STR);
                    $smt2->execute();
                    mandaMails($fila2[2], $pdfContent);
                    // Ruta donde deseas guardar el archivo PDF en el servidor
                    $rutaArchivo = './guardaPDF/' . $fila2[2] . '.pdf';
                    // Generar el PDF en un archivo en el servidor (sin mostrarlo al navegador)
                    $pdf->Output('F', $rutaArchivo); // El 'F' es para guardar el archivo en el servidor
                }
            }
        }

        //$stmt3 = $enlace->prepare("select * from solicitudes where codigocurso = (?)");
        //$stmt3->bindParam(1, $cursos[0], PDO::PARAM_INT);
        $stmt3 = $enlace->prepare("select * from solicitudes where admitido = 1");
        $stmt3->execute();
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Ver listado Admitidos</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1>Lista Admitidos Cursos</h1>";
        echo "<button><a href='verListadoAdmitidos.php'>Volver Eleccion</a></button>";
        echo "<table>";
        echo "<tr><th>DNI</th><th>Codigo</th><th>fechaSolicitud</th><th>Admitido</th></tr>";
        while ($fila3 = $stmt3->fetch(PDO::FETCH_NUM)) {
            echo "<tr>";
            foreach ($fila3 as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
