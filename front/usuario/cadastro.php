<?php
require('C:\xampp\htdocs\ez_rent\back\api\User.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['inputName'] != null && $_POST['inputEmail'] != null && $_POST['inputTelefone'] != null && $_POST['inputPassword'] != null) {
        $name = $_POST['inputName'];
        $email = $_POST['inputEmail'];
        $telefone = $_POST['inputTelefone'];
        $passwrd = md5($_POST['inputPassword']);
        $id = 11;

        $newUser = new User($id, $name, $email, $telefone);
        $newUser->set_pass($passwrd);
        UserMethods::set_user($newUser);
    } else {
        echo '<div class="alert alert-danger" style="background-color: red; color: black;" role="alert">
    Campos inválidos! Revise seus dados!
  </div>';
    }
}


// function newUser($id, $name, $email, $telefone, $passwrd)
// {
// }

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
                        <input type="text" class="form-control" id="inputTelefone" name="inputTelefone" placeholder="Digite seu telefone">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group espaco ">
                        <label for="inputPassword4" style="color: white;">Senha</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Digite sua senha">
                    </div>
                </div><br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Salvar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Salvar cadastro</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Você deseja salvar seu cadastro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('inputTelefone').addEventListener('input', function(e) {
            let inputValue = e.target.value;

            inputValue = inputValue.replace(/\D/g, '');

            if (inputValue.length >= 2 && inputValue.length < 7) {
                inputValue = '(' + inputValue.substring(0, 2) + ') ' + inputValue.substring(2);
            } else if (inputValue.length >= 7 && inputValue.length < 11) {
                inputValue = '(' + inputValue.substring(0, 2) + ') ' + inputValue.substring(2, 6) + '-' + inputValue.substring(6);
            } else if (inputValue.length >= 11) {
                inputValue = '(' + inputValue.substring(0, 2) + ') ' + inputValue.substring(2, 7) + '-' + inputValue.substring(7, 14);
            }

            inputValue = inputValue.substring(0, 15);

            e.target.value = inputValue;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>