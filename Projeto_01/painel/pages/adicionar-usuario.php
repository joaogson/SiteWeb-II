<?php 
    verificaPermissaoPagina(2);
?>

<div class="box-content">

    <h2><i class="fas fa-edit"></i> Adicionar Usuário</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['acao'])){

        }
        ?>
        <div class="form-group">
            <label for="nome">Login: </label>
            <input type="text" name="nome" required>
        </div><!-- form-group -->
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required>
        </div><!-- form-group -->
        <div class="form-group">
            <label for="password">Senha: </label>
            <input type="password" name="password" required>
        </div><!-- form-group -->
        <div class="form-group">
            <input type="file" name="imagem">
        </div><!-- form-group -->
        <div class="form-group">
            <input type="submit" name="acao" value="Adicionar">
        </div><!-- form-group -->
    </form>

</div><!-- box-content -->