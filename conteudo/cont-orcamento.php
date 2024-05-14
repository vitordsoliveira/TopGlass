<section class="wow orcamento animate__animated animate__fadeInUp">
    <div class="site">
        <h2>FAÇA UM ORÇAMENTO SEM COMPROMISSO!</h2>
        <h3>
                <?php
                if ($ok == 1) {
                    echo $nome . ", sua mensagem foi enviada com sucesso!";
                } else if ($ok == 2) {
                    echo $nome . ", não foi possível enviar sua mensagem!";
                }
                 ?>
            </h3>
        <form action="#" method="POST">
            <div>
                <div>
                    <label for="nome">
                        <p>Digite seu nome:</p>
                    </label>
                    <input type="text" name="nome" placeholder="Digite aqui seu nome completo" required>
                </div>

                <div>
                    <label for="email">
                        <p>Digite seu email:</p>
                    </label>
                    <input type="text" name="email" placeholder="Digite aqui seu email: usuario@email.com" required>
                </div>

                <div>
                    <label for="num">
                        <p>Digite seu número:</p>
                    </label>
                    <input type="text" name="num" placeholder="(DDD) 0 0000-0000" required>
                </div>

                <div>
                    <label for="end">
                        <p>Digite seu endereço:</p>
                    </label>
                    <input type="text" name="end" placeholder="Digite aqui sua rua numero e bairro" required>
                </div>
            </div>

            <div>
                <div>
                    <label for="servicos">
                        <p>Tipos de Serviço</p>
                    </label>
                    <select name="servicosVidro" id="servicosVidro" required>
                        <option value="servicoVidro" selected>
                            <p>SERVIÇOS VIDRO</p>
                        </option>
                        <option value="Box de Vidro">
                            <p>Box de Vidro</p>
                        </option>
                        <option value="Jalena de Vidro">
                            <p>Jalena de Vidro</p>
                        </option>
                        <option value="Pia de Vidro">
                            <p>Pia de Vidro</p>
                        </option>
                        <option value="Teto de Vidro">
                            <p>Teto de Vidro</p>
                        </option>
                        <option value="Porta de Vidro">
                            <p>Porta de Vidro</p>
                        </option>
                        <option value="Corrimão de Vidro">
                            <p>Corrimão de Vidro</p>
                        </option>
                    </select>

                    <select name="servicosEsquadria" id="servicosEsquadria" required>
                        <option value="servicoEsquadria" selected>
                            <p>SERVIÇOS ESQUADRIA</p>
                        </option>
                        <option value="Porta de alumínio">
                            <p>Porta de alumínio</p>
                        </option>
                        <option value="Janela de alumínio">
                            <p>Janela de alumínio</p>
                        </option>
                        <option value="Corrimão de alumínio">
                            <p>Corrimão de alumínio</p>
                        </option>
                    </select>
                </div>

                <div>
                    <label for="coment">
                        <p>Comentário sobre o Serviço:</p>
                    </label>
                    <textarea name="coment" id="coment" cols="65" rows="10"
                        placeholder="Escrever informações básicas do serviço como medidas (1.20 x 2.04) em metro do serviço, cor do serviço e etc. Podendo fazer perguntas ou apontamentos sobre o serviço."
                        required></textarea>
                </div>
                <a href="servicos.php">Mais de um serviço</a>
                <div class="envio">
                    <input type="submit" value="ENVIAR ORÇAMENTO">
                </div>
            </div>

        </form>
    </div>
</section>