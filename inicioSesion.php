<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    try {
        $botonEnviar = $_POST['enviar'];
        $contador = 0;

        $consulta = "select * from solicitantes";
        $resultado = $enlace->query($consulta);
        
        function pintaValores($tituloInput, $nombreInput){
            echo "$tituloInput: <input type='text' name='$nombreInput'>";
            echo "<br><br>";
        }

        function validaVacios($tituloInput, $variable, $nombreInput, &$contadorParam){
            if(!empty($variable)){
                echo "$tituloInput: <input type='text' name='$nombreInput' value='$variable'>";
                echo "<br>";
                echo "<small style='color: green'>Datos Correctos</small>";
                echo "<br>";
                $contadorParam++;
            }else{
                echo "$tituloInput: <input type='text' name='$nombreInput'>";
                echo "<br>";
                echo "<small style='color: red'>Datos Incorrectos</small>";
                echo "<br>";
            }
        }

        if ($botonEnviar != "Enviar") {

            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Inicio de Sesion</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<button><a href='register.php'>Registrate si no tienes cuenta</a></button>";
            echo "<h1>Inicio de Sesion</h1>";
                echo "<form action='?' method='post'>";
                pintaValores("Usuario", "user");
                echo "<br>";
                pintaValores("Password", "pass");
                echo "<br>";
                echo "<input type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";

        } else {

            $user = $_POST['user'];
            $pass = $_POST['pass'];

            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Inicio de Sesion</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<button><a href='register.php'>Registrate si no tienes cuenta</a></button>";
            echo "<h1>Inicio de Sesion</h1>";
                echo "<form action='?' method='post'>";
                validaVacios("Usuario", $user, "user", $contador);
                echo "<br>";
                validaVacios("Password", $pass, "pass", $contador);
                echo "<br>";
                echo "<input type='submit' name='enviar' value='Enviar'>";
                if ($contador == 2 && $resultado->rowCount() > 0) {
                    $encontrado = false;
                    while ($fila = $resultado->fetch(PDO::FETCH_BOTH)) {
                        $dni=$fila[0];
                        $pass2 = $fila[16];
                        $esAdminis = $fila[17];
                        if ($user==$dni && $pass==$pass2) {
                            $encontrado = true;
                            $_SESSION['inicioSesion']=$user;
                            $_SESSION['esAdmin']=$esAdminis;
                            header("Location: index.php");
                            exit();
                        }
                    }
                    if (!$encontrado) {
                        echo "<p style='color: red'>Usuario o contraseña incorrectos</p>";
                    }
                }
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>