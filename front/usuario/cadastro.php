<?php
require('C:\xampp\htdocs\ez_rent\back\api\User.php');

if (isset($_POST['inputName'], $_POST['inputEmail'], $_POST['inputTelefone'], $_POST['inputPassword'])) {
    $name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $telefone = $_POST['inputTelefone'];
    $passwrd = $_POST['inputPassword'];
    $id = 10;
    newUser($id, $name, $email, $telefone, $passwrd);
}


function newUser($id, $name, $email, $telefone, $passwrd)
{
    $newUser = new User($id, $name, $email, $telefone);
    $newUser->set_pass($passwrd);
    UserMethods::set_user($newUser);
    echo "Usuário criado com sucesso!";
}

?>

<html>

<head>
    <link rel="stylesheet" href="./cadastro-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro</title>
</head>

<body>
    <div id="sing-in-body">
        <h1><b>EzRent</b></h1>
        <div class="sign-in-box">
            <div class="roll-back">
                <a href="/ez_rent/index.php">Voltar</a>
            </div>
            <form method="post" style="padding: 20px;">
                <div class="row">
                    <div class="form-group espaco">
                        <label for="inputName" style="color: white;">Nome</label>
                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Digite seu nome">
                    </div>
                    <div class="form-group espaco ">
                        <label for="inputEmail4" style="color: white;">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Digite seu email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group espaco">
                        <label for="inputName" style="color: white;" mask="">Telefone</label>
                        <input type="text" class="form-control" id="inputTelefone" name="inputTelefone" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}" placeholder="Digite seu telefone">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group espaco ">
                        <label for="inputPassword4" style="color: white;">Senha</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Digite sua senha">
                    </div>
                </div><br>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('inputTelefone').addEventListener('input', function(e) {
            let inputValue = e.target.value;

            // Eliminar caracteres que no sean dígitos
            inputValue = inputValue.replace(/\D/g, '');

            // Formatear el número de teléfono según sea necesario
            if (inputValue.length >= 2 && inputValue.length < 5) {
                inputValue = '(' + inputValue.substring(0, 2) + ') ' + inputValue.substring(2);
            } else if (inputValue.length >= 5 && inputValue.length < 9) {
                inputValue = '(' + inputValue.substring(0, 2) + ') ' + inputValue.substring(2, 6) + '-' + inputValue.substring(6);
            } else if (inputValue.length >= 9) {
                inputValue = '(' + inputValue.substring(0, 2) + ') ' + inputValue.substring(2, 5) + '-' + inputValue.substring(5, 9) + '-' + inputValue.substring(9);
            }

            // Asignar el valor formateado de nuevo al campo de entrada
            e.target.value = inputValue;
        });
    </script>
</body>

</html>