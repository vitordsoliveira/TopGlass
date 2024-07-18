<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/estiloLogin.css">

</head>

<body>

    <!-- Seção que ocupa 100% da altura da viewport (tela visível do usuário) -->
    <section class="vh-100">

        <!-- Contêiner fluido que ocupa 100% da largura da tela -->
        <div class="container-fluid">

            <div class="row">
                <!-- Coluna que ocupa metade da largura da tela em telas pequenas, com texto preto -->
                <div class="col-sm-6 text-black" style="background: #333;">

                    <!-- Div com padding horizontal e margem esquerda -->
                    <div class="px-5 ms-xl-4">
                        <!-- Texto de boas-vindas em cor branca -->
                        <span class="h1 fw-bold mb-0" style="color:whitesmoke">Seja bem-vindo</span>
                    </div>

                    <!-- Div flexível alinhada ao centro verticalmente com customização de altura e padding -->
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5" style="display: flex;justify-content: center;margin-top: 25% !important;">

                        <!-- Formulário com largura definida -->
                        <form id="FormLoginAdmin" style=" width: 23rem;">

                            <!-- Cabeçalho do formulário com espaçamento nas letras e cor branca -->
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color:whitesmoke">Entre em sua conta!</h3>

                            <div data-mdb-input-init class="form-outline mb-4"> <!-- Campo de entrada de email -->
                                <input title='email' name="email" type="email" id="email" class="form-control form-control-lg" />
                                <label class="form-label" for="email" style="color:whitesmoke">Email</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4"> <!-- Campo de entrada de senha -->
                                <input title='senha' name="senha" type="password" id="senha" class="form-control form-control-lg" />
                                <label class="form-label" for="senha" style="color:whitesmoke">Senha</label>
                            </div>

                            <div class="pt-1 mb-4"> <!-- Botão de envio do formulário -->
                                <button class="btn btn-info btn-lg btn-block" type="button" onclick="LoginAdmin()" style="background:#E79924; border: 0px">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Coluna que ocupa metade da largura da tela em telas pequenas, mas oculta em telas menores que "small" -->
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="js/estilo.js"></script>

</body>

</html>