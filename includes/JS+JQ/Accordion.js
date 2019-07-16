$(function(){
    $('.content').hide();
    $('.header h1').click(function(){
        // $('.content').slideUp();
        // $(this).parent().next().slideDown();
        // return false;

        if($(this).parent().next().is(':visible')){
            $(this).parent().next().slideUp();
        }
        else{$(this).parent().next().slideDown();}
    });
});