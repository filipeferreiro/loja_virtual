$( () =>{
    $('#toggle').click(function(){
            $(this).parent().find('#toggle > ul').slideToggle();
    });

    $('.barras').click(function(){
        $(this).parent().find('.menu-mobile-toggle').toggle("slow");
    });

    $('#toggle-mobile').click(function(){
        $(this).parent().find('#toggle-mobile > ul').toggle(700);
    });

    $('#cep').mask('00000-000');

    //$('#celular').mask('(00) 00000-0000');
});