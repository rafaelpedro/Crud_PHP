<?php
include("./Model/Projeto.php");
$projeto = new Projeto();

if(isset($_POST["nome"]) && isset($_POST["descricao"]) && 
isset($_POST["responsavel"]) && isset($_POST["acao"])){
    
    if(!empty($_POST["nome"]) && !empty($_POST["descricao"]) && 
    !empty($_POST["responsavel"]) && !empty($_POST["acao"])){
      
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $responsavel = $_POST["responsavel"];
        $acao = $_POST["acao"];

        
        if($acao=="inserir"){
            $campos1 = "nome, descricao, responsavel";
            $campos2 = ":nome, :descricao, :responsavel";
            
            $dados = array('nome'=>$nome, 'descricao'=>$descricao, 'responsavel'=>$responsavel);
            $result = $projeto->cadastrar($campos1, $campos2, $dados);       
    
            if($result){
    
                header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=sucesso");
    
            }else{
                header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
            }
        }elseif($acao=="editar"){
            if(isset($_POST["id"]) && !empty($_POST["id"])){
                $id = $_POST["id"];

                /*echo $nome;
                echo $cpf;
                echo $cargo;
                echo $id;*/
                $campos = "nome = :nome, descricao = :descricao, responsavel = :responsavel";
                $dados = array('nome'=>$nome, 'descricao'=>$descricao, 'responsavel'=>$responsavel,'id'=>$id);
                $result = $projeto->atualizar($campos, $dados);       

                if($result){
                    header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=sucesso");
                }else{
                    header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
                }    
            }else{
                header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
            }
            
        }elseif($acao=="excluir"){
            /*echo "estou aqui";
            exit;
            if(isset($_GET["id"]) && !empty($_GET["id"])){
                $id = $_GET["id"];
                $result = $colaborador->deletar($id);      

                if($result){
                    header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");
                }else{
                    header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
                }    
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
            }*/
            
        }else{
            echo "Em construção";
        }

        
    }else{
        header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
    }
}else{
    if(isset($_GET["acao"]) && isset($_GET["id"]) && !empty($_GET["acao"]) && !empty($_GET["id"])){
        $acao = $_GET["acao"];
        $id = $_GET["id"];

        if($acao == "excluir"){
            $result = $projeto->deletar($id);      
            if($result){
                header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=sucesso");
            }else{
                header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
            } 
        }
    }else{
        header("Location: ./index.php?pagina=projeto.php&acao=listar&mensagem=erro");
    }
}
?>