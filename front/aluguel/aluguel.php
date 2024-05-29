<?php
require_once('C:\xampp\htdocs\ez_rent\autoload.php');

$itemMethods = new ItemMethods();
$userMethods = new UserMethods();
$rentMethods = new AluguelMethods();

$itensAluguel = $rentMethods->get_Carrinho($_SESSION['user']['id']);

if (isset($_POST['tirarcarrinho'])) {
    $rentMethods->delete_Carrinho($_POST['tirarcarrinho'], $_SESSION['user']['id']);
    $itensAluguel = $rentMethods->get_Carrinho($_SESSION['user']['id']);
}

if (isset($_POST['alugar_confirm'])) {

    if ($rentMethods->enviar_solicitacao($_POST['alugar_confirm'], $_SESSION['user']['id'], $_POST['locador'])) {
        echo '<div id="toast_search" class="toast" style="text-align: center; background-color: green !important;">';
        echo '<strong>Aluguel realizado com sucesso!</strong>';
        echo "</div>";
        $itensAluguel = $rentMethods->get_Carrinho($_SESSION['user']['id']);
    } else {
        echo '<div id="toast_search" class="toast" style="text-align: center; background-color: red !important;">';
        echo '<strong>Algo deu errado!</strong>';
        echo "</div>";
    }
}


?>

<html>
<link rel="stylesheet" href="aluguel-style.css">
<title>Aluguel</title>

<body>
    <div class="roll-back">
        <div class="roll-back-btn btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
            <a href="/ez_rent/index.php">Voltar</a>
        </div>
    </div>
    <?php
    if ($itensAluguel != null) {
    ?>
        <div class="teste">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome do item</th>
                        <th scope="col">Valor por dia</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Locador</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Data limite do aluguel</th>
                        <th scope="col-2"></th>
                    </tr>
                </thead>
                <?php
                foreach ($itensAluguel as $item) {
                    $locador = new Locador();
                    $locador = $itemMethods->get_item_owner($item->id);
                    echo '
        <tbody class="table-group-divider">
            <tr>
                <th scope="row">#</th>
                <td>' . $item->name . '</td>
                <td>R$' . $item->value . '</td>
                <td>' . $item->group_description . '</td>
                <td>' . $locador->get_nome() . '</td>
                <td class="col-3"><textarea class="form-control" name="descItem" id="floatingTextarea" style="resize: none; height: 100px; padding-top: 0px;" disabled> ' . $item->description . '</textarea></td>
                <td>' . $item->dataFinal . '</td>
                <td class="col-2">
                <form method="post">
                <button type="submit" name="tirarcarrinho" class="btn btn-danger" value="' . $item->get_id() . '">
                    Retirar item
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#alugar_item_' . $item->get_id() . '" class="btn btn-success" value="' . $item->get_id() . '">
                    Alugar item
                </button>
            </form>
                </td>
            </tr>
        </tbody>
        <div id="alugar_item_' . $item->get_id() . '" class="modal fade">
        <form method="post" style="padding: 20px;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Termos do aluguel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Leia com atenção os termos do aluguel!</p>
            <p>Eu, <strong>' . $_SESSION['user']['name'] . '</strong>, doravante denominado "Locatário", declaro que li, compreendi e concordo com os termos e condições abaixo descritos para o aluguel do item <strong>' . $item->name . '</strong>, doravante denominado "Item", de propriedade de <strong>' . $locador->get_nome() . '</strong>, doravante denominado "Proprietário":</p>

            <p>Responsabilidade pelo Item:</p>
            <p>1.1. O Locatário assume total responsabilidade pelo Item durante o período de locação.</p>
            <p>1.2. O Software EzRent, doravante denominado "Software", não se responsabiliza por quaisquer danos causados ao Item durante o período de locação.</p>
            
            <p>Condição do Item:
            <p>2.1. O Locatário se compromete a devolver o Item ao Proprietário no mesmo estado de origem em que foi recebido, salvo desgaste natural pelo uso.</p>
            <p>2.2. Qualquer dano ao Item será avaliado pelo Proprietário e poderá resultar em uma multa a ser determinada pelo valor do Item e pelo dano causado.</p>
            
            <p>Devolução do Item:
            <p>3.1. O Item deve ser devolvido ao Proprietário na data e hora acordadas no contrato de locação.</p>
            <p>3.2. O atraso na devolução do Item sem aviso prévio ao Proprietário poderá acarretar em custos adicionais.</p>
            
            <p>Aceitação:
            <p>4.1. Ao assinar este Termo de Aceite, o Locatário reconhece e aceita os termos e condições estabelecidos para o aluguel do Item.</p>
            <p>4.2. O Locatário declara estar ciente das suas responsabilidades e concorda em cumpri-las integralmente.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
            <button type="button" data-bs-target="#dias_' . $item->get_id() . '" data-bs-toggle="modal"  class="btn btn-primary">Aceito</button>
          </div>
        </div>
      </div>
        </div>
        ';
                    echo '
        <div class="modal fade" id="dias_' . $item->get_id() . '" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Confirmar aluguel</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Você quer alugar este item :  ' . $item->name . ' ? 
            <input style="visibility: hidden;" name="locador" value="' . $locador->get_id() . '"></input>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" type="submit" name="alugar_confirm" value="' . $item->get_id() . '">Alugar</button>
            </div>
          </div>
        </div>
      </div>
      </form>';
                }
                ?>
            </table>
        </div>
    <?php
    } else {
        echo '<h1 style="text-align: center; color: white;">Nenhum item no carrinho!</h1>';
    }
    ?>
</body>

</html>