<?php
    if(isset($_POST['acao'])){
        $nome = $_POST['nome'];
        $slug = Painel::generateSlug($nome);
        
        if($nome == ''){
            Painel::messageToUser('erro', 'O campo nome não pode ficar vazio!');
        }else{
            $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categorias` WHERE nome = ?");
            $verificar->execute(array($nome));
            
            if($verificar->rowCount() == 0){
                $arr = [
                    'nome' => $nome,
                    'slug' => $slug,
                    'order_id' => 0,
                    'nomeTabela' => 'tb_admin.categorias'
                ];
                
                if(Painel::insert($arr)){
                    Painel::messageToUser('sucesso', 'Categoria cadastrada com sucesso!');
                    $nome = '';
                }else{
                    Painel::messageToUser('erro', 'Erro ao cadastrar categoria!');
                }
            }else{
                Painel::messageToUser('erro', 'Já existe uma categoria com este nome!');
            }
        }
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Cadastrar Categoria</h2>
    
    <form method="post">
        <div class="form-group">
            <label>Nome da Categoria:</label>
            <input type="text" name="nome" value="<?php echo isset($nome) ? $nome : ''; ?>">
        </div>
        
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>
