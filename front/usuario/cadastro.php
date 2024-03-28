<head>
    <link rel="stylesheet" href="./cadastro-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro</title>
</head>

<body>
    <div id="sing-in-body">
        <h1>EzRent</h1>
        <div class="sign-in-box">
            <form style="padding: 20px;">
                <div class="row">
                    <div class="form-group">
                        <label for="inputName" style="color: white;">Nome</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Digite seu nome">
                    </div>
                    <div class="form-group ">
                        <label for="inputEmail4" style="color: white;">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Digite seu email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword4" style="color: white;">Senha</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Digite sua senha">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputSenha2" style="color: white;">Confirme a senha</label>
                        <input type="text" class="form-control" id="inputSenha2" placeholder="Confirme sua senha">
                    </div>
                </div><br>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>