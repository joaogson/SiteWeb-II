<div class="box-content">

    <h2><i class="fas fa-edit"></i> Editar Usuário</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $password = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $usuario = new usuario();
            
            if($imagem['name'] != ''){
                // O usuario selecionou a imagem
                if(Painel::validImage($imagem)){
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    if($usuario->updateUser($nome, $password, $imagem)){
                        $_SESSION['img'] = $imagem;
                        Painel::messageToUser('Sucesso', 'Imagem atualizada!');                    
                    } else {
                        Painel::messageToUser('erro', 'Não foi possivel atualizar a imagem');
                    }
                }
            } else {
                //O usuario não selecionou a imgem
                $imagem = $imagem_atual;
                if($usuario->updateUser($nome, $password, $imagem)){
                    Painel::messageToUser('Sucesso', 'Atualizado com sucesso!');
                } else {
                    Painel::messageToUser('Erro', 'Não foi possivel atualizar!');
                }
            }
        }
        ?>
        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">
        </div><!-- form-group -->
        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>">
        </div><!-- form-group -->
        <div class="form-group">
            <label for="imagem">Imagem: </label>
            <input type="file" name="imagem" value="<?php echo $_SESSION['img']; ?>">
        </div><!-- form-group -->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div><!-- form-group -->
    </form>

</div><!-- box-content -->