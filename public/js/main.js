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

// $(document).on('click','.pagination a',function(e){
//     e.preventDefault();
//     var page = $(this).attr('href').split('page=')[1];
//     var route="http://localhost/Proyecto/proyecto/public/administrativos";    $.ajax({
//         url:route,
//         data:{page:page},
//         type:'GET',
//         dataType:'json',
//         success:function(data){
//            $(".empresas").html(data);
//         }
//     });
// });
