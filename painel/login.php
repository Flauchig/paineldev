<?php 
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];

          // Preparação da consulta SQL para verificar se existe um registro no banco de dados com as informações de login informadas
          $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin_usuarios` WHERE user = ? AND password = ?");

          // Execução da consulta com as informações de login
          $sql->execute(array($user, $password));

        //   aqui to buscando os valores no banco fazendo uma validação dupla  para ver se o usuário relamente existe para aplicar os cookies 
        if($sql->rowCount() == 1){

            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['img'] = $info['img'];

            header('location:' . INCLUDE_PATH_PAINEL);
            die();



        }

    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL ?>css/style.css">
    <link href=" <?php echo INCLUDE_PATH; ?>estilo/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel de Controle</title>
</head>

<body>
    <div class="box-login">
        <?php
        // Verifica se a variável $_POST['acao'] existe
        if (isset($_POST['acao'])) {
            // Atribuição dos valores enviados pelo formulário para as variáveis $user e $password
            $user = $_POST['user'];
            $password = $_POST['password'];

            // Preparação da consulta SQL para verificar se existe um registro no banco de dados com as informações de login informadas
            $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin_usuarios` WHERE user = ? AND password = ?");

            // Execução da consulta com as informações de login
            $sql->execute(array($user, $password));

            // Verificação se a consulta retornou um registro
            if ($sql->rowCount() == 1) {
                // Criação das variáveis de sessão com as informações de login
                $info = $sql->fetch();
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
                if(isset($_POST['lembrar'])){
                    setcookie('lembrar',true, time()+(60*60*24), '/');
                    setcookie('user', $user, time()+(60*60*24), '/' );
                    setcookie('password', $password, time()+(60*60*24), '/' );
                    // aqui faz com que o  ao usar o lembrar-me vai durar um dia o cookie 

                }

                // Redirecionamento para uma página específica após o login bem-sucedido
                header('location:' . INCLUDE_PATH_PAINEL);
                die();
            } else {
                // Exibição de uma mensagem de erro em caso de falha no login
                echo '<div class="erro-box"> <i class ="fa fa-xmark"> </i>  Usuário ou Senha incorretos! </div>';
            }
        }
        ?>
        <div class="logo-login">
            <img src="imagens/logomarca1.png">
        </div>

        <form method="post">
            <input type="Text" name="user" placeholder="Login..." required>
            <input type="Password" name="password" placeholder="senha..." required>

            <div class="form-group-login">
                    <input type="submit" name="acao" value="Logar">

            </div>


            <div class="form-group-login w50 ">
                    <label>  Lembrar-me </label>
                    <input type="checkbox" name="lembrar">
                    
            </div>




        </form>
        <div class="clear"></div>

    </div>
    <!-- box-login -->

</body>

</html>