<?php

require_once ('Conexao.php');

class ClassBanner
{

    // ATRIBUTOS 
    public $idBanner;
    public $nomeBanner;
    public $caminhoBanner;
    public $altBanner;
    public $statusBanner;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idBanner = $id;
            $this->Carregar();
        }
    }

    public function Listar()
    {

        $sql = "SELECT * FROM tbl_banner WHERE statusBanner = 'ATIVO';";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->query($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;

    }

    public function ListarDash()
    {
        $sql = "SELECT * FROM tbl_banner 
ORDER BY 
    CASE 
        WHEN statusBanner = 'ATIVO' THEN 1 
        WHEN statusBanner = 'INATIVO' THEN 2 
        WHEN statusBanner = 'DESATIVADO' THEN 3 
        ELSE 4 
    END;";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->query($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    //CARREGAR
    public function Carregar()
    {
        $conn = Conexao::LigarConexao();
        $sql = "SELECT * FROM tbl_banner WHERE idBanner = :idBanner";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idBanner', $this->idBanner, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $Banner = $stmt->fetch();
            if ($Banner) {
                $this->idBanner = $Banner['idBanner'];
                $this->nomeBanner = $Banner['nomeBanner'];
                $this->caminhoBanner = $Banner['caminhoBanner'];
                $this->altBanner = $Banner['altBanner'];
                $this->statusBanner = $Banner['statusBanner'];
                return true;
            }
        }
    }

    //INSERIR
    public function Inserir()
    {

        $sql = "INSERT INTO tbl_banner (nomeBanner, 
                                        caminhoBanner,
                                        altBanner, 
                                        statusBanner) 
                        VALUES ('" . $this->nomeBanner . "',
                                '" . $this->caminhoBanner . "',
                                '" . $this->altBanner . "',
                                '" . $this->statusBanner . "')";


        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location'index.php?p=banner'</script>";
    }

    //ATUALIZAR
    public function Atualizar()
    {
        $sql = " UPDATE tbl_banner SET  
                                       nomeBanner      = '" . $this->nomeBanner . "',
                                       caminhoBanner = '" . $this->caminhoBanner . "',
                                       altBanner = '" . $this->altBanner . "',
                                       statusBanner = '" . $this->statusBanner . "'
  
                WHERE idBanner = $this->idBanner";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);
        echo "<script>document.location='index.php?bn=banner'</script>";
    }

    //DESATIVAR
    public function Desativar($id)
    {
        $sql = "UPDATE tbl_banner SET statusBanner = 'INATIVO' WHERE idBanner = $id";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        echo "<script> document.location='index.php?p=banner' </script>";
    }

}