<div class="contato-container">
    <div class="center">
        <form method="post" action="">
            <input type="text" name="nome" id="" placeholder="Nome:">
            <input type="text" name="email" id="" placeholder="E-mail:">
            <input type="text" name="telefone" id="" placeholder="Telefone:">
            <textarea name="mensagem" id="" placeholder="Digite a sua mensagem:"></textarea>
            <input type="submit" name="btnEnviar" value="Enviar">
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['btnEnviar'])){
        new Email();
    }
?>

<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3579.025795598464!2d-51.05138442559304!3d-26.228351364956062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94e6602a2f792417%3A0x260a3f120bc90789!2sIFPR%20-%20Campus%20Uni%C3%A3o%20da%20Vit%C3%B3ria!5e0!3m2!1spt-BR!2sbr!4v1728390917831!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>