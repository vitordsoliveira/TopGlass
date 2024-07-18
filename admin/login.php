<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- reset do site-->
    <link rel="stylesheet" href="css/reset.css">

    <!-- fonte do site-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="css/estilo.css">


</head>

<body>
    <section class="fundoLogin vh-100" style="background-color: #508bfc;">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="tituloLogin mb-5">BEM-VINDO</h3>

                            <div class=" logoLogin col">
                                <img src="img/logo.png" class="img-fluid" alt="foto do Cliente" id="imgFoto">
                            </div>


                            <form id="formLoginAdmin">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="email">
                                        E-MAIL
                                    </label>
                                    <input title="email" name="email" type="email" id="email" class="form-control form-control-lg" />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="senha">
                                        SENHA
                                    </label>
                                    <input title='senha' name="senha" type="password" id="senha"
                                        class="form-control form-control-lg" />
                                </div>

                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btnEntrar btn btn-primary btn-lg btn-block" type="button"
                                    onclick="LoginAdmin()">ENTRAR</button>
                                <hr class="my-4">

                            </form>

                            <div id="msgLogin"></div>
                            <div id="msgInvalido"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="js/estilo.js"></script>
</body>

</html>
