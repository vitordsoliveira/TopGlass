<?php

require_once ('Conexao.php');

class ClassGaleria
{

    // ATRIBUTOS 
    public $idGaleria;
    public $nomeGaleria;
    public $caminhoGaleria;
    public $altGaleria;
    public $statusGaleria;

    public function __construct($id = false)
    {
        if ($id) {
            $this->idGaleria = $id;
            $this->Carregar();
        }
    }

    public function Listar()
    {
        $sql = "SELECT * FROM tbl_galeria WHERE statusGaleria = 'ATIVO'";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->query($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function ListarDash()
    {
        $sql = "    SELECT * FROM tbl_galeria
                    WHERE statusGaleria = 'ATIVO'
                    OR statusGaleria = 'INATIVO'; ";
        $conn = Conexao::LigarConexao();
        $stmt = $conn->query($sql);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    //CARREGAR
    public function Carregar()
    {
        $conn = Conexao::LigarConexao();
        $sql = "SELECT * FROM tbl_galeria WHERE idGaleria = :idGaleria WHERE statusGaleria = 'ATIVO'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idGaleria', $this->idGaleria, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $galeria = $stmt->fetch();
            if ($galeria) {
                $this->idGaleria = $galeria['idGaleria'];
                $this->nomeGaleria = $galeria['nomeGaleria'];
                $this->caminhoGaleria = $galeria['caminhoGaleria'];
                $this->altGaleria = $galeria['altGaleria'];
                $this->statusGaleria = $galeria['statusGaleria'];
                return true;
            }
        }
    }

    //INSERIR
    public function Inserir()
    {

        $sql = "INSERT INTO tbl_galeria (nomeGaleria, 
                                        caminhoGaleria,
                                        altGaleria, 
                                        statusGaleria) 
                        VALUES ('" . $this->nomeGaleria . "',
                                '" . $this->caminhoGaleria . "',
                                '" . $this->altGaleria . "',
                                '" . $this->statusGaleria . "')";


        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location'index.php?p=galeria'</script>";
    }

    //ATUALIZAR
    public function Atualizar()
    {
        $sql = " UPDATE tbl_galeria SET  
                                       nomeGaleria      = '" . $this->nomeGaleria . "',
                                       caminhoGaleria = '" . $this->caminhoGaleria . "',
                                       altGaleria = '" . $this->altGaleria . "',
                                       statusGaleria = '" . $this->statusGaleria . "'
  
                WHERE idGaleria = $this->idGaleria";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);
        echo "<script>document.location='index.php?gl=galeria'</script>";
    }

    //DESATIVAR
    public function Desativar($id)
    {
        $sql = "UPDATE tbl_galeria SET statusGaleria = 'INATIVO' WHERE idGaleria = $id";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        echo "<script> document.location='index.php?p=galeria' </script>";
    }

}