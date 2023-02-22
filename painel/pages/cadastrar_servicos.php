
<div class="box-content">
    <h2><i class="fa-solid fa-file-circle-plus"></i>  Adicionar Serviços</h2>

    <form method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST['acao'])) {

            if (Painel::insert($_POST)) {

                Painel::alert('sucesso', 'Serviço cadastrado com sucesso ');
                
            }else{
                Painel::alert('erro', 'Por favor coloque um serviço' );
            }
        

            }





        

        ?>

        <div class="form-group  ">
            <label>Nome:</label>
            <input type="text" name="nome">


        </div><!-- form-group -->


        <div class="form-group  ">
            <label>Serviço:

            </label>
            <textarea name="servico"></textarea>


        </div><!-- form-group -->

        
        <div class="form-group  ">
            <label>Data:</label>
            <input formato = "data" type="text" name="data">


        </div><!-- form-group -->

        


        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_admin_servicos">
            <input type="submit" name="acao" value="Enviar">

        </div><!-- form-group -->

        <div class="clear"></div>
    </form>


</div><!-- box-content -->