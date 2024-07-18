<?php

require_once('Conexao.php');

class ClassBanner{

    // ATRIBUTOS 
    public $idBanner;
    public $nomeBanner;
    public $caminhoBanner;
    public $altBanner ;
    public $statusBanner;

    // LISTAR
    public function Listar(){
        $sql = "SELECT * FROM tbl_banner WHERE statusBanner = 'ATIVO' ORDER BY nomeBanner DESC;";

        $conn = Conexao::LigarConexao();

        $resultado = $conn->query($sql);

        $lista = $resultado->fetchAll();

        return $lista;

    }

    //CARREGAR
    public function Carregar(){

        $sql = "SELECT * FROM tbl_banner ORDER BY nomeBanner DESC;= $this->idBanner";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);
        $Banner = $resultado->fetch();

        $this->idBanner         =$Banner['idBanner'];
        $this->nomeBanner       =$Banner['nomeBanner'];
        $this->caminhoBanner    =$Banner['caminhoBanner'];
        $this->altBanner        =$Banner['enderecoBanner'];
        $this->statusBanner     =$Banner['statusBanner'];
    }

    //INSERIR
    public function Inserir(){

        $sql = "INSERT INTO tbl_banner (nomeBanner, 
                                        caminhoBanner,
                                        altBanner, 
                                        statusBanner) 
                        VALUES ('". $this->nomeBanner ."',
                                '". $this->caminhoBanner ."',
                                '". $this->altBanner ."',
                                '". $this->statusBanner ."')";

                                
        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location'index.php?p=banner'</script>";
    }

    //ATUALIZAR
    public function Atualizar(){

        $sql = "UPDATE tbl_banner SET  nomeBanner      = '".$this->nomeBanner."',
                                       caminhoBanner = '".$this->caminhoBanner."',
                                       altBanner = '".$this->altBanner."',
                                       statusBanner = '".$this->statusBanner."'
  
                WHERE idBanner = $this->idBanner" ;

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);

        echo "<script>document.location='index.php?bn=banner'</script>";

    }

    //DESATIVAR
    public function Desativar($id){
        $sql = "UPDATE tbl_banner SET statusBanner = 'INATIVO' WHERE idBanner = $id";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        echo"<script> document.location='index.php?bn=banner' </script>";
    }

}