<?php

require_once ('Conexao.php');

class ClassServico
{
    // ATRIBUTOS 
    public $idServico;
    public $nomeServicos;
    public $statusServicos;
    public $idTipoServico;
    public $descServico;
    public $fotoServicos;
    public $altServicos;

    // CONSTRUTOR
    public function __construct($id = false)
    {
        if ($id) {
            $this->idServico = $id;
            $this->Carregar();
        }
    }

    // LISTAR
    public function Listar($statusFiltro = '', $tipoFiltro = '')
    {
        // Define o filtro padrão para mostrar apenas serviços ativos
        $statusFiltro = $statusFiltro ?: 'ATIVO';
        
        $sql = "SELECT 
                    tbl_servico.idServico,
                    tbl_servico.nomeServicos,
                    tbl_servico.statusServicos,
                    tbl_tipo_servico.tipoServico AS idTipoServico,
                    tbl_servico.descServico,
                    tbl_servico.fotoServicos,
                    tbl_servico.altServicos
                FROM 
                    tbl_servico
                INNER JOIN 
                    tbl_tipo_servico
                ON 
                    tbl_servico.idTipoServico = tbl_tipo_servico.idTipoServico
                WHERE 
                    tbl_servico.statusServicos = :status";

        // Aplica filtro de tipo, se fornecido
        if ($tipoFiltro) {
            $sql .= " AND tbl_tipo_servico.tipoServico IN ($tipoFiltro)";
        }

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $statusFiltro, PDO::PARAM_STR);

        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function ListarTodos($statusFiltro = '', $tipoFiltro = '')
    {
        $sql = "SELECT 
                    tbl_servico.idServico,
                    tbl_servico.nomeServicos,
                    tbl_servico.statusServicos,
                    tbl_tipo_servico.tipoServico AS idTipoServico,
                    tbl_servico.descServico,
                    tbl_servico.fotoServicos,
                    tbl_servico.altServicos
                FROM 
                    tbl_servico
                INNER JOIN 
                    tbl_tipo_servico
                ON 
                    tbl_servico.idTipoServico = tbl_tipo_servico.idTipoServico
                WHERE 1=1";

        // Aplica filtro de status, se fornecido
        if ($statusFiltro) {
            $sql .= " AND tbl_servico.statusServicos = :status";
        }

        // Aplica filtro de tipo, se fornecido
        if ($tipoFiltro) {
            $tipoFiltrosArray = [];
            $tipos = explode(',', $tipoFiltro);
            $placeholders = [];
            foreach ($tipos as $key => $tipo) {
                $placeholders[] = ":tipo{$key}";
                $tipoFiltrosArray[":tipo{$key}"] = $tipo;
            }
            $sql .= " AND tbl_tipo_servico.tipoServico IN (" . implode(',', $placeholders) . ")";
        }

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);

        // Vincula o parâmetro de status, se fornecido
        if ($statusFiltro) {
            $stmt->bindParam(':status', $statusFiltro, PDO::PARAM_STR);
        }

