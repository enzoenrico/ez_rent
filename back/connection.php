<?php

    $hostname = "localhost";
    $user = "ezrent_adm";
    $database = "teste";
    $password = "grupo3";

    $conn = new mysqli($hostname, $user, $password, $database);
    if ($conn->connect_errno) {
        echo "Falha ao conectar-se... (" . $conn->connect_errno . ")";
    } else {
        echo "Você se conectou ao banco.";
    }
?>