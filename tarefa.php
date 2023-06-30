<?php

include("./model/Tarefa.php");
$tarefa1 = new Tarefa();
?>
<div>
    <h2>Gestão de Tarefas</h2>
    <a href="index.php?pagina=tarefa.php&acao=listar"><button class="button button1">Listar Todos</button></a>
    <a href="index.php?pagina=tarefa.php&acao=inserir"><button class="button button2">Adicionar Tarefa</button></a>

</div>
<?php
if (isset($_GET["mensagem"]) && !empty($_GET["mensagem"])) {
    $mensagem = $_GET["mensagem"];

    if ($mensagem == "sucesso") {
?>
        <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Operação realizada com sucesso!!!.
        </div>
    <?php
    } else {
    ?>
        <div class="alert warning">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Ocorreu um erro na operação com o projeto, reveja os dados e tente novamente mais tarde. Obrigado!
        </div>
        <?php
    }
}

if (isset($_GET["acao"]) && !empty($_GET["acao"])) {

    $acao = $_GET["acao"];

    if ($acao == "listar") {
        $resultado = $tarefa1->listar();
        if (count($resultado)) {
        ?>
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>DESCRICAO</th>
                    <th>PRAZO</th>
                    <th>PROJETO</th>
                    <th>RESPONSAVEL</th>
                    <th>AÇÃO</th>
                </tr>
                <?php
                foreach ($resultado as $row) {
                    $id = $row["id"];
                ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?= $row["nome"] ?></td>
                        <td><?= $row["descricao"] ?></td>
                        <td><?= $row["prazo"] ?></td>
                        <td><?= $row["projeto"] ?></td>
                        <td><?= $row["responsavel"] ?></td>
                        <td>
                            <a href="index.php?pagina=tarefa.php&acao=visualizar&id=<?= $id ?>"><button class="button button4">Visualizar</button></a>
                            <a href="index.php?pagina=tarefa.php&acao=alterar&id=<?= $id ?>"><button class="button button2">Alterar</button></a>
                            <a href="index.php?pagina=controlerTarefa.php&acao=excluir&id=<?= $id ?>"><button class="button button3">Excluir</button></a>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        } else {
            echo "Nenhum resultado retornado.";
        }
    } elseif ($acao == "inserir") {
        ?>
        <h2>Adicionar nova Tarefa</h2>

        <div class="boxForm">
            <form action="controlerTarefa.php" method="post">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Informe o nome da tarefa">

                <label for="descricao">Descricao</label>
                <input type="text" id="descricao" name="descricao" placeholder="Informe a descricao da tarefa">

                <label for="prazo">Prazo</label>
                <input type="text" id="prazo" name="prazo" placeholder="Informe o prazo da tarefa">

                <label for="projeto">Projeto</label>
                <input type="text" id="projeto" name="projeto" placeholder="Informe o id do projeto cadastrado">

                <label for="responsavel">Responsavel</label>
                <input type="text" id="responsavel" name="responsavel" placeholder="Informe o id do responsavel cadastrado">

                <input type="hidden" name="acao" value="inserir">
                <input type="submit" value="Adicionar">
            </form>
        </div>

        <?php
    } elseif ($acao == "alterar") {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = $_GET["id"];
            $row = $tarefa1->carregarTarefa($id);
            //var_dump($row);
            foreach ($row as $dado)
        ?>
            <h2>Alterar Tarefa</h2>

            <div class="boxForm">
                <form action="controlerTarefa.php" method="post">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= $dado['nome']; ?>">

                    <label for="descricao">Descricao</label>
                    <input type="text" id="descricao" name="descricao" value="<?= $dado['descricao']; ?>">

                    <label for="prazo">Prazo</label>
                    <input type="text" id="prazo" name="prazo" value="<?= $dado['prazo']; ?>">

                    <label for="projeto">Projeto</label>
                    <input type="text" id="projeto" name="projeto" value="<?= $dado['projeto']; ?>">

                    <label for="responsavel">Responsavel</label>
                    <input type="text" id="responsavel" name="responsavel" value="<?= $dado['responsavel']; ?>">

                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="acao" value="editar">
                    <input type="submit" value="Atualizar">
                </form>
            </div>
        <?php
        } else {
            header("Location: ./index.php?pagina=tarefa.php&acao=listar&mensagem=erro");
        }
    } elseif ($acao == "visualizar") {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = $_GET["id"];
            $resultados = $tarefa1->carregarTarefa($id);
            //var_dump($row);
            ?>
                <table id="customers">
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>DESCRICAO</th>
                        <th>PRAZO</th>
                        <th>PROJETO</th>
                        <th>RESPONSAVEL</th>
                    </tr>
                    <?php
                    foreach ($resultados as $resultado) {
                        $id = $resultado["id"];
                    ?>
                        <tr>
                            <td><?php echo $resultado["id"]; ?></td>
                            <td><?= $resultado["nome"] ?></td>
                            <td><?= $resultado["descricao"] ?></td>
                            <td><?= $resultado["prazo"] ?></td>
                            <td><?= $resultado["projeto"] ?></td>
                            <td><?= $resultado["responsavel"] ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
        }
    }
}

?>