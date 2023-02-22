<?php

class Online
{
    public static function userOnline()
    {
        // Verifica se a sessão 'online' já foi definida
        if (isset($_SESSION['online'])) {
            $token = $_SESSION['online'];
            $horarioAtual = date('Y-m-d H:i:s');
            
            /* Verifica se há um usuário com o token atual na tabela 
            tb_admin_online */
            $check = Mysql::conectar()->prepare("SELECT id FROM tb_admin_online WHERE token = ? ");
            $check->execute(array($token));

            // Se houver um usuário, atualiza sua última ação
            if ($check->rowCount() == 1) {

                $sql = Mysql::conectar()->prepare(" UPDATE tb_admin_online SET  ultima_acao = ? WHERE token = ? ");
                $sql->execute(array($horarioAtual, $token));
            } 
            // Se não houver, adiciona um novo usuário
            else {
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $horarioAtual = date('Y-m-d H:i:s');
                $sql = Mysql::conectar()->prepare(" INSERT INTO tb_admin_online VALUES(null,?,?,?) ");
                $sql->execute(array($ip, $horarioAtual, $token));
            }
        } 
        // Se a sessão 'online' não estiver definida, cria uma nova
        else {
            $_SESSION['online'] = uniqid();
            // declarar a session aintes de atribuir um valor 
            $ip = $_SERVER['REMOTE_ADDR'];
            $token = $_SESSION['online'];
            $horarioAtual = date('Y-m-d H:i:s');
            $sql = Mysql::conectar()->prepare(" INSERT INTO tb_admin_online VALUES(null,?,?,?) ");
            $sql->execute(array($ip, $horarioAtual, $token));
        }
    }

public static function contador() {
   

    // Verifica se o cookie 'visitas' foi recém-criado
    if (!isset($_COOKIE['visitas'])) {
        // Cria o cookie 'visitas' com o valor 'true' e a validade de 7 dias
        setcookie('visitas', true, time() + (60 * 60 * 24 * 7));

        // Conecta ao banco de dados e prepara a consulta para inserir uma nova entrada
        $sql = Mysql::conectar()->prepare("INSERT INTO tb_admin_visitas VALUES (null, ?,?)");
        $sql->execute(array($_SERVER['REMOTE_ADDR'], date('Y-m-d')));
    }
}
}

?>