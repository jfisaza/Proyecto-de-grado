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

    var estado=document.getElementById('estado');
    if(estado.value != 'APROBADO'){
        $('#btn-desarrollo').addClass('disabled');
    }else if(estado.value = 'APROBADO'){
        $('#btn-desarrollo').removeClass('disabled');
    }
});

