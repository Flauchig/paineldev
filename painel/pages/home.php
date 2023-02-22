<?php
$usuarionsOnline = Painel::mostrarOnline();

$pegarVistas = Mysql::conectar()->prepare("SELECT * FROM tb_admin_visitas");
$pegarVistas->execute();
$pegarVistas = $pegarVistas->rowCount();

$pegarVistasHoje = Mysql::conectar()->prepare("SELECT * FROM tb_admin_visitas WHERE dia = ? ");
$pegarVistasHoje->execute(array(date('Y-m-d')));
$pegarVistasHoje = $pegarVistasHoje->rowCount();


?>

<div class="box-content w100">
    <h2><i class="fa  fa-home" style= " font-size: 25px;"></i> Painel de Controle - Dev Vasconcellos </h2>
    <div class=" box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Usuários online </h2>
                <p>
                    <?php echo count($usuarionsOnline); ?>
                </p>

            </div><!-- box-metrica-warpper -->

        </div><!-- box-metrica-single -->

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Total de Visitas </h2>
                <p>
                    <?php echo $pegarVistas; ?>
                </p>


            </div><!-- box-metrica-warpper -->

        </div><!-- box-metrica-single -->

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Visitas hoje</h2>
                <p>
                    <?php echo $pegarVistasHoje; ?>
                </p>

            </div><!-- box-metrica-warpper -->

        </div><!-- box-metrica-single -->



    </div><!-- box-metricas -->


    <div class="clear"></div><!-- clear -->


</div><!-- box-content -->

<div class="box-content w100">
    <h2><i class="fa-solid fa-globe" "></i> Usuários Online </h2>
    <div class=" table-responsive">
            <div class="row">
                <div class="col">
                    <span style="font-weight: bold; font-size: 25px;">
                        <i class="fa-solid fa-clipboard-user" style="font-size: 30px;"></i> IP</span>
                </div><!-- COL -->
                <div class="col">
                    <span style="font-weight: bold; font-size: 25px;" ,>


                        <i class="fa-solid fa-location-dot"></i> Ultima Ação </span>
                </div><!-- COL -->
                <div class="clear"></div>

            </div><!-- row -->
            <?php foreach ($usuarionsOnline as $key => $value) {

                ?>
                <div class="row">
                    <div class="col">
                        <span>
                            <?php echo $value['ip']; ?>
                        </span>
                    </div><!-- COL -->
                    <div class="col">
                        <!-- Este código exibe a data formatada no formato "Ano-Mês-Dia Hora:Minuto:Segundo" -->
                        <span>
                            <!-- A função date() é utilizada para formatar a data -->
                            <?php
                            // A função strtotime() é utilizada para converter a string da data em timestamp
                            echo date("d-m-Y H:i:s", strtotime($value['ultima_acao']));
                            ?>
                        </span>
                    </div><!-- COL -->
                    <div class="clear"></div>

                </div><!-- row -->
            <?php } ?>
</div><!-- table-responsive -->

</div>
<!-- box-content -->


<div class="box-content w100">
    <h2><i class="fa-sharp fa-solid fa-person"></i> Lista de Usuários </h2>
    <div class=" table-responsive">
            <div class="row">
                <div class="col">
                    <span style="font-weight: bold; font-size: 25px;">
                        <i class="fa-solid fa-clipboard-user" style="font-size: 30px;"></i> Nome:</span>
                </div><!-- COL -->
                <div class="col">
                    <span style="font-weight: bold; font-size: 25px;" ,>


                        <i class="fa-solid fa-briefcase"></i> Cargo </span>
                </div><!-- COL -->
                <div class="clear"></div>

            </div><!-- row -->
            <?php 
            $usuarionsPainel = Mysql::conectar()->prepare("SELECT * FROM tb_admin_usuarios");
            $usuarionsPainel->execute();

            
            foreach ($usuarionsPainel as $key => $value) {

                // nesta linha abaixo eu estou buscando os usuários cadastrados na  no sistema e seus respectivos cargos. 

                ?>
                <div class="row">
                    <div class="col">
                        <span>
                            <?php echo $value['user']; ?>
                        </span>
                    </div><!-- COL -->
                    <div class="col">

                        <span>
                            <?php
                            echo pegaCargo($value['cargo']);

                            ?>
                        </span>
                    </div><!-- COL -->
                    <div class="clear"></div>

                </div><!-- row -->

            <?php } ?>
</div><!-- table-responsive -->

</div>
<!-- box-content -->