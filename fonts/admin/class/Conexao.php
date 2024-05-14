<?php

class Conexao{
    
    //METODO
    public static function LigarConexao()
    {
        // Parâmetros de conexão
        $host = 'localhost'; // Host do banco de dados
        $dbname = 'db_automestre'; // Nome do banco de dados
        $user = 'root'; // Usuário do banco de dados
        $password = ''; // Senha do banco de dados

        try {
            // Cria uma nova conexão PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

            // Configura o PDO para lançar exceções em caso de erros
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "Conexão estabelecida com sucesso!";
            return $pdo;

        } catch (PDOException $e) {
            // Captura e exibe erros de conexão
            echo "Erro ao conectar-se ao banco de dados: " . $e->getMessage();
        }

    }
}