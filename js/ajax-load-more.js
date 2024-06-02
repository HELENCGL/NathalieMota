jQuery(document).ready(function ($) {

    let currentPage = 1;

    $('#buttonLoadMore').on('click', function () {
        currentPage++; // Incrémente le numero de page courante, car on veut charger la page suivante

        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
                action: 'nathaliemota_load_more',
                paged: currentPage,
            },
            success: function (res) {
               
                if(currentPage >= res.max) {
                  $('#buttonLoadMore').hide();
                }
                $('.gallery').append(res.html);
              }
        });
    });
})