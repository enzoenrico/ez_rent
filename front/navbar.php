<style>
  .button-size {
    max-width: 500px !important;
    min-width: 100px;
  }

  .d-flex {
    padding-top: 20px;
  }

  .body-size {
    padding-bottom: 83px;
  }

  nav {
    box-shadow: -1px 10px 26px 3px rgba(249, 246, 246, 0.76);
    -webkit-box-shadow: -1px 10px 26px 3px rgba(249, 246, 246, 0.76);
    -moz-box-shadow: -1px 10px 26px 3px rgba(249, 246, 246, 0.76);
  }

  #left-nav-bar {
    position: fixed;
  }

  .add-items {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-decoration: none;
  }

  .toast {
    position: fixed;
    top: 90px;
    left: 50%;
    transform: translateX(-50%);
    background-color: green !important;
    color: #fff;
    padding: 15px 20px;
    border-radius: 5px;
    z-index: 9999;
    display: none;
  }
</style>

<?php

require_once('autoload.php');
$logado = $_SESSION['logado'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['itemSearch'] = true;
  if (isset($_POST['itemSearch'])) {
    $pesquisa = $_POST['itemSearch'];
    $itemActions = new ItemMethods();
    $_SESSION['searchResult'] = $itemActions->search_item($_POST['itemSearch']);
  }
} else {
  $_SESSION['itemSearch'] = false;
}
?>


<div class='body-size'>

  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>
    <!-- COMEÇO NAVBAR -->
    <nav class="navbar navbar-dark bg-dark fixed-top row" style="background-color: #141312 !important;">
      <div class="container-fluid col-6">

        <button class="btn-explore" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><span class="navbar-toggler-icon"></span></button>
        <h1 style="color: white; padding-left: 10px;">EzRent</h1>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
          <div class="offcanvas-header">
            <h3 class="offcanvas-title side-navbar-header" id="offcanvasWithBothOptionsLabel">Explore</h3>
          </div>
          <div class="offcanvas-body">
            <div class="col-2" id="left-nav-bar">
              <ul>
                <li class="">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                  </svg>
                  <a href="">Home</a>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                  </svg>
                  <a href="/ez_rent/front/usuario/login/login.php">Login</a>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                  </svg>
                  <a href="/ez_rent/front/usuario/cadastro/cadastro.php">Cadastro</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid col" style="display: flex; justify-content: flex-end;">
        <?php if ($logado) { ?>
          <div class="logged-actions">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-plus-square" viewBox="0 0 16 16">
              <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            <a href="/ez_rent/front/item/cadastro_item.php">Add itens</a>
          </div>
          <div class="logged-actions">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
              </svg>
            </span>
            <a href="/ez_rent/front/usuario/perfil/perfil.php">Perfil</a>
          </div>
        <?php } ?>

        <form style="padding-top: 13.5px; padding-right: 10px;" class="d-flex" role="search" method="post">
          <input class="form-control button-size me-2" style="min-width: 150px;" type="search" placeholder="Search" aria-label="Search" name="itemSearch">
          <button id="btn-search" class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </nav>

</div>


<!-- FIM NAVBAR -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</div>