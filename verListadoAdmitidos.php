<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    try {
        $boton = $_POST['boton'];
        
        if ($boton != "Enviar") {
            $stmt = $enlace->prepare("select codigo from cursos");
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
                    echo "<tr><th>Codigo</th><th>Enviar</th></tr>";
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
        
            $stmt2 = $enlace->prepare("select cursos.codigo, cursos.numeroplazas, solicitantes.dni, solicitantes.puntos, solicitudes.admitido from cursos
                inner join solicitudes on cursos.codigo=solicitudes.codigocurso inner join solicitantes on solicitantes.dni=solicitudes.dni where cursos.codigo = (?)
                    group by cursos.codigo, solicitantes.dni order by solicitantes.puntos desc");
            $stmt2->bindParam(1, $cursos[0], PDO::PARAM_INT);
            $stmt2->execute();
            while ($fila2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                //Aqui tengo que hacer que se me ordene y se me actualicen los puestos a admitido
                //dependiendo de las plazas que hay, si hay 25 plazas, tendre que hacer 25 admitidos
                if ($fila2[4]==0) {
                    $smt = $enlace->prepare("update solicitudes set admitido = admitido+1 where dni = (?) and codigocurso = (?)");
                    $smt->bindParam(1, $fila2[2], PDO::PARAM_STR);
                    $smt->bindParam(2, $fila2[0], PDO::PARAM_INT);
                    $smt->execute();
                    $smt2 = $enlace->prepare("update cursos set numeroplazas=numeroplazas-1 where codigo = (?)");
                    $smt2->bindParam(1, $fila2[0], PDO::PARAM_STR);
                    $smt2->execute();
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
        echo "Error: ".$e->getMessage();
    }
?>