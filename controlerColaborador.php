<?php
include("./Model/Colaborador.php");
$colaborador = new Colaborador();

if(isset($_POST["nome"]) && isset($_POST["cpf"]) && 
isset($_POST["cargo"]) && isset($_POST["acao"])){
    
    if(!empty($_POST["nome"]) && !empty($_POST["cpf"]) && 
    !empty($_POST["cargo"]) && !empty($_POST["acao"])){
      
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $cargo = $_POST["cargo"];
        $acao = $_POST["acao"];

        
        if($acao=="inserir"){
            $campos1 = "nome, cargo, cpf";
            $campos2 = ":nome, :cargo, :cpf";
            
            $dados = array('nome'=>$nome, 'cargo'=>$cargo, 'cpf'=>$cpf);
            $result = $colaborador->cadastrar($campos1, $campos2, $dados);       
    
            if($result){
    
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");
    
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
            }
        }elseif($acao=="editar"){
            if(isset($_POST["id"]) && !empty($_POST["id"])){
                $id = $_POST["id"];

                /*echo $nome;
                echo $cpf;
                echo $cargo;
                echo $id;*/
                $campos = "nome = :nome, cpf = :cpf, cargo = :cargo";
                $dados = array('nome'=>$nome, 'cpf'=>$cpf, 'cargo'=>$cargo,'id'=>$id);
                $result = $colaborador->atualizar($campos, $dados);       

                if($result){
                    header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");
                }else{
                    header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
                }    
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
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
        header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
    }
}else{
    if(isset($_GET["acao"]) && isset($_GET["id"]) && !empty($_GET["acao"]) && !empty($_GET["id"])){
        $acao = $_GET["acao"];
        $id = $_GET["id"];

        if($acao == "excluir"){
            $result = $colaborador->deletar($id);      
            if($result){
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
            } 
        }
    }else{
        header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
    }
}
?>