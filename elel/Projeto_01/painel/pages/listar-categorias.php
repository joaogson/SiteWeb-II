<?php 
if(isset($_GET['excluir'])){
    //$idExcluir = (int)($_GET['excluir']);
    $idExcluir = intval($_GET['excluir']);
    Painel::delete('tb_admin.categorias', $idExcluir);
    
    $noticias = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE categoria_id = ?");
    $noticias->execute(array($idExcluir));
    $noticias = $noticias->fetchAll();
    foreach ($noticias as $key => $value) {
        $imgDelete = $value['capa'];
        Painel::deleteFile($imgDelete);
    }
    $noticias = MySql::conectar()->prepare("DELETE FROM `tb_admin.noticias` WHERE categoria_id = ?");
    $noticias->execute(array($idExcluir));

    Painel::redirect(INCLUDE_PATH_PAINEL.'listar-categorias');
}else if(isset($_GET['order']) && isset($_GET['id'])){
    Painel::orderItem('tb_admin.categorias', $_GET['order'], $_GET['id']);
}

$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$porPagina = 4;
$categorias = Painel::getAll('tb_admin.categorias', ($paginaAtual - 1) * $porPagina, $porPagina);
?>

<div class="box-content">
    <h2><i class="fas fa-database"></i> Categorias cadastradas</h2>

    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>Editar</td>
                <td>Excluir</td>
                <td>Descer</td>
                <td>Subir</td>
            </tr>
            <?php foreach ($categorias as $key => $value) {
            ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>

                <td><a class="edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php 
                                            echo $value['id']; ?>"><i class="fas fa-edit"></i></a></td>

                <td><a actionBtn="delete" class="delete" href="<?php echo INCLUDE_PATH_PAINEL
                                                     ?>listar-categorias?excluir=<?php
                                                    echo $value['id'];?>"><i class="fas fa-trash"></i></a></td>
                              
                <td><a class="order-down" href="<?php echo INCLUDE_PATH_PAINEL;
                                                ?>listar-categorias?order=up&id=<?php echo $value['id'];?>">
                                                <i class="fa-solid fa-angle-down"></i></a></td>
                <td><a class="order-up" href="<?php echo INCLUDE_PATH_PAINEL;
                                                ?>listar-categorias?order=down&id=<?php echo $value['id'];?>">
                                                <i class="fa-solid fa-angle-up"></i></a></td>
            </tr>
            <?php }?>
        </table>
    </div>

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::getAll('tb_admin.categorias')) / $porPagina);
            for ($i=1; $i <= $totalPaginas ; $i++) {
                if ($i == $paginaAtual) 
                    echo '<a class="page-selected"
                        href="' . INCLUDE_PATH_PAINEL . 'listar-categorias?pagina=' . $i . '">' . $i . '</a>';
                else
                    echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-categorias?pagina=' . $i . '">' . $i . '</a>';
            }
        ?>
    </div>

</div>
