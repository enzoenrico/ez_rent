<?php
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data and save it to the database
    $res = $db->query("INSERT INTO usuario (nome_usuario, email_usuario, id_usuario, telefone_usuario, senha_usuario) VALUES ('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . (string)rand(1, 100000) . "', '" . $_POST['phone'] . "', '" . $_POST['pass'] . "')");
    if ($res->num_rows > 0) {
        echo "Error: " . $res->error;
    } else {
        echo "New record created successfully";
    }
    // Redirect to a success page
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>New Entry Form</title>
</head>

<body>
    <h1>New Entry Form</h1>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Phone:</label>
        <input type="tel" name="phone" id="phone" required>

        <label for="password">Password:</label>
        <input type="password" name="pass" id="pass" required>

        <input type="submit" value="Submit">
    </form>
</body>

</html>