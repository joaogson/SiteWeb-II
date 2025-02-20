<?php 
    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $servico = Painel::get('tb_admin.slides', 'id = ?', array($id));
    } else {
        Painel::messageToUser('erro', 'id não existe');
        die();
    }
?>
<div class="box-content">

    <h2><i class="fas fa-edit"></i> Editar Slide</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['acao'])){
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $usuario = new usuario();
            
            if($imagem['name'] != ''){
                // O usuario selecionou a imagem
                if(Painel::validImage($imagem)){
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    $arr = ['nome'=>$nome, 'slide'=>$imagem, 'id'=>$id, 'nomeTabela'=>'tb_admin.slides'];
                    Painel::update($arr);
                    $slide = Painel::get('tb_admin.slides', 'id=?', array($id));
                    Painel::messageToUser('Sucesso', 'Imagem atualizada!');                    
                    } else {
                        Painel::messageToUser('erro', 'Não foi possivel atualizar a imagem');
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
            <label for="imagem">Imagem: </label>
            <input type="file" name="imagem" value="<?php echo $_SESSION['slide']; ?>">
        </div><!-- form-group -->
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div><!-- form-group -->
    </form>

</div><!-- box-content -->