<?php
if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $servico = Painel::serviceSelect('tb_admin_servicos', 'id =?', array($id) );
            //  neste codigo acima usando a função estou pegando os  parametro definindo dentro da função serviceSelect.
            // podendo ser encontrada na classe Painel. 
        
    }else{
        Painel::alert('erro', 'O parametro id não foi selecionado');
        die(); 
    }
?>

<div class="box-content">
    <h2><i class="fa-solid fa-file-pen"></i> Editar Serviços</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
    if (isset($_POST['acao'])) {
        if(Painel::updateService($_POST)){

            Painel::alert('sucesso', 'Serviço editado com sucesso ');
            $servico = Painel::serviceSelect('tb_admin_servicos', 'id =?', array($id) );
        }else{
            Painel::alert('erro',  'Campos vazios não são permitidos'); 
        }


    }

        ?>

        <div class="form-group  ">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $servico['nome'];  ?>">


        </div><!-- form-group -->


        <div class="form-group  ">
            <label>Serviço:

            </label>
            <textarea name="servico"><?php echo $servico['servico']; ?></textarea>


        </div><!-- form-group -->


        <div class="form-group  ">
            <label>Data:</label>
            <input formato="data" type="text" name="data" value="<?php echo $servico['data']; ?>">


        </div><!-- form-group -->




        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id;  ?>">
            <input type="hidden" name="nome_tabela" value="tb_admin_servicos">
            <input type="submit" name="acao" value="Atualizar">

        </div><!-- form-group -->

        <div class="clear"></div>
    </form>


</div><!-- box-content -->