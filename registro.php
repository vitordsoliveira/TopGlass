<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Glass</title>

    <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/estilo.css">

    <link rel="stylesheet" href="css/responsivo.css">

</head>

<body>

    <header> <!-- BARRA MENU-->

        <?php require_once ('conteudo/faixa-topo.php'); ?>

    </header>

    <!-- <main class="wow registro animate__animated animate__fadeInUp">
        
        <div class="site">
            <div class="registroTop">
                <h2>REGISTRO</h2>
            </div>
            <form action="#" method="POST">

                <div>
                    <div>
                        <label for="nome">
                            <p>Digite seu nome:</p>
                        </label>
                        <input type="text" name="nome" placeholder="Digite aqui seu nome completo" required>
                    </div>

                    <div>
                        <label for="idade">
                            <p>Digite sua idade:</p>
                        </label>
                        <input type="text" name="idade" placeholder="DD/MM/AAAA" required>
                    </div>

                    <div>
                        <label for="end">
                            <p>Digite seu endereço:</p>
                        </label>
                        <input type="text" name="end" placeholder="Digite aqui sua rua numero e bairro" required>
                    </div>

                    <div>
                        <label for="num">
                            <p>Digite seu número:</p>
                        </label>
                        <input type="text" name="num" placeholder="(DDD) 0 0000-0000" required>
                    </div>

                    <div>
                        <label for="email">
                            <p>Digite seu E-mail:</p>
                        </label>
                        <input type="text" name="email" placeholder="Digite aqui seu email completo" required>
                    </div>

                    <div>
                        <label for="senha">
                            <p>Digite sua senha:</p>
                        </label>
                        <input type="text" name="senha" placeholder="Digite aqui sua senha" required>
                    </div>
                    <li>mínimo de 8 caracteres</li>
                    <li>mínimo de 1 número</li>

                    <div>
                        <label for="senha">
                            <p>Digite sua senha novamente:</p>
                        </label>
                        <input type="text" name="senha" placeholder="Digite aqui sua senha" required>
                    </div>

                    <div class="registrar">
                        <input type="submit" value="registrar">
                    </div>
                </div>

            </form>
        </div>

    </main> -->
    <main class="wow registro animate__animated animate__fadeInUp">
        <div class="site">
            <div class="registroTop">
                <h2>REGISTRO</h2>
            </div>
            <form action="#" method="POST">

                <div class="nomeGrupo">
                    <div>
                        <label for="nome">DIGITE SEU NOME:</label>
                        <input type="text" name="nome" placeholder="Digite aqui seu nome completo" required>
                    </div>
                    <div>
                        <label for="idade">DATA DE NASCIMENTO:</label>
                        <input type="text" name="idade" placeholder="DD/MM/AAAA" required>
                    </div>
                </div>

                <div class="enderecoGrupo">
                    <div>
                        <label for="end">DIGITE SEU ENDEREÇO:</label>
                        <input type="text" name="end" placeholder="Digite aqui sua rua, número e bairro" required>
                    </div>
                    <div>
                        <label for="num">DIGITE SEU NÚMERO:</label>
                        <input type="text" name="num" placeholder="(DDD) 0 0000-0000" required>
                    </div>
                </div>
                <div class="loginGrupo">
                    <div>
                        <label for="email">DIGITE SEU E-MAIL:</label>
                        <input type="text" name="email" placeholder="Digite aqui seu email completo" required>
                    </div>

                    <div>
                        <label for="senha">DIGITE SUA SENHA:</label>
                        <input type="password" name="senha" placeholder="Digite aqui sua senha" required>
                        <li>mínimo de 8 caracteres</li>
                        <li>pelo menos 1 número</li>
                    </div>

                    <div>
                        <label for="senhaNoMe">DIGITE A SENHA NOVAMENTE:</label>
                        <input type="password" name="senhaNoMe" placeholder="Digite aqui sua senha" required>
                    </div>

                    <div class="registrar">
                        <input type="submit" value="REGISTRAR-SE">
                    </div>
                </div>

            </form>
        </div>
    </main>

    <!-- RODAPÉ -->
    <?php require_once ('conteudo/rodape.php'); ?>

    <!--jQuery sempre antes de acabar o body-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!--SLICK JS-->
    <script src="js/slick.min.js"></script>

    <script src="js/wow.min.js"></script>

    <!--meu JS no final-->
    <script src="js/estilo.js"></script>

</body>

</html>