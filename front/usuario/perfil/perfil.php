<?php
session_start();
?>

<html>
<link rel="stylesheet" href="./perfil-style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<body>

    <!-- <div class="container text-center perfil-columns">
        <div class="row" style="gap: 20px;">
            <div class="col-4">
                Column
            </div>
            <div class="col-4">
                Column
            </div>
            <div class="col-4">
                Column
            </div>
        </div>
    </div> -->
    <div class="container overflow-hidden text-center perfil-columns">
        <div class="row gy-5" style="gap: 20px;">
            <div class="col-3 teste perfil-box" style="text-align: center;">
                <div class="perfil-box">
                    <div style="width: 200px; height: 200px; border-radius: 50%; background-color: white; margin-bottom: 20px;">
                    </div>
                    <div class="content">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editar" aria-expanded="false" aria-controls="collapseWidthExample">
                            Editar perfil
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editar" aria-expanded="false" aria-controls="collapseWidthExample">
                            Deletar perfil
                        </button>
                    </div>
                    <div class="btn-itens">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#itens" aria-expanded="false" aria-controls="collapseWidthExample">
                            Itens cadastrados
                        </button>
                    </div>
                </div>
            </div>
            <div class="col teste collapse collapse-horizontal" id="editar">
                <form method="post" style="padding: 20px;">
                    <div class="row">
                        <div style="text-align: start;" class="form-group col-md-6 espaco">
                            <label for="inputName" style="color: white;">Nome</label>
                            <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Digite seu nome">
                        </div>
                        <div style="text-align: start;" class="form-group col-md-6 espaco ">
                            <label for="inputEmail4" style="color: white;">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Digite seu email">
                        </div>
                    </div>
                    <div class="row">
                        <div style="text-align: start;" class="form-group col-md-6 espaco">
                            <label for="inputName" style="color: white;" mask="">Telefone</label>
                            <input type="text" class="form-control" id="inputTelefone" name="inputTelefone" placeholder="Digite seu telefone">
                        </div>
                        <div style="text-align: start;" class="form-group col-md-6 espaco ">
                            <label for="inputPassword4" style="color: white;">Senha</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Digite sua senha">
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
                                    Você deseja salvar seu cadastro?
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
        <div class="row col teste collapse collapse-vertical" style="max-height: fit-content; margin-top: 30px;" id="itens">
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>