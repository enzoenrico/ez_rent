<?php
include(__DIR__ . '/front/navbar.php');
require_once('autoload.php');
$itemActions = new ItemMethods();
$um = new UserMethods();
$carrinhoActions = new AluguelMethods();

if (isset($_SESSION['logado']) && !isset($_SESSION['teste'])) {
  if ($_SESSION['logado']) {
    echo '<div id="toast_search" class="toast" style="text-align: center; background-color: green !important;">';
    echo '<strong> Bem vindo ao EzRent ' . $_SESSION['user']['name'] . '</strong>';
    echo "</div>";
    $um->set_mensagemlogin(1);
  }
}

if (isset($_POST['carrinho'])) {
  if (isset($_SESSION['logado'])) {
    $carrinhoActions->add_Carrinho($_POST['carrinho'], $_SESSION['user']['id']);
    $carrinho = $carrinhoActions->get_Carrinho($_SESSION['user']['id']);
  } else {
    echo '<div id="toast_search" class="toast" style="text-align: center; background-color: red !important;">';
    echo '<strong> Cadastre-se para alugar itens!</strong>';
    echo "</div>";
  }
}

if (!isset($_POST['carrinho']) && !isset($_POST['tirarcarrinho'])) {
  if ($_SESSION['itemSearch']) {
    if (isset($_SESSION['searchResult'])) {
      $items = $_SESSION['searchResult'];
      echo '<div class="breadcrumb">
      <a href="/ez_rent/index.php">Home  </a>
      <p>  /  Pesquisa  ->  "' . $pesquisa . '"</p>
      </div>';
    } else {
      if ($_SESSION['itemSearch']) {
        $items = $itemActions->get_all_items();
        echo '<div id="toast_search" class="toast" style="text-align: center; background-color: red !important;">';
        echo '<strong> Nenhum item encontrado!</strong>';
        echo "</div>";
      }
    }
  } else {
    $items = $itemActions->get_all_items();
  }
} else {
  $items = $itemActions->get_all_items();
}

if (isset($_POST['tirarcarrinho'])) {
  $carrinhoActions->delete_Carrinho($_POST['tirarcarrinho'], $_SESSION['user']['id']);
  $items = $itemActions->get_all_items();
  $carrinho = $carrinhoActions->get_Carrinho($_SESSION['user']['id']);
}

?>
<html>
<link rel="stylesheet" href="./front/navbar-style.css">
<title>Home</title>

<body>
  <style>
    .roll-back {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      /* margin-bottom: 35px;
      margin-top: 20px;
      margin-left: 20px; */
      width: 100%;

      a {
        text-decoration: none;
        color: white;
      }

      .roll-back-btn {
        background-color: #846FB0;
      }

      .items {
        p {
          margin: 0;
        }
      }

      .content-wrap {
        display: flex;
        flex: 1;
      }
    }

    .card-size {
      /* height: 450px; */
      width: 250px;
    }

    .breadcrumb {
      display: flex;
      align-items: center;
      margin-left: 20px;
      margin-top: 20px;

      p {
        margin-bottom: 0;
      }

      a {
        text-decoration: none;
        padding-right: 4px;
      }
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

    .fixed-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      width: 60px;
      height: 60px;
      border-radius: 50%;
    }

    .carrinho {
      width: 1000px;
    }
  </style>
  <button class="btn btn-primary fixed-button" data-bs-toggle="modal" data-bs-target="#carrinho" aria-expanded="false" aria-controls="collapseWidthExample">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
      <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
    </svg>
  </button>

  <div class="modal fade" id="carrinho" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" style="padding: 20px;" class="carrinho">
      <div class="modal-dialog ">
        <div class="modal-content carrinho">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Meu Carrinho</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
            <?php
            if (isset($carrinho) && $carrinho != null) {
            ?>
              <table class="table table-hover content-wrap" style="color: black;">
                <thead>
                  <tr>
                    <th>Nome do Produto</th>
                    <th>Valor</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($carrinho as $item) {
                    echo '
                    <tr>
                        <td>' . $item->name . '</td>
                        <td>R$' . $item->value . '</td>
                        <td>' . $item->group_description . '</td>
                        <td><textarea class="form-control" name="descItem" id="floatingTextarea" style="resize: none; height: 100px; padding-top: 0px;" disabled> ' . $item->description . '</textarea></td>
                        <td>
                            <form method="post">
                                <button type="submit" name="tirarcarrinho" class="btn btn-danger" value="' . $item->get_id() . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>';
                  }
                  ?>
                </tbody>
              </table>
            <?php
            } else {
              echo '<h2 style="text-align: center;">Seu carrinho está vazio</h2>';
            }
            ?>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
            <button type="submit" name="update_item" value="" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </div>
    </form>
  </div>


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
        if (isset($_SESSION['logado'])) {
          if ($item->available == 1 && $_SESSION['logado']) {
            $ava = "Disponível";
            echo ' <div class="card card-size" >
            <div class="card-body">
            <h5 class="card-title" style="text-transform: uppercase;" name="nomeItem">' . $item->name . '</h5>
            <div  style="margin-bottom: 20px;">
            <p style="margin: 0;"">Valor do aluguel: </p>
            <strong class="card-text" name="valorItem">R$' . $item->value . '</strong>
            </div>
            <div style="margin-bottom: 20px;">
            <p style="margin: 0;"">Disponibilidade: </p>
            <strong class="card-text" name="dispItem">' . $ava . '</strong>
            </div>
            <div style="margin-bottom: 20px;">
            <p style="margin: 0;"">Categoria: </p>
            <strong class="card-text" name="catItem">' . $item->group_description . '</strong>
            </div>
            <div style="margin-bottom: 20px;">
            <p style="margin: 0;"">Descrição: </p>
            <div class="form-floating">
            <textarea class="form-control" name="descItem" id="floatingTextarea" style="resize: none; height: 200px; padding-top: 0px;" disabled> ' . $item->description . '</textarea>
            </div>                        </div>
            <div>
            <form method="post">
            <button class="btn btn-success" type="submit" name="carrinho" value="' . $item->get_id() . '">Adicionar ao carrinho +</button>
            </form>
            </div>
            </div>
            </div>';
          }
        } else {
          if ($item->available == 1) {
            $ava = "Disponível";
            echo ' <div class="card card-size" >
            <div class="card-body">
            <h5 class="card-title" style="text-transform: uppercase;" name="nomeItem">' . $item->name . '</h5>
            <div  style="margin-bottom: 20px;">
            <p style="margin: 0;"">Valor do aluguel: </p>
            <strong class="card-text" name="valorItem">R$' . $item->value . '</strong>
            </div>
            <div style="margin-bottom: 20px;">
            <p style="margin: 0;"">Disponibilidade: </p>
            <strong class="card-text" name="dispItem">' . $ava . '</strong>
            </div>
            <div style="margin-bottom: 20px;">
            <p style="margin: 0;"">Categoria: </p>
            <strong class="card-text" name="catItem">' . $item->group_description . '</strong>
            </div>
            <div style="margin-bottom: 20px;">
            <p style="margin: 0;"">Descrição: </p>
            <div class="form-floating">
            <textarea class="form-control" name="descItem" id="floatingTextarea" style="resize: none; height: 200px; padding-top: 0px;" disabled> ' . $item->description . '</textarea>
            </div>                        </div>
            <div>
            <form method="post">
            <button class="btn btn-success" type="submit" name="carrinho" value="' . $item->get_id() . '">Adicionar ao carrinho +</button>
            </form>
            </div>
            </div>
            </div>';
          }
        }
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