<?php

require_once('class/ClassServico.php');

$servico = new ClassServico();
$lista = $servico->Listar();

?>



<table class="table">

<h2 class="tituloDashboard">SERVIÇOS</h2>

    <span class="btnDashboard">
        <a href="index.php?p=servico&sr=inserir"> + Cadastrar Serviço</a>
    </span>

    <thead>
        <tr>
            <th scope="col">
                <p>Imagem</p>
            </th>
            <th scope="col">
                <p>Nome</p>
            </th>
            <th scope="col">
                <p>Tipo de Serviço</p>
            </th>
            <th scope="col">
                <p>Descrição</p>
            </th>
            <th scope="col">
                <p>Caminho</p>
            </th>
            <th scope="col">
                <p>Status</p>
            </th>
            <th scope="col" class="ativar">
                <p>Atualizar</p>
            </th>
            <th scope="col" class="desativar">
                <p>Desativar</p>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lista as $linha): ?>
            <tr>
                <!-- Exibindo a imagem -->
                <td scope="col">
                    <img src="<?php echo ($linha['fotoServicos']); ?>"
                        alt="<?php echo ($linha['nomeServicos']); ?>"
                        style="width: 80px; height: auto;">
                </td>

                <td scope="col"><?php echo ($linha['nomeServicos']); ?></td>
             
                <td scope="col"><?php echo ($linha['idTipoServico']); ?></td>
              
                <td scope="col" style="width: 25%; height: auto; vertical-align: top;"><?php echo ($linha['descServico']); ?></td>


                <td scope="col"><?php echo ($linha['fotoServicos']); ?></td>
          
                <td scope="col"><?php echo ($linha['statusServicos']); ?></td>
             
                <td>
                    <a href="index.php?p=servico&sr=atualizar&id=<?php echo ($linha['idServico']); ?>">Atualizar</a>
                </td>
                <td>
                    <a href="index.php?p=servico&sr=desativar&id=<?php echo ($linha['idServico']); ?>">Desativar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
