<?php

class Conexao{


    // Metodo
    public static function LigarConexao(){

        // Dados de conexão com o banco de dados
        $host       = 'smpsistema.com.br';        // Host do banco de dados (localhost)
        $dbname     = 'u283879542_ti22_vitor';        // Nome do banco de dados   
        $username   = 'u283879542_ti22_vitor';      // Nome de usuário do banco de dados (root)
        $password   = 'Senac@ti22';           // Senha do banco de dados ('')

        try {
            // Cria uma nova instância de PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            
            // Define o modo de erro para exceções
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Realiza operações no banco de dados...
            return $pdo;
            
        } catch (PDOException $e) {
            // Se ocorrer um erro, captura a exceção e exibe uma mensagem de erro
            echo "Erro de conexão: " . $e->getMessage();
        }

    }


}