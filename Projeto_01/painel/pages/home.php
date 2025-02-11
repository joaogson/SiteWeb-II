<?php $usuariosOnline = Painel::listUserOnline();?>
<?php $getUserTotal = Painel::getUserTotal();?>
<?php $getUserTotalToday = Painel::getUserTotalToday();?>
<?php $painelUsers = Painel::painelUsers(); ?>

<div class="box-content left w100">
    <h2><i class="fa-solid fa-house"></i> Painel de Controle - <?php echo NOME_EMPRESA;?></h2>
    <div class="box-metricas">
        <div class="box-metrica-single">
            <h2>Usuários Online</h2>
            <p><?php echo count($usuariosOnline);?></p>
        </div><!--metrica-single-->
        <div class="box-metrica-single">
            <h2>Visitas Hoje</h2>
            <p><?php echo $getUserTotalToday;?></p>
        </div><!--metrica-single-->
        <div class="box-metrica-single">
            <h2>Visitas Totais</h2>
            <p><?php echo $getUserTotal;?></p>
        </div><!--metrica-single-->
    </div><!--box-metricas-->
</div><!--box-content-->

<div class="box-content left w100">
    <h2><i class="fa-brands fa-chrome"></i> Usuários Online</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col left w50">
                <h2>IP</h2>
            </div><!--col-->
            <div class="col left w50">
                <h2>Última Ação</h2>
            </div><!--col-->
            <div class="clear"></div><!--clear-->
        </div><!--row-->

        <?php 
            foreach ($usuariosOnline as $key => $value) {
        ?>
        <!--Exemplo de inputs-->
        <div class="row">
            <div class="col left w50">
                <h2><?php echo $value['ip'];?></h2>
            </div><!--col-->
            <div class="col left w50">
                <h2><?php echo date('d/m/Y H:i:s', strtotime($value['ultima_acao']));?></h2>
            </div><!--col-->
            <div class="clear"></div><!--clear-->
        </div><!--row-->

        <?php }?>
    </div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content left w100">
    <h2><i class="fa-brands fa-chrome"></i> Usuários do Painel</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col left w50">
                <h2>Nome</h2>
            </div><!--col-->
            <div class="col left w50">
                <h2>Cargo</h2>
            </div><!--col-->
            <div class="clear"></div><!--clear-->
        </div><!--row-->

        <?php 
            foreach ($painelUsers as $key => $value) {
        ?>
        <!--Exemplo de inputs-->
        <div class="row">
            <div class="col left w50">
                <h2><?php echo $value['user'];?></h2>
            </div><!--col-->
            <div class="col left w50">
                <h2><?php echo pegaCargo($value['cargo']);?></h2>
            </div><!--col-->
            <div class="clear"></div><!--clear-->
        </div><!--row-->

        <?php }?>
    </div><!--table-responsive-->
</div><!--box-content-->