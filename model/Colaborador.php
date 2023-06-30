<?php
require_once ("Myconnect.php");

class Colaborador extends Myconnect{
    private $campos1, $campos2, $data;
    public $conn;

    public function getCampos1(){
        return $this->campos1;
    }
    public function getCampos2(){
        return $this->campos2;
    }
    public function getdata(){
        return $this->data;
    }

    public function listar(){
        $stmt = $this->conn->prepare("SELECT * FROM colaboradores");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }
    //acrescentei este método para listar nome dos colaboradores nos projetos
    public function listarSelect(){
        $stmt = $this->conn->prepare("SELECT id, nome FROM colaboradores order by nome asc");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function cadastrar($campos1, $campos2, $data){
        $this->campos1 = $campos1;
        $this->campos2 = $campos2;
        $this->data = $data;

        $campos1_poo =  $this->getCampos1();
        $campos2_poo =  $this->getCampos2();
        $data_poo =  $this->getdata();
       
        $sql = "INSERT INTO colaboradores ($campos1_poo) VALUES ($campos2_poo)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data_poo);
        
        if ($stmt->rowCount()) {
           return 1;
        } else {
           return 0;
        }
    }
    public function atualizar($campos, $data){
    
        $sql = "update colaboradores set $campos where id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data);
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }
    public function deletar($id){    
        $sql = "delete from Colaboradores where id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }
    public function carregarColaborador($id){
        $stmt = $this->conn->prepare('SELECT * FROM colaboradores WHERE id = :id');
        $stmt->execute(array('id' => $id));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }
    public function carregarColaboradorGerente(){
        $stmt = $this->conn->prepare('SELECT * FROM colaboradores WHERE cargo = :cargo');
        $stmt->execute(array('cargo' => 'Gerente'));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }
}