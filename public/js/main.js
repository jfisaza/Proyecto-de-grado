$(document).ready(function(){
    $('.tablas ul li a:first').addClass('active');
    $('.tablas article').hide();
    $('.tablas article:first').show();
    $('.tablas ul li a').click(function(){
        $('.tablas ul li a').removeClass('active');
        $(this).addClass('active');
        $('.tablas article').hide();
        var activeTab=$(this).attr('href');
        $(activeTab).show();
        return false;
    });

});

