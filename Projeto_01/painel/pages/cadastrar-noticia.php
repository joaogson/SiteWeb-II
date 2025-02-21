<div class="box-content">

	<h2><i class="fas fa-edit"></i> Adicionar Noticia</h2>

	<form method="post" enctype="multipart/form-data">
		<?php 
		if(isset($_POST['acao'])){
			$categoria_id = $_POST['categoria_id'];
			$titulo = $_FILES['titulo'];
			$conteudo = $_FILES['conteudo'];
			$capa = $_FILES['capa'];

			if($titulo == '' || $conteudo == ''){
				Painel::messageToUser('erro', 'Campos vazios não são permitidos');
			}else if ($capa['tmp_name'] == ''){
					Painel::messageToUser('erro', 'A imagem de capa precisa ser selecionada');
				} else{
					if(Painel::validImage($capa)){
						$verificaNoticia = MySql::conectar()->prepare("SELECT * FROM `tb_admin.noticias` WHERE titulo = ? AND categoria_id = ?");
						$verificaNoticia->execute(array($titulo));
						if($verificaNoticia->rowCount() == 0){
							$imagem = Painel::uploadFile($capa);
							$slug = Painel::generateSlug($titulo);
							$arr = ['categoria_id'=>$categoria_id, 'titulo'=>$titulo, 'conteudo'=>$conteudo, 'capa'=>$imagem, 'order_id'=>'0', 'slug'=>$slug, 'nomeTabela'=>'tb_admin.noticias'];
							if(Painel::insert($arr)){
								Painel::redirect(INCLUDE_PATH_PAINEL . 'cadastrar-noticia?sucesso');
							}
						} else {
							Painel::messageToUser('erro', 'Ja existe uma noticia com esse nome!');
						}
					} else{
						Painel::messageToUser('erro', 'Formatos de imagem permitidos (jpeg, jpg ou png)');
					}
				}
			}
		

		?>
		<div class="form-group">
			<label for="categoria_id">Categoria: </label>
			<select name="categoria_id">
			<?php
			$categorias = Painel::getAll('tb_admin.categorias');
			foreach ($categorias as $key => $value) {
			?>
				<option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?>
				value="<?php echo $value['id']; ?>"><?php echo $value['nome']?></option>
			<?php } ?>
			</select>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label for="titulo">Titulo: </label>
			<input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>" required>
		</div><!-- form-group -->
		
		<div class="form-group">
			<label for="nome">Conteudo: </label>
			<textarea class="tinymce" name="conteudo" id=""><?php recoverPost('conteudo'); ?></textarea>
		</div><!-- form-group -->

		<div class="form-group">
			<label for="nome">Imagem: </label>
			<input type="file" name="imagem">
		</div><!-- form-group -->

		<div class="form-group">
		<input type="hidden" name="order_id" value="0">
		<input type="hidden" name="nomeTabela" value="tb_admin.noticias">	
		<input type="submit" name="acao" value="Adicionar">
		</div><!-- form-group -->
	</form>

</div><!-- box-content -->