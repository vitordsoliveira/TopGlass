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

    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <section class="vh-100" style="background: linear-gradient(to left, rgba(35, 150, 212, 0.712), rgb(1, 165, 253));">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="img/imgLogin.jpg" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center " style="  background: #f5f5f5;">
                                <div class="card-body p-4 p-lg-5 text-black">


                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <div> <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="logoLogin h1 fw-bold mb-0"><img src="img/logo.png" alt="">
                                            </span>
                                            <div class="logoLogin">
                                                <h1>TOP GLASS</h1>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">BEM VINDO</h5>

                                    <form id="formLoginAdmin">

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="form2Example17" class="form-control form-control-lg"
                                                name="email" title="email" />
                                            <label class="form-label" for="form2Example17">EMAIL</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input name="senha" title="senha" type="password" id="form2Example27"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">SENHA</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="button"
                                                onclick="LoginAdmin()">ENTRAR</button>
                                        </div>
                                    </form>


                                    <a class="small text-muted" href="#!">Forgot password?</a>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>
                                </div>
                            </div>
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