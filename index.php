<?php
session_start();
include(__DIR__ . '/front/navbar.php');
require_once('autoload.php');

$_SESSION['logado'] = $_SESSION['logado'] ?? null;

if (isset($_SESSION['logado']) && $_SESSION['logado']){
    echo '<div class="alert alert-warning alert-dismissible fade show" style="background-color: lightgreen; color: black;" role="alert">';
  echo '<strong> Bem-vindo ao EzRent ' . $_SESSION['user']['name'] . '!</strong>';
  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
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
        for ($i = 0; $i < 20; $i++) {
        ?>
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</body>

</html>