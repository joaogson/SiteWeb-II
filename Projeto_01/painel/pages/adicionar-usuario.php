<?php 
    verificaPermissaoPagina(2);
?>

<div class="box-content">

    <h2><i class="fas fa-edit"></i> Adicionar Usuário</h2>

    <form method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['acao'])){
            $login = $_POST['login'];
            $nome = $_POST['nome'];
            $cargo = $_POST['cargo'];
            $password = $_POST['password'];

            if($login == ''){
                Painel::messageToUser('erro', 'Preencha o Login');
            } else if($nome == ''){
                Painel::messageToUser('erro', 'Preencha o nome');
            } else if($cargo == ''){
                Painel::messageToUser('erro', 'Selecione o Cargo');
            } else if($password == ''){
                Painel::messageToUser('erro', 'Preencha a senha');
            } else {
                if($cargo >= $_SESSION['cargo']){
                    Painel::messageToUser('erro', 'Selecione um cargo menor que o seu');
                } else if(Usuario::userExists($login)) {
                    Painel::messageToUser('erro', 'Login Indisponivel');
                } else {
                    $usuario = new Usuario();
                    $usuario->registerUser($login, $password, $nome, $cargo);
                    Painel::messageToUser('sucesso', 'Usuario '.$login.' Cadastrado com sucesso!');
                    
                }
            }
            
        }
        ?>
        <div class="form-group">
            <label for="nome">Login: </label>
            <input type="text" name="login" required>
        </div><!-- form-group -->

        <div class="form-group">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" required>
        </div><!-- form-group -->

        <div class="form-group">
            <label for="cargos">Cargo: </label>
            <select name="cargo">
                <?php 
                foreach (Painel::$cargos as $key => $value){
                    if($key < $_SESSION['cargo']){
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>
            </select>
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