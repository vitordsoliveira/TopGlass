<?php

require_once('Conexao.php');

class ClassCliente{

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
        $sql = "SELECT 
        idCliente,
        nomeCliente,
        emailCliente,
        enderecoCliente,
        numeroCliente,
        cpfCliente,
        DATE_FORMAT(dataCadCliente, '%d/%m/%Y') AS dataCadCliente,
        statusCliente,
        senhaCliente
    FROM 
        tbl_cliente
        WHERE
        statusCliente = 'ATIVO'
    ORDER BY 
        dataCadCliente DESC;";

        $conn = Conexao::LigarConexao();

        $resultado = $conn->query($sql);

        $lista = $resultado->fetchAll();

        return $lista;

    }

    //CARREGAR
    public function Carregar(){

        $sql = "SELECT * FROM tbl_cliente WHERE idCliente = $this->idCliente";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $cliente = $resultado->fetch();

        $this->idCliente        =$cliente['idCliente'];
        $this->nomeCliente      =$cliente['nomeCliente'];
        $this->enderecoCliente  =$cliente['enderecoCliente'];
        $this->telefoneCliente  =$cliente['telefoneCliente'];
        $this->emailCliente     =$cliente['emailCliente'];
        $this->statusCliente    =$cliente['statusCliente'];
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

    //ATUALIZAR
    public function Atualizar(){

        $sql = "UPDATE tbl_cliente SET nomeCliente      = '".$this->nomeCliente."',
                                       enderecoCliente = '".$this->enderecoCliente."',
                                       telefoneCliente = '".$this->numeroCliente."',
                                       emailCliente = '".$this->emailCliente."',
                                       nomeCliente = '".$this->nomeCliente."',
                                       statusCliente = '".$this->statusCliente."'
                WHERE idCliente = $this->idCliente"   ;

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);

        echo "<script>document.location='index.php?p=cliente'</script>";

    }

    //DESATIVAR
    public function Desativar($id){
        $sql = "update tbl_cliente set statusCliente = 'INATIVO' where idCliente = $id";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        echo"<script> document.location='index.php?p=cliente' </script>";
    }

}