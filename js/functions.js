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

});