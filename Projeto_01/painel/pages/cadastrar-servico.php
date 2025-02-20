<div class="box-content">
    <h2><i class="fas fa-plus">Adicionar Serviço</i></h2>

    <form method="post" enctype="multipart/form-data">
        <?php

        if(isset($_POST['acao'])){
            if(Painel::insert($_POST)) {
                Painel::messageToUser('sucesso', 'Serviço cadastrado com sucesso!');
            } else {
                Painel::messageToUser('Erro', 'Não foi possivel cadastrar o serviço');
            }
        }
        ?>
        <div class="form-group">
            <label for="depoimento">Serviço: </label>
            <textarea name="servico" required></textarea>
        </div><!-- form group -->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nomeTabela" value="tb_admin.servicos">
            <input type="submit" name="acao" value="Cadastrar">
        </div><!-- form group -->
    </form>
</div><!-- box-content -->