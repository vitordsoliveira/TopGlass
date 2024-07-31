<?php

require_once('Conexao.php');

class ClassContato{

    // ATRIBUTOS 
    public $idContato;
    public $nomeContato;
    public $emailContato;
    public $telefoneContato;
    public $mensagemContato;
    public $statusContato;
    public $dataContato;
    public $horaContato;


    // LISTAR
    public function Listar(){
        $sql = "select * from tbl_contato where statusContato = 'ativo' Order By dataContato Desc";

        $conn = Conexao::LigarConexao();

        $resultado = $conn->query($sql);

        $lista = $resultado->fetchAll();

        return $lista;

    }


    //INSERIR
    public function Inserir(){

        $sql = "INSERT INTO tbl_contato (nomeContato, 
                                         emailContato,
                                         telefoneContato,
                                         mensagemContato,
                                         statusContato) 
                        VALUES ('". $this->nomeContato ."',
                                '". $this->emailContato ."',
                                '". $this->telefoneContato ."',
                                '". $this->mensagemContato ."',
                                '". $this->statusContato ."' )";

        


    }




}