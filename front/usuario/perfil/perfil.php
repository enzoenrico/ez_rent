<?php
session_start();
$_SESSION['url'] = 'C:\xampp\htdocs\ez_rent';
require_once($_SESSION['url'] . '\autoload.php');

$userInfo = $_SESSION['user'];
$actions = new UserMethods();
$itemActions = new ItemMethods();

if ($itemActions->get_user_item($_SESSION['user']['id']) !== null) {
    $items = $itemActions->get_user_item($_SESSION['user']['id']);
} else {
    $items = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        logout();
    } else if (isset($_POST['update'])) {
        update_user($actions, $userInfo);
    } else if (isset($_POST['delete_user'])) {
        $actions->delete_user($userInfo['id']);
        session_destroy();
        header("Location: /ez_rent/index.php");
    } else if (isset($_POST['delete_item'])) {
        delete_item($_POST['delete_item']);
    } else if (isset($_POST['update_item'])) {
        update_item($_POST['update_item']);
    }
}

function logout()
{
    session_destroy();
    header("Location: /ez_rent/index.php");
    exit();
}

function delete_item($id)
{
    $delete = new ItemMethods();
    $delete->delete_item($id);
}

function update_user($actions, $userInfo)
{
    if ($_POST['inputName'] != null && $_POST['inputEmail'] != null && $_POST['inputTelefone'] != null && $_POST['inputPassword'] != null) {
        $name = $_POST['inputName'];
        $email = $_POST['inputEmail'];
        $telefone = $_POST['inputTelefone'];
        $passwrd = md5($_POST['inputPassword']);
        $id = 11;

        $editUser = new User($id, $name, $email, $telefone);
        $editUser->set_pass($passwrd);

        if ($actions->update_user($editUser, $userInfo['id'])) {
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['telephone'] = $telefone;

            header("Location: /ez_rent/front/usuario/perfil/perfil.php");
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" style="background-color: red; color: black;" role="alert">
    Campos inválidos! Revise seus dados!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

function update_item(Item $item)
{
    $update = new ItemMethods();
    $update->update_item($item, $item->get_id());
}
?>

<html>
<link rel="stylesheet" href="./perfil-style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<title>Perfil</title>

<body>
    <div class="container overflow-hidden text-center perfil-columns">
        <div class="row gy-5" style="gap: 20px;">

            <!-- CARD DE INFORMAÇÕES DO PERFIL - INÍCIO -->

            <div class="col-3 teste perfil-box">
                <div class="roll-back">
                    <div class="roll-back-btn btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        <a href="/ez_rent/index.php">Voltar</a>
                    </div>
                </div>
                <div class="perfil-box">
                    <h2 style="color: white;">Suas Informações:</h2>
                    <div class="col infos">
                        <?php
                        echo '<div class=" teste2">
                            <h5>Nome:</h5> 
                            <span>' . $userInfo['name'] . '</span> 
                        </div>
                
                            <div class=" teste2 "><h5>
                            Email:</h5> <span>' . $userInfo['email'] . '</span>                         
                            </div>
                            <div class=" teste2"><h5>
                            Telefone:</h5> <span>' . $userInfo['telephone'] . '</span>                         
                            </div>';
                        ?>
                    </div>
                    <div class="content">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editar" aria-expanded="false" aria-controls="collapseWidthExample">
                            Editar perfil
                        </button>
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deletar">
                            Deletar perfil
                        </button>
                        <form method="post">
                            <div class="modal fade" id="deletar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Deletar perfil</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Você deseja deletar seu perfil?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                            <button type="submit" name="delete_user" class="btn btn-primary">Deletar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#itens" aria-expanded="false" aria-controls="collapseWidthExample">
                            Itens cadastrados
                        </button>
                    </div>
                    <div style="margin-top: 10px;">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#logout">
                            Desconectar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Desconectar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Você deseja desconectar-se?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                        <form method="post">
                                            <button type="submit" name="logout" class="btn btn-primary">Desconectar-se</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FIMDO CARD DE INFORMAÇÕES -->

            <!-- CAMPO DE EDITAR DADOS - INÍCIO -->

            <div class="col teste collapse collapse-horizontal" id="editar">
                <form method="post" style="padding: 20px;">
                    <div class="row" style="height: auto;">
                        <div style="text-align: start;" class="form-group col-md-6 espaco">
                            <label for="inputName" style="color: white;">Nome</label>
                            <?php
                            echo '<input type="text" value="' . $userInfo['name'] . '" class="form-control" id="inputName" name="inputName" placeholder="Digite seu nome">';
                            ?>
                        </div>
                        <div style="text-align: start;" class="form-group col-md-6 espaco ">
                            <label for="inputEmail4" style="color: white;">Email</label>
                            <?php
                            echo '<input type="email" value="' . $userInfo['email'] . '" class="form-control" id="inputEmail" name="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">';

                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div style="text-align: start;" class="form-group col-md-6 espaco">
                            <label for="inputName" style="color: white;" mask="">Telefone</label>
                            <?php
                            echo '<input type="text" value="' . $userInfo['telephone'] . '" class="form-control" id="inputTelefone" name="inputTelefone" >';
                            ?>
                        </div>
                        <div style="text-align: start;" class="form-group col-md-6 espaco ">
                            <label for="inputPassword4" style="color: white;">Senha</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Digite sua nova senha">
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
                                    Você deseja salvar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" name="update" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- FIM DO EDITAR DADOS -->

        </div>

        <!-- INICIO MOSTRAR ITENS -->

        <div class="row col teste collapse collapse-vertical items" style="margin-top: 30px; height: auto; text-align: start;" id="itens">
            <?php
            if ($items !== null) {
                foreach ($items as $item) {
                    if ($item->available == 1) {
                        $ava = "Disponível";
                    } else {
                        $ava = "Indisponível";
                    }
                    echo '" <div class="card" style="width: 18rem; height: fit-content; max-height: fit-content;">
                        <div class="card-body">
                            <h5 class="card-title" style="text-transform: uppercase;">' . $item->name . '</h5>
                            <div  style="margin-bottom: 20px;">
                            <p style="margin: 0;"">Valor do aluguel: </p>
                            <strong class="card-text">R$' . $item->value . '</strong>
                            </div>
                            <div style="margin-bottom: 20px;">
                            <p style="margin: 0;"">Disponibilidade: </p>
                            <strong class="card-text">' . $ava . '</strong>
                            </div>
                            <div style="margin-bottom: 20px;">
                            <p style="margin: 0;"">Descrição: </p>
                            <strong class="card-text">' . $item->description . '</strong>
                            </div>
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete_item_' . $item->get_id() . '">
                            Deletar item
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#update_item_' . $item->get_id() . '" aria-expanded="false" aria-controls="collapseWidthExample">
                            Editar item
                        </button>
                        </div>
                    </div>
                    <form method="post">
                <div class="modal fade" id="delete_item_' . $item->get_id() . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Deletar item</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Você deseja deletar o item' . $item->name . '?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                <button type="submit" name="delete_item" value="' . $item->get_id() . '" class="btn btn-primary">Deletar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>"';
                }
            } else {
                echo '<h1 style="text-align: center; color: white;">Nenhum item disponível!</h1>';
            }
            ?>
        </div>

        <!-- FIM MOSTRAR ITENS -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>