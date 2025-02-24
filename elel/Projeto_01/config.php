<?php
session_start();

//Fuso horário de São Paulo
date_default_timezone_set('America/Sao_Paulo');

define('INCLUDE_PATH', 'http://localhost/elel/Projeto_01/');

define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');

//Diretório base das imagens
define('BASE_DIR_PAINEL', __DIR__.'/painel/');

define('HOST', 'localhost');
define('DATABASE', 'projeto_01');
define('USER', 'root');
define('PASSWORD', '');

$autoload = function($class){
    include('assets/classes/'.$class.'.php');
};

spl_autoload_register($autoload);

//Função para o cargo
function pegaCargo($indice){
    return Painel::$cargos[$indice];
}

//Função para o menu selecionado 
function selecionaMenu($menuItem){
    $url = explode('/',@$_GET['url'])[0];
    if($url == $menuItem){
        echo 'class="menu-active"';
    }
}

function verificaPermissaoMenu($permissao){
    if($_SESSION['cargo'] >= $permissao){
        return true;
    }else{
        echo 'style="display:none"';
    }
}

function verificaPermissaoPagina($permissao){
    if($_SESSION['cargo'] >= $permissao){
        return true;
    }else{
        include('painel/pages/permissao_negada.php');
        die();
    }
}

//Nome para inserir no painel da empresa
$nomeEmpresa = 'Barbearia Mr.Guapo';
define('NOME_EMPRESA', 'Mr.Guapo');

//função para recuperar os campos
function recoverPost($post){
    if(isset($_POST[$post])){
        echo $_POST[$post];
    }
}


?>