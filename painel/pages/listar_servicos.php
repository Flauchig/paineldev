<?php

if(isset($_GET['excluir'])){
    $idExcluir = intval($_GET['excluir']);

    Painel::deleteServico('tb_admin_servicos', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'listar_servicos');

}



$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 5;


$servicos = Painel::selectAll('tb_admin_servicos', ($paginaAtual -1)*$porPagina, $porPagina);


?>

<div class="box-content">
    <h2><i class="fa-sharp fa-regular fa-address-card"></i> Lista de Serviços</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>Serviço</td>
                <td>Data</td>
                <td>.</td>
                <td>.</td>
            </tr>
            <?php
            foreach ($servicos as $key => $value) {



            ?>

                <tr>
                    <td><?php echo $value['nome']; ?></td>
                    <td><?php echo $value['servico']; ?></td>
                    <td><?php echo $value['data'];  ?></td>
                    <td><a class="btn-edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar_servicos?id=<?php echo $value['id']; ?>"><i class="fa-solid fa-pencil"></i> Editar</a></td>
                    <td> <a actionBtn="delete" class="btn-delete" href="<?php echo INCLUDE_PATH_PAINEL?>listar_servicos?excluir=<?php echo $value['id']; ?>"><i class="fa-solid fa-trash"></i></i> Excluir</a></td>
                </tr>

            <?php
            }

            ?>
        </table>

    </div><!-- wraper-table -->

<div class="paginacao">
    <?php
    $totalPaginas = ceil(count(Painel::selectAll('tb_admin_servicos')) /$porPagina);
    for ($i = 1; $i <= $totalPaginas; $i++) {
        if ($i == $paginaAtual) {
            echo '<a class="page-selected" href ="'.INCLUDE_PATH_PAINEL. 'listar_servicos?pagina='.$i.'"> '.$i.'</a>';
        } else {
            echo '<a href="'.INCLUDE_PATH_PAINEL.'listar_servicos?pagina='.$i.'"> '.$i.'</a>';
        }
    }
    ?>
</div>



</div>