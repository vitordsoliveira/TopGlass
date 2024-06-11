<div class="container mt-5">
    <h2>Fazer Orçamento</h2>

    <form action="index.php?p=cliente&cl=inserir" method="POST" enctype="multipart/form-data">

        <div class="row">
            <div class="col-8">

                <div class="mb-3">
                    <label for="nomeCliente" class="form-label">Nome Cliente:</label>
                    <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required>
                </div>

                <div class="row">

                    <div class="col-9">
                        <div class="mb-3">
                            <label for="enderecoCliente" class="form-label">Endereço Cliente:</label>
                            <input type="text" class="form-control" id="enderecoCliente" name="enderecoCliente"
                                required>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="telefoneCliente" class="form-label">Telefone Cliente:</label>
                            <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="emailCliente" class="form-label">E-mail Cliente:</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="senhaCliente" class="form-label">CPF Cliente:</label>
                            <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>

        </div>
    </form>
</div>