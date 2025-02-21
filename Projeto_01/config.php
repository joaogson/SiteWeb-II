<?php
	/*Cria uma sessão ou retorna o atual com base em um 
	identificador passado por meio de uma solicitação GET ou POST
	ou passado por meio de um cookie*/
	session_start();

	//Fuso horário de São Paulo
	date_default_timezone_set('America/Sao_Paulo');

	//Nome da Empresa
	define('NOME_EMPRESA', 'IFPR');

	//Definir o domínio do site!
	define('INCLUDE_PATH', 'http://localhost/Projeto_01/');

	//Definir a URL do painel
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

	//Diretório base as imagens
	define('BASE_DIR_PAINEL', __DIR__.'/painel/');

	//Banco de Dados
	//Encontra-se na hospedagem
	define('HOST', 'localhost');
	//O banco do phpmyadmin
	define('DATABASE', 'projeto_01');
	//Encontra-se na hospedagem
	define('USER','root');
	//Encontra-se na hospedagem
	define('PASSWORD','');

	//Carregando a classe: 'Email'
	$autoload = function($class){
		include('assets/classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	define('Nome_Empresa', 'IFPR');

	//função para o menu selecionado
	function selecionaMenu($menuItem){
		$url = explode('/',@$_GET['url'])[0];
		if($url == $menuItem){
			echo 'class="menu-active"';
		}
	}

	//Função para verificar a permissão por usuário
	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return true;
		} else {
			echo 'style="display:none"';
		}
	}

	//Função para verificar permissão para exibir a página na url
	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return true;
		} else {
			include('painel/pages/permissao-negada.php');
			die();
		}
	}
	
	//Função para recuperar os campos
	function recoverPost($post){
		if(isset($_POST[$post])){
			echo $_POST[$post];
		}
	}
?>