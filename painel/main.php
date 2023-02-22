<?php
if (isset($_GET['loggout'])) {
    Painel::loggout();
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
    <div class="menu ">
        <div class="menu-wrapper ">
            <div class="box-usuario">
                <?php if ($_SESSION['img'] == '') {

                    ?>
                    <div class="avatar-usuario">
                        <i class="fa-solid fa-user"></i>
                    </div><!-- avatar -->
                <?php } else { ?>
                    <div class="imagem-usuario">
                        <img src="<?php echo INCLUDE_PATH_PAINEL ?>./uploads/<?php echo $_SESSION['img']; ?>">
                    </div><!-- imagem-usuario -->
                <?php } ?>
                <div class="nome-usuario">
                    <p>
                        <?php echo $_SESSION['nome']; ?>
                    </p>
                    <p>
                        <?php echo pegaCargo($_SESSION['cargo']); ?>
                    </p>

                </div><!-- nome e cargo  -->
                <div class="itens-menu">
                    <h2>Cadastro</h2>
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_servicos">Cadastrar Serviço</a>
                    <!-- sempre localar a contrabarra -->
                    <h2>Gestao</h2>
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>listar_servicos">Listar Serviço</a>
                    <h2>Configuração do Painel</h2>
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>editar_usuario">Editar Usuário</a>
                    <a <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar_usuario">Adicionar Usuários</a>
                    <h2>Configuração Geral </h2>
                    <a href="">Editar</a>
                </div><!-- itens-menu -->

                        <!-- sempre que incluir o INCLUDE_PATH_PAINEL cuidar os espaçamentos pois vai dar erro -->

    


            </div><!-- box-ususario -->
        </div> <!-- menu-wraper ajuda a esconder o conteudo  -->
    </div><!--menu -->
    <div class="clear"></div>


    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div><!-- menu-btn -->
            <div class="loggout">
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i class="fa fa-home" style = "font-size: 25px"></i><span>  Pagina Inicial</span></a>
                <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout"> <i
                        class="fa-sharp fa-solid fa-arrow-right-from-bracket" style = "font-size: 25px"></i><span> Sair </span> </a>
            </div><!-- loggout -->
            <div class="clear"></div><!-- clear -->
        </div><!-- center -->


    </header>

    <div class="content">

        <?php Painel::carregarPagina();  ?>





    </div> <!-- content -->



    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <!-- esta função de mask do jquery sempre tem que ser declarada depois do jquery  -->
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH ?>js/main.js"></script>

</body>

</html>