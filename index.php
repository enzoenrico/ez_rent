<?php
session_start();
include(__DIR__ . '/front/navbar.php');
require_once('autoload.php');

$_SESSION['logado'] = $_SESSION['logado'] ?? null;

if (isset($_SESSION['logado']) && $_SESSION['logado']) {
    echo '<div class="alert alert-warning alert-dismissible fade show" style="background-color: lightgreen; color: black;" role="alert">';
    echo '<strong> Bem-vindo ao EzRent ' . $_SESSION['user']['name'] . '!</strong>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

$itemActions = new ItemMethods();
if ($itemActions->get_all_items() !== null) {
    $items = $itemActions->get_all_items();
} else {
    $items = null;
}

?>
<html>
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="./front/navbar-style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<title>Home</title>

<body>
    <style>
        #content {
            gap: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        ::-webkit-scrollbar {
            visibility: hidden;
            width: 0;
            height: 0;
        }
    </style>
    <div id="content" class="row">
        <?php
        if ($items !== null) {
            foreach ($items as $item) {
                if ($item->available == 1) {
                    $ava = "Disponível";
                } else {
                    $ava = "Indisponível";
                }
                echo ' <div class="card" style="width: 18rem; height: fit-content; max-height: fit-content;">
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
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>';
            }
        } else {
            echo '<h1 style="text-align: center;">Nenhum item disponível!</h1>';
        }
        ?>
    </div>
</body>

</html>