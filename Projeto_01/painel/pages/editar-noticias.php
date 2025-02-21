<?php 
	if(isset($_GET['id'])){
		$id = (int) $_GET['id'];
		$servico = Painel::get('tb_admin.noticias', 'id = ?', array($id));
	} else {
		Painel::messageToUser('erro', 'id não existe');
		die();
	}
?>
<div class="box-content">

	<h2><i class="fas fa-edit"></i> Editar Noticia</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
		if(isset($_POST['acao'])){
			$titulo = $_POST['titulo'];
			$conteudo = $_POST['conteudo'];
			$imagem = $_FILES['imagem'];
			$imagem_atual = $_POST['imagem_atual'];
			$verificaNoticia = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE titulo = ? AND categoria_id = ? AND id = ?");
			$verificaNoticia->execute(array($titulo, $_POST['categoria_id'], $id));
				if($verificaNoticia->rowCount()==0){
					if($imagem['name'] != ''){
						//O usuario selecionou a imagem
						if(Painel::validImage($imagem)){
							Painel::deleteFile($imagem_atual);
							$slug = Painel::generateSlug($titulo);
							$arr = ['categoria_id'=>$_POST['categoria_id'], 'titulo'=>$titulo, 'conteudo'=>$conteudo,
									'capa'=>$imagem, 'slug'=>$slug, 'id'=>$id, 'nomeTabela'=>'tb_admin.noticias'];
							Painel::update($arr);
							$noticia = Painel::get('tb_admin.noticias', 'id = ?', array($id));
							Painel::messageToUser('sucesso', 'Noticia atualizada com a imagem!');
						} else {
							Painel::messageToUser('sucesso', 'Formatos de imagem permitidos (jpeg, jpg ou png)');
						}
					} else {
						//O usuario não selecionou a imagem
						$imagem = $imagem_atual;
						$slug = Painel::generateSlug($titulo);
						$arr = ['categoria_id'=>$_POST['categoria_id'], 'titulo'=>$titulo, 'conteudo'=>$conteudo,
									'capa'=>$imagem, 'slug'=>$slug, 'id'=>$id, 'nomeTabela'=>'tb_admin.noticias'];
						Painel::update($arr);
						$noticia = Painel::get('tb_admin.noticias', 'id = ?', array($id));
						Painel::messageToUser('sucesso', 'Noticia atualizada!');
					}
				}
		}
		
		
		?>
		<div class="form-group">
			<label for="nome">Categoria: </label>
			<select name="categoria_id" id="">
			<?php 
				$categorias = Painel::getAll('tb_admin.categorias');
				foreach ($categorias as $key => $value) {
					?>	
					<option <?php if($value['id'] == $noticia['categoria_id']) echo 'selected'; ?> 
						value="<?php echo $value['id']; ?>"><?php echo $value['nome'] ?></option>
			<?php 		
				}
			?>	
			</select>
			
			<div class="form-group">
			<label for="titulo">Titulo: </label>
			<input type="text" name="titulo" value="<?php echo $noticia['titulo'] ?>" required>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label for="nome">Conteudo: </label>
			<textarea class="tinymce" name="conteudo" id=""><?php echo $noticia['conteudo']; ?></textarea>
		</div><!-- form-group -->

		<div class="form-group">
			<label for="nome">Imagem: </label>
			<input type="file" name="imagem">
			<input type="hidden" name="imagem_atual" value="<?php echo $noticia['capa']; ?>">
		</div><!-- form-group -->

		<div class="form-group">
		<input type="submit" name="acao" value="Adicionar">
		</div><!-- form-group -->
	</form>

</div><!-- box-content -->