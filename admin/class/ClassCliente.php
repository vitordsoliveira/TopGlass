<?php

require_once('Conexao.php');

class classCliente{

    // ATRIBUTOS 
    public $idCliente;
    public $nomeCliente;
    public $emailCliente;
    public $numeroCliente ;
    public $enderecoCliente;
    public $dataCadCliente;
    public $cpfCliente;
    public $statusCliente;

    // LISTAR
    public function Listar(){
        $sql = "SELECT * FROM tbl_cliente ORDER BY nomeCliente ASC";

        $conn = Conexao::LigarConexao();

        $resultado = $conn->query($sql);

        $lista = $resultado->fetchAll();

        return $lista;

    }


    //INSERIR
    public function Inserir(){

        $sql = "INSERT INTO tbl_cliente (nomeCliente, 
                                        emailCliente,
                                        enderecoCliente, 
                                        numeroCliente, 
                                        cpfCliente, 
                                        dataCadCliente, 
                                        statusCliente) 
                        VALUES ('". $this->nomeCliente ."',
                                '". $this->emailCliente ."',
                                '". $this->enderecoCliente ."',
                                '". $this->numeroCliente ."',
                                '". $this->cpfCliente ."' 
                                '". $this->dataCadCliente ."' 
                                '". $this->statusCliente ."' )";

                                
        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location'index.php?p=cliente'</script>";
    }
}