<?php
$_SESSION['url'] = 'C:\xampp\htdocs\ez_rent';
require_once($_SESSION['url'] . '\autoload.php');

$actions = new ItemMethods();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valueString = $_POST['inputValue'];
    for ($i = 0; $i < strlen($valueString); $i++) {
        if ($valueString[$i] === ',') {
            $hasComma = true;
            break;
        } else {
            $hasComma = false;
        }
    }
    if ($hasComma) {
        echo '<div class="alert alert-warning alert-dismissible fade show" style="background-color: red; color: black;" role="alert">
    Escreva o valor utilizando ponto (00.00)
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } else {
        $value = floatval($_POST['inputValue']);
        if ($_POST['inputName'] != null && $_POST['inputValue'] != null && $_POST['inputDesc'] != null && $_POST['selectGroup'] != null && $_POST['data']) {
            $name = $_POST['inputName'];
            $group = $_POST['selectGroup'];
            $description = $_POST['inputDesc'];
            $dataFinal = new DateTime($_POST['data']);
            $newItem = new Item($name, $value, 1, $group, $description, $_SESSION['user']['id']);
            if ($actions->add_item($newItem, $dataFinal)) {
                echo '<div class="alert alert-sucess alert-dismissible fade show" color: black;" role="alert">
                    Item adicionado com sucesso! Clique em itens cadastrados para ver.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                header("Location: /ez_rent/front/usuario/perfil/perfil.php");
            }
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" style="background-color: red; color: black;" role="alert">
        Campos inválidos! Revise seus dados!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
    }
}

?>


<html>
<link rel="stylesheet" href="./cadastro_item-style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<title>Add item</title>

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
                        <label for="inputName" style="color: white;">Nome do item</label>
                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Digite o nome do item">
                    </div>
                    <div class="form-group espaco ">
                        <label for="inputEmail4" style="color: white;">Valor para locar</label>
                        <input type="text" class="form-control" id="inputValue" name="inputValue" placeholder="Digite o valor do aluguel" pattern="^[0-9]+(?:\.[0-9]+)?$">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group espaco">
                        <label for="selectGroup" style="color: white;">Categoria</label>
                        <select class="form-select" aria-label="Default select example" name="selectGroup">
                            <option value="1">Tecnologia</option>
                            <option value="2">Roupa</option>
                            <option value="3">Utensílio</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group espaco ">
                        <label for="inputPassword4" style="color: white;">Descrição</label>
                        <input type="text" class="form-control" id="inputDesc" name="inputDesc" placeholder="Digite a descrição do item">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dataHoraInput" style="color: white;" class="form-label">Data limite do aluguel</label>
                    <input type="datetime-local" class="form-control" id="dataHoraInput" name="data">
                    <div id="error-msg" style="color: red;"></div>
                </div>
                <br>
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
                                Você deseja salvar este item?
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.getElementById('dataHoraInput').addEventListener('change', function() {
            var selectedDateTime = new Date(this.value);
            var currentDateTime = new Date();

            if (selectedDateTime < currentDateTime) {
                document.getElementById('error-msg').innerText = 'Por favor, selecione uma data futura.';
                this.value = '';
            } else {
                document.getElementById('error-msg').innerText = '';
            }
        });
    </script>
</body>

</html>