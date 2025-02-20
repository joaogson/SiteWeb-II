<?php 
    $site = Painel::get('tb_admin.config', false);
?>
<div class="box-content">
    <h2><i class="fas fa-edit"> Editar Configurações do site</i></h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['acao'])){
            if(Painel::update($_POST, true)){
                Painel::messageToUser('sucesso', 'Site editado com sucesso!');
                $servico = Painel::get('tb_admin.config', false);
            } else {
                Painel::messageToUser('erro', 'Campos vazios não são permitidos!');
            }
        }
        ?>
        <div class="form-group">
            <label for="titulo">Titulo do Site: </label>
            <input type="text" name="titulo" value="<?php echo $site['titulo']?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label for="nome_autor">Nome do Autor do Site: </label>
            <input type="text" name="nome_autor" value="<?php echo $site['nome_autor']?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label for="descricao">Descrição do Autor do Site: </label>
            <textarea name="descricao"><?php echo $site['descricao']?></textarea>
        </div><!-- form-group -->

        <?php 
            for($i=1; $i>=3; $i++){
        ?>

        <div class="form-group">
            <label for="icone<?php echo $i;?>">Nome do Icone <?php echo $i;?>:</label>
            <input type="text" name="icone <?php echo $i;?>" value="<?php echo $site['icone'.$i]?>">
        </div><!-- form-group -->

        <div class="form-group">
            <label for="descricao<?php echo $i;?>">Descrição do Icone <?php echo $i;?>: </label>
            <textarea name="descricao<?php echo $i;?>"><?php echo $site['descricao'.$i]?></textarea>
        </div><!-- form-group -->


        <?php 
            }
        ?>

        <div class="form-group">            
            <input type="hidden" name="nomeTabela" value="tb_admin.config">
            <input type="submit" name="acao" value="Atualizar">
        </div><!-- form-group -->
    </form>
</div>