        foreach ($tipoFiltrosArray as $placeholder => $value) {
            $stmt->bindParam($placeholder, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function ListarAtivo()
    {
        $sql = "SELECT 
                    tbl_servico.idServico,
                    tbl_servico.nomeServicos,
                    tbl_servico.statusServicos,
                    tbl_tipo_servico.tipoServico AS idTipoServico,
                    tbl_servico.descServico,
                    tbl_servico.fotoServicos,
                    tbl_servico.altServicos
                FROM 
                    tbl_servico
                INNER JOIN 
                    tbl_tipo_servico
                ON 
                    tbl_servico.idTipoServico = tbl_tipo_servico.idTipoServico
                WHERE 
                    tbl_servico.statusServicos = 'ATIVO'
                    AND tbl_tipo_servico.tipoServico IN ('VIDRO', 'ESPELHO')";
    
        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $lista;
    }

    public function ListarAtivoAluminio()
    {
        $sql = "SELECT 
                tbl_servico.idServico,
                tbl_servico.nomeServicos,
                tbl_servico.statusServicos,
                tbl_tipo_servico.tipoServico AS idTipoServico,
                tbl_servico.descServico,
                tbl_servico.fotoServicos,
                tbl_servico.altServicos
            FROM 
                tbl_servico
            INNER JOIN 
                tbl_tipo_servico
            ON 
                tbl_servico.idTipoServico = tbl_tipo_servico.idTipoServico
            WHERE 
                tbl_servico.statusServicos = 'ATIVO'
                AND tbl_tipo_servico.tipoServico = 'ALUMINIO'"; // Adicione esta linha

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    public function ListarFiltro($statusFiltro = '', $tipoFiltro = '')
    {
        $sql = "SELECT 
                tbl_servico.idServico,
                tbl_servico.nomeServicos,
                tbl_servico.statusServicos,
                tbl_tipo_servico.tipoServico AS idTipoServico,
                tbl_servico.descServico,
                tbl_servico.fotoServicos,
                tbl_servico.altServicos
            FROM 
                tbl_servico
            INNER JOIN 
                tbl_tipo_servico
            ON 
                tbl_servico.idTipoServico = tbl_tipo_servico.idTipoServico
            WHERE 
                1=1"; // Adicionado para facilitar a construção dinâmica da query

        if ($statusFiltro) {
            $sql .= " AND tbl_servico.statusServicos = :status";
        }

        $tipoFiltrosArray = [];
        if ($tipoFiltro) {
            $tipos = explode(',', $tipoFiltro);
            $placeholders = [];
            foreach ($tipos as $key => $tipo) {
                $placeholders[] = ":tipo{$key}";
                $tipoFiltrosArray[":tipo{$key}"] = $tipo;
            }
            $sql .= " AND tbl_tipo_servico.tipoServico IN (" . implode(',', $placeholders) . ")";
        }

        $conn = Conexao::LigarConexao();
        $stmt = $conn->prepare($sql);

        if ($statusFiltro) {
            $stmt->bindParam(':status', $statusFiltro, PDO::PARAM_STR);
        }

        foreach ($tipoFiltrosArray as $placeholder => $value) {
            $stmt->bindParam($placeholder, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lista;
    }

    // CARREGAR
    public function Carregar()
    {
        $conn = Conexao::LigarConexao();
        $sql = "SELECT * FROM tbl_servico WHERE idServico = :idServico";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idServico', $this->idServico, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->nomeServicos = $result['nomeServicos'];
            $this->statusServicos = $result['statusServicos'];
            $this->idTipoServico = $result['idTipoServico'];
            $this->descServico = $result['descServico'];
            $this->fotoServicos = $result['fotoServicos'];
            $this->altServicos = $result['altServicos'];
            return true;
        } else {
            return false;
        }
    }

    // INSERIR
    public function Inserir()
    {
        $sql = "INSERT INTO tbl_servico (
                    nomeServicos, 
                    statusServicos,
                    idTipoServico, 
                    descServico,
                    fotoServicos,
                    altServicos
                ) VALUES (
                    '" . $this->nomeServicos . "',
                    '" . $this->statusServicos . "',
                    '" . $this->idTipoServico . "',
                    '" . $this->descServico . "',
                    '" . $this->fotoServicos . "',
                    '" . $this->altServicos . "'
                )";

        $connect = Conexao::LigarConexao();
        $connect->exec($sql);

        echo "<script>document.location='index.php?p=servico'</script>";
    }

    // ATUALIZAR
    public function Atualizar()
    {
        $sql = "UPDATE tbl_servico SET  
                    nomeServicos = '" . $this->nomeServicos . "',
                    statusServicos = '" . $this->statusServicos . "',
                    idTipoServico = '" . $this->idTipoServico . "',
                    descServico = '" . $this->descServico . "',
                    fotoServicos = '" . $this->fotoServicos . "',
                    altServicos = '" . $this->altServicos . "'
                WHERE idServico = $this->idServico";

        $conn = Conexao::LigarConexao();
        $conn->exec($sql);
        echo "<script>document.location='index.php?p=servico'</script>";
    }

    // DESATIVAR
    public function Desativar($id)
    {
        $sql = "UPDATE tbl_servico SET statusServicos = 'INATIVO' WHERE idServico = $id";
        $conn = Conexao::LigarConexao();
        $resultado = $conn->query($sql);

        echo "<script>document.location='index.php?p=servico'</script>";
    }
}
