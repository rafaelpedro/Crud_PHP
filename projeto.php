<?php

include("./model/Projeto.php");
$projet1 = new Projeto();
?>
<div>
    <h2>Gestão de Projetos</h2>
    <a href="index.php?pagina=projeto.php&acao=listar"><button class="button button1">Listar Todos</button></a>
    <a href="index.php?pagina=projeto.php&acao=inserir"><button class="button button2">Adicionar Projeto</button></a>

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
        $resultado = $projet1->listar();
        if (count($resultado)) {
        ?>
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>DESCRICAO</th>
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
                        <td><?= $row["responsavel"] ?></td>
                        <td>
                            <a href="index.php?pagina=projeto.php&acao=visualizar&id=<?= $id ?>"><button class="button button4">Visualizar</button></a>
                            <a href="index.php?pagina=projeto.php&acao=alterar&id=<?= $id ?>"><button class="button button2">Alterar</button></a>
                            <a href="index.php?pagina=controlerProjeto.php&acao=excluir&id=<?= $id ?>"><button class="button button3">Excluir</button></a>
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
        <h2>Adicionar novo Projeto</h2>

        <div class="boxForm">
            <form action="controlerProjeto.php" method="post">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Informe o nome do projeto">

                <label for="descricao">Descricao</label>
                <input type="text" id="descricao" name="descricao" placeholder="Informe a descricao do projeto">

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
            $row = $projet1->carregarProjeto($id);
            //var_dump($row);
            foreach ($row as $dado)
        ?>
            <h2>Alterar Projeto</h2>

            <div class="boxForm">
                <form action="controlerProjeto.php" method="post">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= $dado['nome']; ?>">

                    <label for="descricao">Descricao</label>
                    <input type="text" id="descricao" name="descricao" value="<?= $dado['descricao']; ?>">

                    <label for="responsavel">Responsavel</label>
                    <input type="text" id="responsavel" name="responsavel" value="<?= $dado['responsavel']; ?>">

                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="acao" value="editar">
                    <input type="submit" value="Atualizar">
                </form>
            </div>
        <?php
        } else {
            header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
        }
    } elseif ($acao == "visualizar") {
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = $_GET["id"];
            $resultados = $projet1->carregarProjeto($id);
            //var_dump($row);
            ?>
                <table id="customers">
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>DESCRICAO</th>
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