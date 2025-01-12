<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    $boton = $_POST['boton'];
    $stmt = $enlace->prepare("select * from cursos");
    $stmt->execute();
    try {
        if ($boton != "Eliminar") {
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Delete</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Eliminar Cursos</h1>";
            echo "<button><a href='index.php'>Volver</a></button>";
                echo "<form action='?' method='post'>";
                    echo "<table>";
                        echo "<tr><th>Codigo</th><th>Nombre</th><th>Abierto</th><th>NumeroPlaza</th><th>PlazoInscripcion</th><th>Borrar</th></tr>";
                        while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
                            echo "<tr>";
                            foreach ($fila as $valores) {
                                echo "<td>$valores</td>";
                            }
                            echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
                            echo "</tr>";
                        }
                    echo "</tr>";
                    echo "</table>";
                    echo "<input type='submit' name='boton' value='Eliminar'>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            $stmt2 = $enlace->prepare("select * from cursos");
            $stmt2->execute();
            $codigoDelete = $_POST['codigo'];
            $sesion = $_SESSION['inicioSesion'];
            $cursos = $_POST['cursos'] ?? [];
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Delete</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Eliminar Cursos</h1>";
            echo "<button><a href='Borrar.php'>Volver a Eliminar Curso</a></button>";
            echo "<table>";
                echo "<tr><th>Codigo</th><th>Nombre</th><th>Abierto</th><th>NumeroPlaza</th><th>PlazoInscripcion</th></tr>";
                while ($fila2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                    echo "<tr>";
                    foreach ($fila2 as $valores2) {
                        echo "<td>$valores2</td>";
                    }
                    echo "</tr>";
                }
            echo "</tr>";
            echo "</table>";
            if (count($cursos) >= 1) {
                foreach ($cursos as $codigoCurso) {
                    $stmt3 = $enlace->prepare("delete from solicitudes where codigocurso = (?)");
                    $stmt3->bindParam(1, $codigoCurso, PDO::PARAM_INT);
                    if ($stmt3->execute()) {
                        $stmt4 = $enlace->prepare("delete from cursos where codigo = (?)");
                        $stmt4->bindParam(1, $codigoCurso, PDO::PARAM_INT);
                        $stmt4->execute();
                        echo "<p style='color: green'>Has eliminado el curso, $codigoCurso</p>";
                    } else {
                        echo "<p style='red: green'>No has eliminado el curso, $codigoCurso</p>";
                    }
                }
            } else {
                echo "<p style='color: red'>No has marcado ningun curso, $sesion</p>";
            }
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>