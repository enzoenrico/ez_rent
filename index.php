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
        isset($item->available);
        if ($item->available == 1) {
          $ava = "Disponível";
        } else {
          $ava = "Indisponível";
        }
        if ($ava == "Disponível") {
          $item->available == 1;
        } else {
          $item->available == 0;
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
                          <button id="addToCartBtn' . $item->get_id() . '" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carrinho'. $item->get_id() .'">Adicionar ao carrinho</button>
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
<div style="bottom:20px; right:20px; width: 60px;">
  <button style="display: flex; align-items: center; justify-content: center; width: 60px; height: 60px; border-radius: 50%;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCarrinho">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
      <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
    </svg>
  </button>
</div>
  <div class="modal fade" id="modalCarrinho" tabindex="-1" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCarrinhoLabel" style="color: black;">Seu Carrinho</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                foreach ($_SESSION["carrinho"] as $item_carrinho){
                  echo "oi";
                  // var_dump($_SESSION["carrinho"]);

                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para alterar o conteúdo do botão após ser clicado
    document.getElementById('addToCartBtn<?php echo $item->get_id(); ?>').addEventListener('click', function() {
        var btn = this;
        btn.textContent = 'Item adicionado ao carrinho'; // Altera o texto do botão
        btn.disabled = true; // Desabilita o botão após o clique
    });       
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>