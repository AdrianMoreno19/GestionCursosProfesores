<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    function pintaValores($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='text' name=$nombreInput>";
        echo "<br><br>";
    }

    function validaVacios($variable, $tituloInput, $nombreInput, &$contadorParam){
        if(!empty($variable)){
            echo "$tituloInput: <input type='text' name='$nombreInput' value='$variable'>";
            echo "<br><br>";
            echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
            echo "<br><br>";
            $contadorParam++;
        }else{
            echo "$tituloInput: <input type='text' name='$nombreInput'><small style='color: red'>Este campo no puede estar vacio</small>";
            echo "<br><br>";
        }
    }

    function pintaFechas($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='date' name=$nombreInput>";
        echo "<br><br>";
    }

    function validaFechaText($tituloInput, $nombreInput, $variable, &$contadorParam){
        if (!empty($variable)) {
            echo "$tituloInput: <input type='date' name=$nombreInput value=$variable>";
            echo "<br><br>";
            echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
            echo "<br><br>";
            $contadorParam++;
        } else {
            echo "$tituloInput: <input type='date' name=$nombreInput><small style='color: red'>Este campo no puede estar vacio</small>";
            echo "<br><br>";
        }
    }

    $boton = $_POST['boton'];

    try {
        if ($boton != "Enviar") {
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Insertar</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Insertar Cursos</h1>";
            echo "<button><a href='index.php'>Volver</a></button>";
                echo "<form action='?' method='post'>";
                    pintaValores("Nombre", "nombre");
                    echo "<br>";
                    pintaValores("NumeroPlazas", "numeroPlazas");
                    echo "<br>";
                    pintaFechas("PlazoInscripcion", "plazoInscripcion");
                    echo "<br>";
                    echo "<input type='submit' name='boton' value='Enviar'>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            $nombreInsert = $_POST['nombre'];
            $numeroPlazasInsert = $_POST['numeroPlazas'];
            $plazoInscripInsert = $_POST['plazoInscripcion'];
            $sesion = $_SESSION['inicioSesion'];
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Insertar</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Insertar Cursos</h1>";
            echo "<button><a href='insertar.php'>Volver Eleccion</a></button>";
                echo "<form action='?' method='post'>";
                    validaVacios($nombreInsert, "Nombre", "nombre", $contador);
                    echo "<br>";
                    validaVacios($numeroPlazasInsert, "NumeroPlazas", "numeroPlazas", $contador);
                    echo "<br>";
                    validaFechaText("PlazoInscripcion", "plazoInscripcion", $plazoInscripInsert, $contador);
                    echo "<br>";
                    echo "<input type='submit' name='boton' value='Enviar'>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
            if ($contador == 3) {
                $stmt = $enlace->prepare("insert into cursos (nombre, numeroPlazas, plazoInscripcion) values (?,?,?)");
                $stmt->bindParam(1, $nombreInsert, PDO::PARAM_STR);
                $stmt->bindParam(2, $numeroPlazasInsert, PDO::PARAM_INT);
                $stmt->bindParam(3, $plazoInscripInsert, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    echo "<p style='color: green'>Has insertado un curso, $sesion</p>";
                } else {
                    echo "<p style='color: green'>No has podido insertar un curso, $sesion</p>";
                }
            } else {
                echo "<p style='color: red'>No estan todos los campos rellenos, $sesion</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>