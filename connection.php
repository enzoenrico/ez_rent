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

    $sql = "SELECT * FROM usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["id_usuario"];
            echo $row["nome_usuario"];
            echo $row["email_usuario"];
            echo "<br>";
        }
    }
?>