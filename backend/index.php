<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <?php require 'form.php'; ?>
    <?php
        require 'db.php';
        require 'form.php';
        $result = $db->query("SELECT * FROM usuario");

        if ($result->num_rows > 0) {
        echo "<div class='topangas'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='topanga'>";
                echo "ID: " . $row["id_usuario"] . "<br>";
                echo "Name: " . $row["nome_usuario"] . "<br>";
                echo "Email: " . $row["email_usuario"] . "<br>";
                echo "Telephone: " . $row["telefone_usuario"] . "<br>";
                echo "Passwd: " . $row["senha_usuario"] . "<br>";
                echo "<a href='update.php?id=" . $row["id_usuario"] . "'>Update</a>";
                echo "<a href='delete.php?id=" . $row["id_usuario"] . "'>Delete</a>";
                echo "<br>";
                echo "</div>";
            }
        } else {
            echo "No results found.";
        }
        echo '</div>';
    ?>
    
</body>

</html>