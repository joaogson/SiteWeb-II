<?php $usuariosOnline = Painel::listUserOnline(); ?>
<?php $getUserTotal = Painel::getUserTotal() ?>
<?php $getUserTotalToday = Painel::getUserTotalToday() ?>
<?php $painelUsers = Painel::painelUsers() ?>

<div class="box-content left w100">
    <h2><i class="fa-solid fa-house"> Painel de Controle - <?php echo NOME_EMPRESA; ?></i></h2>
    <div class="box-metricas">
        <div class="box-metricas-single">
            <h2>Usuários Online</h2>
            <p><?php echo count($usuariosOnline);?></p>
        </div><!--box-metricas-single-->
        <div class="box-metricas-single">
            <h2>Visitas Hoje</h2>
            <p><?php echo $getUserTotalToday;?></p>
        </div><!--box-metricas-single-->
        <div class="box-metricas-single">
            <h2>Total Visitas</h2>
            <p><?php echo $getUserTotal;?></p>
        </div><!--box-metricas-single-->
    </div><!--box-metricas-->
</div>

<div class="box-content left w100">
    <h2><i class="fa-brands fa-chrome"></i> Usuários Online</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col left w50">
                <h2>IP</h2>
            </div>
            <div class="col left w50">
                <h2>Última ação</h2>
            </div>
            <div class="clear"></div>
        </div>
        
        <?php 
        foreach ($usuariosOnline as $key => $value) {
        ?>
        <div class="row">
            <div class="col left w50">
                <h2><?php echo $value['ip'];?></h2>
            </div>
            <div class="col left w50">
                <h2><?php echo date('d/m/Y H/m/s', strtotime($value['ultima_acao']));?></h2>
            </div>
            <div class="clear"></div>
        </div>
        
        <?php }?>

    </div>

    <div class="box-content left w100">
        <h2><i class="fa-brands fa-chrome"></i>Usuários do Painel</h2>
        <div class="table-responsive">
            <div class="row">
                <div class="col left w50">
                    <span>Nome</span>
                </div>
                <div class="col left w50">
                    <span>Cargo</span>
                </div>
                <div class="clear"></div>
            </div>
            <?php 
                foreach ($painelUsers as $key => $value) {
            ?>
            <div class="row">
                <div class="col left w50">
                    <span><?php echo $value['user'];?></span>
                </div>
                <div class="col left w50">
                    <span><?php echo pegaCargo($value['cargo']);?></span>
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>