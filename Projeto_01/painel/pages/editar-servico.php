<?php 
    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $servico = Painel::get('tb_admin.servicos', 'id = ?', array($id));
    } else {
        Painel::messageToUser('erro', 'id não existe');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fas fa-edit"> Editar Serviço</i></h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['acao'])){
            if(Painel::update($_POST)){
                Painel::messageToUser('sucesso', 'Serviço editado com sucesso!');
                $servico = Painel::get('tb_admin.servicos', 'id = ?', array($id));
            } else {
                Painel::messageToUser('erro', 'Não foi possivel editar o serviço!');
            }
        }
        ?>
        <div class="form-group">
            <label for="nome">Serviço: </label>
            <textarea name="servico"><?php echo $servico['servico']?></textarea>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="nomeTabela" value="tb_admin.servicos">
            <input type="submit" name="acao" value="Atualizar">
        </div><!-- form-group -->
    </form>
</div>