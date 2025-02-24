$(function(){
    //Aqui escrevemos o código JavaScript
    $('nav.mobile').click(function(){
        //Evento do click para mostrar algo
        var listaMenu = $('nav.mobile ul');
        if(listaMenu.is(':hidden')){
            var icone = $('nav.mobile').find('div');
            icone.removeClass('fa-bars');
            icone.addClass('fa-xmark');
            listaMenu.slideToggle();
        }else{
            var icone = $('nav.mobile').find('div');
            icone.removeClass('fa-xmark');
            icone.addClass('fa-bars');
            listaMenu.slideToggle();
        }
    });
    
    //Verificando se o elemento existe para aplicar o scroll
    if($('target').length > 0){
        var elemento = '#'+$('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({'scrollTop':divScroll}, 2000);
    }
})