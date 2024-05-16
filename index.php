<?php
include(__DIR__ . '/front/navbar.php');
require_once('autoload.php');

$_SESSION['logado'] = $_SESSION['logado'] ?? null;

if (isset($_SESSION['logado']) && $_SESSION['logado']) {
  echo "<div id='toast' class='toast'>";
  echo '<strong> Bem-vindo ao EzRent ' . $_SESSION['user']['name'] . '!</strong>';
  echo "</div>
  
  <script>
        // Função para mostrar o card toast
        function showToast() {
            var toast = document.getElementById('toast');
            toast.style.display = 'block';
            setTimeout(function(){ toast.style.display = 'none'; }, 5000); // Tempo em milissegundos (5 segundos)
        }
    
        window.onload = function() {
            showToast();
        };
  </script>";
}

if(isset($_POST['alugar_item'])){
  $aluguelActions = new AluguelMethods();
  $aluguelActions->add_Aluguel($_SESSION['user']['id'], $_POST['alugar_item']);
}

$itemActions = new ItemMethods();

if ($_SESSION['itemSearch']) {
  if (isset($_SESSION['searchResult'])) {
    $items = $_SESSION['searchResult'];
  } else {
    $items = $itemActions->get_all_items();
    echo '<div id="toast_search" class="toast" style="text-align: center; background-color: red !important;">';
    echo '<strong> Nenhum item encontrado!</strong>';
    echo "</div>
  
  <script>
        // Função para mostrar o card toast
        function showToast() {
            var toast = document.getElementById('toast_search');
            toast.style.display = 'block';
            setTimeout(function(){ toast.style.display = 'none'; }, 5000); // Tempo em milissegundos (5 segundos)
        }
    
        window.onload = function() {
            showToast();
        };
  </script>";
  }
} else {
  $items = $itemActions->get_all_items();
}

?>
<html>
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="./front/navbar-style.css">
<title>Home</title>

<body>
  <style>
    .card-size {
      height: 450px;
      width: 250px;
    }

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
    // for ($i = 0; $i < 40; $i++) {
    //   echo '<div class="card" style="width: 18rem;">
    //   <img src="..." class="card-img-top" alt="...">
    //   <div class="card-body">
    //     <h5 class="card-title">Card title</h5>
    //     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
    //     <a href="#" class="btn btn-primary">Go somewhere</a>
    //   </div>
    // </div>';
    // }
    if ($items !== null) {
      foreach ($items as $item) {
        if ($item->available == 1) {
          $ava = "Disponível";
        } else {
          $ava = "Indisponível";
        }
        echo ' <div class="card card-size" >
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
                            <p style="margin: 0;"">Categoria: </p>
                            <strong class="card-text">' . $item->group_description . '</strong>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <p style="margin: 0;"">Descrição: </p>
                            <strong class="card-text">' . $item->description. '</strong>
                        </div>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#alugar'. $item->get_id() .'">Alugar item</button>
                        <form method="post">
                            <div class="modal fade" id="alugar'. $item->get_id() .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Alugar item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Você deseja alugar este item?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" name="alugar_item" value="'. $item->get_id() .'" class="btn btn-primary">Alugar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>';
      }
    } else {
      echo '<h1 style="text-align: center;">Nenhum item disponível!</h1>';
    }
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>