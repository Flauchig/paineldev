<?php
verificaPermissaoPagina(2);



?>
<div class="box-content">
    <h2><i class="fa-solid fa-user-plus"></i> Adicionar Usuário</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST['acao'])) {
            $login  = $_POST['login'];
            $senha = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $nome = $_POST['nome'];
            $cargo = $_POST['cargo'];

            if ($login == '') {
                Painel::alert('erro', 'O login esta vazio!!');
            } elseif ($nome == '') {
                Painel::alert('erro', 'É preciso colocar um nome!!');
            } elseif ($senha == '') {
                Painel::alert('erro', 'É preciso colocar uma senha!!');
            } elseif ($cargo) {
                Painel::alert('erro', 'Por favor selecione um cargo!!');
            } elseif ($imagem == '') {
                Painel::alert('erro', 'Por favor coloque uma Imagem!! ');
            }

            if ($cargo >= $_SESSION['cargo']) {
                Painel::alert('erro', 'Você pode Cadastrar apenas cargos menores que o seu !! ');
            } elseif (Painel::imagemValida($imagem) == false) {
                Painel::alert('erro', 'Este formato de imagem não é valido!! ');
            }elseif(Usuario::userExist($login)){
                Painel::alert('erro', 'Este Login ja existe !! ');
            } else{
                $usuario = new Usuario();
                $imagem = Painel::uploadFile($imagem);
                $usuario ->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
                Painel::alert('sucesso', 'Cadastro realizado com sucesso');

            }

            // aqui foi feita uma validação para que gere mensagens pedindo que usuário cadastre todos respectivos campos 




        }


        ?>

        <div class="form-group  ">
            <label>Login:</label>
            <input type="text" name="login">


        </div><!-- form-group -->


        <div class="form-group  ">
            <label>Nome:</label>
            <input type="text" name="nome">

        </div><!-- form-group -->

        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="password" class="senha">

        </div><!-- form-group -->




        <div class="form-group ">
            <label class="selecionar_img"><i class="fa-solid fa-image"></i> Imagem</label>

            <input type="file" name="imagem">

        </div><!-- form-group -->


        <div class="form-group  cargos">
            <label class="titulo-cargos"> Cargo </label>
            <select name="cargo">
                <?php
                foreach (Painel::$cargos as $key => $value) {
                    if ($key < $_SESSION['cargo'])  echo "<option value=\"$key\">$value</option>";
                }



                ?>
            </select>

        </div><!-- form-group -->


        <div class="form-group">
            <input type="submit" name="acao" value="Enviar">

        </div><!-- form-group -->

        <div class="clear"></div>
    </form>


</div><!-- box-content -->