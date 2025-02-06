<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    function pintaValores($tituloInput, $nombreInput, $placeHolder){
        echo "$tituloInput: <input type='text' name=$nombreInput placeholder=$placeHolder>";
        echo "<br><br>";
    }

    function validaVacios($variable, $tituloInput, $nombreInput, &$contadorParam, $placeHolder){
        if(!empty($variable)){
            echo "$tituloInput: <input type='text' name='$nombreInput' value='$variable'>";
            echo "<br><br>";
            echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
            echo "<br><br>";
            $contadorParam++;
        }else{
            echo "$tituloInput: <input type='text' name='$nombreInput' placeholder=$placeHolder><small style='color: red'>Este campo no puede estar vacio</small>";
            echo "<br><br>";
        }
    }

    function pintaFechas($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='date' name=$nombreInput>";
        echo "<br><br>";
    }

    function validaFechas($variable, $tituloInput, $nombreInput, &$contadorParam){
        if(!empty($variable)){
            echo "$tituloInput: <input type='date' name='$nombreInput' value='$variable'>";
            echo "<br><br>";
            echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
            echo "<br><br>";
            $contadorParam++;
        }else{
            echo "$tituloInput: <input type='date' name='$nombreInput'><small style='color: red'>Este campo no puede estar vacio</small>";
            echo "<br><br>";
        }
    }

    $boton = $_POST['boton'];
    $contador = 0;
    try {
        if ($boton != "Enviar") {
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Registrar nuevo usuario</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<button><a href='index.php'>Volver a pagina principal</a></button>";
            echo "<h1>Registrar nuevo usuario</h1>";
                echo "<form action='?' method='post'>";
                pintaValores("DNI", "dni", "50580069X");
                echo "<br>";
                pintaValores("Apellidos", "apellidos", "Moreno_Gomez");
                echo "<br>";
                pintaValores("Nombre", "nombre", "Adrian");
                echo "<br>";
                pintaValores("Telefono", "telefono", "644875980");
                echo "<br>";
                pintaValores("Correo", "correo", "adrianmorenogomez.amg@gmail.com");
                echo "<br>";
                pintaValores("Codigo Centro", "codigoCentro", "CTXXX");
                echo "<br>";
                pintaValores("Coordinador TC", "coordinadorTC", "0_o_1");
                echo "<br>";
                pintaValores("Grupo TC", "grupoTC", "0_o_1");
                echo "<br>";
                pintaValores("Nombre Grupo", "nombreGrupo", "GX");
                echo "<br>";
                pintaValores("Pbilin", "pbilin", "0_o_1");
                echo "<br>";
                pintaValores("Cargo", "cargo", "0_o_1");
                echo "<br>";
                pintaValores("Nombre Cargo", "nombreCargo", "tu_Cargo");
                echo "<br>";
                pintaValores("Situacion", "situacion", "activo_o_inactivo");
                echo "<br>";
                pintaFechas("Fecha Nacimiento", "fechaNacimiento");
                echo "<br>";
                pintaValores("Especialidad", "especialidad", "Matemáticas");
                echo "<br>";
                pintaValores("Password", "password", "12345");
                echo "<br>";
                echo "<br>";
                echo "<input type='submit' name='boton' value='Enviar'>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {

            $dni = $_POST['dni'];
            $apellidos = $_POST['apellidos'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $codigoCentro = $_POST['codigoCentro'];
            $coordinadorTC = $_POST['coordinadorTC'];
            $grupoTC = $_POST['grupoTC'];
            $nombreGrupo = $_POST['nombreGrupo'];
            $pbilin = $_POST['pbilin'];
            $cargo = $_POST['cargo'];
            $nombreCargo = $_POST['nombreCargo'];
            $situacion = $_POST['situacion'];
            $fechaNacimiento = $_POST['fechaNacimiento'];
            $especialidad = $_POST['especialidad'];
            $password = $_POST['password'];

            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Registrar nuevo usuario</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<button><a href='index.php'>Volver a pagina principal</a></button>";
            echo "<h1>Registrar nuevo usuario</h1>";
                echo "<form action='?' method='post'>";
                validaVacios($dni, "DNI", "dni", $contador, "50580069X");
                echo "<br>";
                validaVacios($apellidos, "Apellidos", "apellidos", $contador, "Moreno_Gomez");
                echo "<br>";
                validaVacios($nombre, "Nombre", "nombre", $contador, "Adrian");
                echo "<br>";
                validaVacios($telefono, "Telefono", "telefono", $contador, "644875980");
                echo "<br>";
                validaVacios($correo, "Correo", "correo", $contador, "adrianmorenogomez.amg@gmail.com");
                echo "<br>";
                validaVacios($codigoCentro, "Codigo Centro", "codigoCentro", $contador, "CTXXX");
                echo "<br>";
                validaVacios($coordinadorTC, "Coordinador TC", "coordinadorTC", $contador, "0_o_1");
                echo "<br>";
                validaVacios($grupoTC, "Grupo TC", "grupoTC", $contador, "0_o_1");
                echo "<br>";
                validaVacios($nombreGrupo, "Nombre Grupo", "nombreGrupo", $contador, "GX");
                echo "<br>";
                validaVacios($pbilin, "Pbilin", "pbilin", $contador, "0_o_1");
                echo "<br>";
                validaVacios($cargo, "Cargo", "cargo", $contador, "0_o_1");
                echo "<br>";
                validaVacios($nombreCargo, "Nombre Cargo", "nombreCargo", $contador, "tu_Cargo");
                echo "<br>";
                validaVacios($situacion, "Situacion", "situacion", $contador, "activo_o_inactivo");
                echo "<br>";
                validaFechas($fechaNacimiento, "Fecha Nacimiento", "fechaNacimiento", $contador, "fechaNacimiento");
                echo "<br>";
                validaVacios($especialidad, "Especialidad", "especialidad", $contador, "Matemáticas");
                echo "<br>";
                validaVacios($password, "Password", "password", $contador, "12345");
                echo "<br>";
                echo "<input type='submit' name='boton' value='Enviar'>";
                echo "</form>";
                if ($contador==16) {
                    $stmt = $enlace->prepare("insert into solicitantes(dni,apellidos,nombre,telefono,correo,codigocentro,coordinadortc,grupotc,nombregrupo,pbilin,cargo,nombrecargo,situacion,
                                                fechanac,especialidad,password) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $stmt->bindParam(1, $dni, PDO::PARAM_STR);
                    $stmt->bindParam(2, $apellidos, PDO::PARAM_STR);
                    $stmt->bindParam(3, $nombre, PDO::PARAM_STR);
                    $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                    $stmt->bindParam(5, $correo, PDO::PARAM_STR);
                    $stmt->bindParam(6, $codigoCentro, PDO::PARAM_STR);
                    $stmt->bindParam(7, $coordinadorTC, PDO::PARAM_INT);
                    $stmt->bindParam(8, $grupoTC, PDO::PARAM_INT);
                    $stmt->bindParam(9, $nombreGrupo, PDO::PARAM_STR);
                    $stmt->bindParam(10, $pbilin, PDO::PARAM_INT);
                    $stmt->bindParam(11, $cargo, PDO::PARAM_INT);
                    $stmt->bindParam(12, $nombreCargo, PDO::PARAM_STR);
                    $stmt->bindParam(13, $situacion, PDO::PARAM_STR);
                    $stmt->bindParam(14, $fechaNacimiento, PDO::PARAM_STR);
                    $stmt->bindParam(15, $especialidad, PDO::PARAM_STR);
                    $stmt->bindParam(16, $password, PDO::PARAM_STR);
                    if ($stmt->execute()) {
                        echo "<p style='color: green'>Te has registrado Correctamente</p>";
                    } else {
                        echo "<p style='color: red'>Error: No se ha podido insertar el curso</p>";
                    }
                }
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red'>Error al insertar, usuario existente</p>";
    }
?>