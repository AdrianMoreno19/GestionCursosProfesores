<?php
    try {
        $enlace = new PDO ('mysql:host=127.0.0.1; dbname=cursoscp', "root", "root");
        $enlace->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (mysqli_connect_error()) {
            echo "No se ha podido conectar a la base de datos";
            die();
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>