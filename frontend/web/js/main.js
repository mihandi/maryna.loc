/*$(document). on("click", '.reg', function (e) {
    e.preventDefault();
    $('.form').html('Загружаю...');
    $.ajax({
        url: '/site/registr',
        type: 'get',
        async: false,
        success: function (res) {
            $('.form').html(res);
           // console.log('Всё хорошо!!!');
        },
        error: function (res) {
            console.log('Всё плохо!!!');
        }
    });
});*/

$('.reply').on('click', function (e) {
    e.preventDefault();
    var idComment = $(this).data('comment');
    $('#comment-parent_id').val(idComment);
    $('#comment-text').focus();
});

// Удаление аватара
$('.delFoto').on ('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var img = $(this).data('img');
    
    $.ajax({
        url: '/user/del-img',
        data: {id: id, img: img},
        type: 'GET',
        
        success: function (res) {
            if (res == 'ok')
            {
                $('.del_'+img).remove();
                $('.delFoto').remove();
            }
        },
        error:function (res) {
            alert ('Что-то пошло не так');
        }
    });
    
});


$(document).ready(function () {
    $('#gallery a').nivoLightbox({
        effect: 'fadeScale',
        afterShowLightbox: function (lightbox) {},

    });
});