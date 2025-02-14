<?php

class Conexao{


    // Metodo
    public static function LigarConexao(){

        $host       = 'localhost';       // Host do banco de dados (localhost)
        $dbname     = 'db_topGlass';   // Nome do banco de dados
        $username   = 'root';            // Nome de usuário do banco de dados (padrão para MySQL é 'root')
        $password   = '';                // Senha do banco de dados (padrão para MySQL é '')

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