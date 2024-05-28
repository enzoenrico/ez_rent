<?php
require('C:\xampp\htdocs\ez_rent\back\api\User.php');
$_SESSION['url'] = 'C:\xampp\htdocs\ez_rent';
require_once($_SESSION['url'] . '\autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['inputEmail'] != null && $_POST['inputPassword'] != null) {
        $userEmail = $_POST['inputEmail'];
        $pass = md5($_POST['inputPassword']);
        $id = 11;

        $action = new UserMethods();
        $user = $action->get_user($pass, $userEmail);

        if ($user instanceof User) {
            $_SESSION['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'telephone' => $user->telephone,
                'senha' => $user->get_pass()
            ];
            $cart = new AluguelMethods();
            $cart->checkCarrinho($_SESSION['user']['id']);
            $_SESSION['logado'] = true;
            header("Location: /ez_rent/index.php");
        } else {
            echo '<div id="toast_search" class="toast" style="text-align: center; background-color: red !important;">';
            echo '<strong> Campos inválidos! Tente novamente</strong>';
            echo "</div>";
        }
    } else {
        echo '<div id="toast_search" class="toast" style="text-align: center; background-color: red !important;">';
        echo '<strong> Campos inválidos! Tente novamente</strong>';
        echo "</div>";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="../cadastro/cadastro-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
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
                        <label for="inputName" style="color: white;">Email</label>
                        <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Digite seu email">
                    </div>
                    <div class="form-group espaco ">
                        <label for="inputPassword4" style="color: white;">Senha</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Digite sua senha">
                    </div>
                </div>
                <div class="row">
                </div><br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Entrar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Entrar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Entrar</button>
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