<div class="container mt-5">

    <h2 class="tituloOrcamento">ORÇAMENTO</h2>

    <form action="index.php?p=cliente&cl=inserir" method="POST" enctype="multipart/form-data">

        <div class="row">

            <h3>CONFIRMAR CLIENTE</h3>

            <div class="row">
                <div class="col-2">
                    <div class="mb-3">
                        <label for="cpfCliente" class="form-label">
                            <p>CPF Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="cpfCliente" name="cpfCliente"
                            placeholder="DIGITE O CPF " required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="nomeCliente" class="form-label">
                            <p>Nome Cliente:</p>
                        </label>
                        <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required>
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <label for="telefoneCliente" class="form-label">
                            <p>Telefone Cliente:</p>
                        </label>
                        <input type="tel" class="form-control" id="telefoneCliente" name="telefoneCliente" required>
                    </div>
                </div>
            </div>

            <!-- FORM ORC -->
            <h3>FAZER ORÇAMENTO</h3>

            <div class="row">

                <div class="options col-3">
                    <select name="servicosVidro" id="servicosVidro" required>
                        <option value="servicoVidro" selected>
                            <p>SERVIÇOS VIDRO</p>
                        </option>
                        <option value="Box de Vidro" selected value = optionVidro>
                            <p>Box de Vidro</p>
                        </option>
                        <option value="Jalena de Vidro" selected value = optionVidro>
                            <p>Janela de Vidro</p>
                        </option>
                        <option value="Pia de Vidro" selected value = optionVidro>
                            <p>Pia de Vidro</p>
                        </option>
                        <option value="Teto de Vidro" selected value = optionVidro>
                            <p>Teto de Vidro</p>
                        </option>
                        <option value="Porta de Vidro" selected value = optionVidro>
                            <p>Porta de Vidro</p>
                        </option>
                        <option value="Corrimão de Vidro" selected value = optionVidro>
                            <p>Corrimão de Vidro</p>
                        </option>
                    </select>
                </div>

                <div class="options col-3">
                    <select name="servicosEsquadria" id="servicosEsquadria" required>
                        <option value="servicoEsquadria" selected value = optionEsquadria>
                            <p>SERVIÇOS ESQUADRIA</p>
                        </option>
                        <option value="Porta de alumínio" selected  value = optionEsquadria>
                            <p>Porta de alumínio</p>
                        </option>
                        <option value="Janela de alumínio" selected  value = optionEsquadria>
                            <p>Janela de alumínio</p>
                        </option>
                        <option value="Corrimão de alumínio" selected  value = optionEsquadria>
                            <p>Corrimão de alumínio</p>
                        </option>
                    </select>
                </div>

            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="nomeFuncionario" class="form-label">
                        <p>FUNCIONÁRIO RESPONSÁVEL</p>
                    </label>
                    <input type="text" class="form-control" id="idFuncionario" name="idFuncionario" required>
                </div>
            </div>
        </div>

    </form>
    <div>
        <textarea name="comentOrcamento" id="comentOrcamento" cols="65" rows="10"
            placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço ou apontamentos sobre o serviço."
            required></textarea>
    </div>
    <div class=" btnEnviar col-2">
        <button type="submit" class="btn btn-primary">Enviar Orçamento</button>
    </div>

</div>
</div>