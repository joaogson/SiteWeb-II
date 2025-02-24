<?php
if (isset($_GET['logout'])) {
    Painel::logout();
}
?>

<!DOCTYPE html>
<html lang="en, pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <title>Painel de Controle</title>
</head>

<body>
    <aside>
        <div class="box-usuario">
            <?php
            if ($_SESSION['img'] == '') {
            ?>
                <div class="avatar-usuario">
                    <i class="fa-solid fa-user"></i>
                </div><!--avatar-usuario-->
            <?php
            } else {
            ?>
                <div class="imagem-usuario">
                    <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>" alt="Avatar">
                </div><!--imagem-usuario-->
            <?php
            }
            ?>

            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome']; ?></p>
                <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
            </div><!--nome-usuario-->
        </div><!--box-usuario-->

        <div class="items-menu">
            <h2>Cadastro</h2>
           
            <a <?php selecionaMenu('cadastrar-noticia')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-noticia">Barbeiros</a>
            <a <?php selecionaMenu('cadastrar-slide')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-slide">Slide</a>
            <a <?php selecionaMenu('cadastrar-depoimento')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimento">Depoimentos</a>
            <a <?php selecionaMenu('cadastrar-servico')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-servico">Serviços</a>
            <h2>Gestão</h2>
            <a <?php selecionaMenu('listar-noticias')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-noticias">Barbeiros</a>
            <a <?php selecionaMenu('listar-slides')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides">Slide</a>
            <a <?php selecionaMenu('listar-depoimentos')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-depoimentos">Depoimentos</a>
            <a <?php selecionaMenu('listar-servicos')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos">Serviços</a>
            <h2>Usuário</h2>
            <a <?php selecionaMenu('editar-usuario')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario">Editar</a>
            <a <?php selecionaMenu('adicionar-usuario')?> <?php verificaPermissaoMenu(2) ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>adicionar-usuario">Adicionar</a>
            <h2>Configuração</h2>
            <a <?php selecionaMenu('editar')?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-site">Editar</a>
        </div><!--Items-Menu-->
    </aside>
    <header>
        <div class="center">

            <div class="menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div><!--menu-btn-->
            <div class="logout">
                <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?logout">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </div><!--logout-->

            <div class="home-btn">
                <a <?php if (@$_GET['url'] == '') { ?> style="color:black;" <?php } ?>
                    href="<?php echo INCLUDE_PATH_PAINEL; ?>">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                </a>
            </div>

            <div class="clear"></div><!--clear-->
        </div><!--center-->
    </header>

    <div class="content">
        <?php
            Painel::loadPage();
        ?>
    </div><!--content-->

    <!--CDN Jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery_mask.js"></script>

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/elbhp8q2co9zjdoxy15nnndx8bfzhyo4ufi8326yioyonh0m/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    tinymce.init({
        selector: '.tinymce',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500
    });
    </script>
    
    
</body>

</html>