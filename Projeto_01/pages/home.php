 <?php
 $slides = MySql::conectar()->prepare("SELECT * FROM `tb_admin.slides`");
 $slides->execute();
 $slides = $slides->fetchAll();
 ?>
 <!--banner-principal-->
 <section class="banner-principal">

	 <?php foreach ($slides as $key => $value) { 
		?>
	 <div style="background-image:url('<?php echo INCLUDE_PATH;?>uploads/<?php echo $value['slide']; ?>')"
		 class="banner-single"></div>
	 <!--banner-single-->

	 <?php }?>

	 <div class="overlay"></div>
	 <!--overlay-->
	 <div class="center">
		 <form action="">
			 <h2>Qual o seu melhor e-mail?</h2>
			 <input type="email" name="email" id="email" required>
			 <input type="submit" name="enviar" value="Enviar">
		 </form>
	 </div>


	 <div class="bullets"></div>
	 <!--bullets-->


 </section>
 <!--banner-principal-->

 <!--descricao-autor-->
 <section class="descricao-autor">
	 <div class="center">
		 <div class="w100">
			 <h2 class="text-center">
				 <img src="<?php echo INCLUDE_PATH; ?>assets/img/local-trabalho.png" alt="Local de trabalho">
				 <?php echo $infoSite['nome_autor']?>
			 </h2>
			 <h3 class="text-center">
				 <p><?php echo $infoSite['descricao']?></p>
			 </h3>
		 </div>
		 <div class="clear"></div>
		 <!--clear float-->
	 </div>
	 <!--center-->
 </section>
 <!--descricao-autor-->

 <!--especialidades-->
 <section class="especialidades">
	 <div class="center">
		 <h2 class="title">Especialidades</h2>
		 <div class="w33 left box-especialidades">
			 <h3><i class="fa-brands fa-html5"></i></h3>
			 <h3><?php echo $infoSite['icone1'] ?></h3>
			 <p><?php echo $infoSite['descricao1'] ?></p>
		 </div>
		 <div class="w33 left box-especialidades">
			 <h3><i class="fa-brands fa-css3"></i></h3>
			 <h3><?php echo $infoSite['icone2'] ?></h3>
			 <p><?php echo $infoSite['descricao2'] ?></p>
		 </div>
		 <div class="w33 left box-especialidades">
		 <h3><i class="fa-brands fa-js"></i></h3>
			 <h3><?php echo $infoSite['icone3'] ?></h3>
			 <p><?php echo $infoSite['descricao3'] ?></p>
		 </div>
		 <div class="clear"></div>
		 <!--clear float-->
	 </div>
	 <!--center-->
 </section>
 <!--especialidades-->

 <!--Extras-->
 <section class="extras">
	 <div class="center">
		 <div id="depoimentos" class="w50 left depoimentos-container">
			 <h2 class="title">Depoimentos</h2>
			 <?php 
				$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.depoimentos`
													ORDER BY order_id DESC LIMIT 3");
				$sql->execute();
				$depoimentos = $sql->fetchAll();
				foreach ($depoimentos as $key => $value) {
					?>
			 <div class="depoimentos-single">
				 <p class="depoimentos-descricao">
					 <?php echo $value['depoimento']; ?>
				 </p>
				 <p class="nome-autor"><?php echo $value['nome']; ?> - <?php echo $value['data']; ?></p>
			 </div><!-- depoimento-single -->
			 <?php } ?>
		 </div><!-- depoimentos -->
		 <div id="servicos" class="w50 left servicos-container">
			 <h2 class="title">Serviços</h2>
			 <div class="servicos">
				 <?php 

					$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.servicos`
														ORDER BY order_id DESC LIMIT 3");
					$sql->execute();
					$servicos = $sql->fetchAll();
				 ?>
				 <ul>
					 <?php foreach($servicos as $key => $value){ ?>
					 <li>
						 <?php echo $value['servico'];?>
					 </li>
					 <?php } ?>
				 </ul>
			 </div>
		 </div>
		 <div class="clear"></div>
		 <!--clear float-->
	 </div>
	 <!--center-->
 </section>
 <!--Extras-->