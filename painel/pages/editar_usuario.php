<div class="box-content">
    <h2><i class="fa-solid fa-user-pen"></i> Editar Usuário</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST['acao'])) {
            //envei meu formulario 

            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $usuario = new Usuario();

            if ($imagem['name'] != '') {
                if (Painel::imagemValida($imagem)) {
                    // aqui estou chamando as duas classes estativas para validar a imagem 
                    Painel::deleteFile($imagem_atual);
                    
                    $imagem = Painel::uploadFile($imagem);
                    
                    if ($usuario->atualizarUsuario($nome, $senha, $imagem)) {
                        $_SESSION['img'] = $imagem;
                        $_SESSION['nome'] = $nome;
                        // aqui para quando atualizar a pagina ela trocar a imagem  e o nome do usuário 
                        Painel::alert('sucesso', 'Alteração Realizada com sucesso. Por favor atualize a Pagina ');
                    } else {
                        Painel::alert('erro', 'Erro ao Atualizar... !!!!!');
                    }
                }else{
                    Painel::alert('erro', 'Este Não é um Formato de Imagem... !!!!!');
                    // erro gerado caso não usem um formato de imagem

                }
            } else {
                $imagem = $imagem_atual;
               
                if ($usuario->atualizarUsuario($nome, $senha, $imagem)) {
                    Painel::alert('sucesso', 'Alteração Realizada com sucesso Por favor atualize a Pagina ');
                } else {
                    Painel::alert('erro', 'Erro ao Atualizar... !!!!!');
                }
            }
        }

        ?>




        <div class="form-group  ">
            <label>Nome:</label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">


        </div><!-- form-group -->

        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="password" class="senha" required value="<?php echo $_SESSION['password']; ?>">


        </div><!-- form-group -->




        <div class="form-group ">
            <label class="selecionar_img"><i class="fa-solid fa-image"></i> Imagem</label>

            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">


        </div><!-- form-group -->


        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">




        </div><!-- form-group -->

        <div class="clear"></div>
    </form>




</div><!-- box-content -->