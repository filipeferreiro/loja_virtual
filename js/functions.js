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

    $('#preco').mask('R$ #.##0,00', {reverse: true});

    $("#quantidade").bind('keyup change input',function(){
        sendRequest();
    })

    function sendRequest(){
        $('form').ajaxSubmit({
            data:{'quantidade':$('select#quantidade').val(),
                'valor':$('input[name=valor]').val()},
            success:function(data){
                $('.carrinho .container').html(data);
            }
        });
    };
});