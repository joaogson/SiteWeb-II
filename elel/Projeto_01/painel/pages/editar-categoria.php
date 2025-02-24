<?php 
    if(isset($_GET['id'])){
        $id = (int) $_GET['id'];
        $categoria = Painel::get('tb_admin.categorias', 'id = ?', array($id));
    }else{
        Painel::messageToUser('erro', 'id não existe');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fas fa-edit"></i>Editar Categoria</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
            if (isset($_POST['acao'])) {
                if(Painel::update($_POST)){
                    $slug = Painel::generateSlug($_POST['nome']);
                    $arr = array_merge($_POST, array('slug' => $slug));
                    $verificarCategoria = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE nome = ? AND id != ?");
                    $verificarCategoria->execute(array($_POST['nome'], $id));
                    if($verificarCategoria->rowCount() == 1){
                        Painel::messageToUser('erro', 'Já existe uma categoria com este nome!');
                    }else{
                        if(Painel::update($arr)){
                            Painel::messageToUser('sucesso', 'Categoria editada com sucesso!');
                            $categoria = Painel::get('tb_admin.categorias', 'id = ?', array($id));
                    }else{
                        Painel::messageToUser('erro', 'Campos vazios não permitidos!');
                    }
                    Painel::messageToUser('sucesso', 'Categoria editada com sucesso!');
                    $categoria = Painel::get('tb_admin.categorias', 'id = ?', array($id));
                }
            }
        }
        ?>

        <div class="form-group">
            <label for="nome">Categoria: </label>
            <input type="text" name="nome" value="<?php echo $categoria['nome']?>">
        </div>
        
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="hidden" name="nomeTabela" value="tb_admin.categorias">
            <input type="submit" name="acao" value="Atualizar">
        </div>
    </form>
</div>