<?php 
class Mysql{
    // Declaração da propriedade estática $pdo
    private static $pdo;

    // Declaração da função estática 'conectar'
    public  static function conectar(){
        
        // Verificação para evitar a criação de múltiplas conexões com o banco de dados
        if (!isset(self::$pdo)) {
            // Início da estrutura de controle de exceções 'try'
            try{
                // Atribuição de uma nova instância da classe PDO para a propriedade estática $pdo
                self::$pdo = new PDO('mysql:host=' .HOST. '; dbname=' .DATABASE, USER, PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));

                // Definição do comportamento de erro da conexão com o banco de dados
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Captura de uma possível exceção lançada durante a tentativa de conexão com o banco de dados
            } catch(Exception $e){
                // Exibição de uma mensagem de erro em caso de falha na conexão
                echo 'erro ao conectar';
            }
        }
        // Retorna a propriedade estática $pdo
        return self::$pdo;
    }
}

?>