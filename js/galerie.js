jQuery(document).ready(function ($) {

    // Affichage de la galerie de la page d'accueil
    // Initialiser les variables 
    let currentPage = 1;  // Pagination
    let loadMore = false; // Identifie l'action demandée : true = charger plus, false : filtrer

    // Récupérer les valeurs des filtres
    function getFilterValues() {
        var categorie = $('#categorie-select').val();
        var format = $('#format-select').val();
        var order = $('#order-select').val() || 'DESC';
        if (categorie === "all") categorie = "";
        if (format === "all") format = "";
        return { categorie, format, order };
    }

    // Bouton charger plus
    function loadMorePhotos() {
        loadMore = true;
        currentPage++;  // Incrémenter la pagination
        updateGallery();  // Appel de la fonction ajax de mise à jour de la galerie
    }
    // Modification d'un filtre
    function filterPhotos() {
        loadMore = false;
        currentPage = 1;  // Réinitialisation de la pagination
        $('#buttonLoadMore').show();  // Afficher le bouton charger plus
        $('#messEndLoad').hide();  // Cacher le message de fin 
        updateGallery(); // Appel de la fonction ajax de mise à jour de la galerie
    }

    // Mise à jour de la galerie
    function updateGallery() {
        var filters = getFilterValues();  // Appel de la fonction de récupérarion de la valeur des filtres
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'json',   // Type json pour récupérer la valeur de la pagination 
            data: {
                action: 'nathaliemota_filter_loadmore',
                paged: currentPage,
                categorie: filters.categorie,
                format: filters.format,
                order: filters.order
            },
            success: function (res) {

                if (loadMore) {   // Cas du bouton charger plus
                    if (currentPage >= res.max) {  // Il n'y a plus de photos à charger
                        $('#buttonLoadMore').hide();  // Masquer le bouton charger plus
                        $('#messEndLoad').show();  // Afficher le message de fin de chargement
                    }
                    $('.gallery').append(res.html);  // Concaténer les photos en fin de galerie
                    $('.trigger-full-screen').on('click', displayLightbox); // Positionner l'event handler sur l'icone full screen de l'overlay
                }
                else {  // Cas des filtres
                    
                    $('.gallery').html(res.html);  // Remplacer l'affichage de la galerie par les nouvelles données
                    $('.trigger-full-screen').on('click', displayLightbox); // Positionner l'event handler sur l'icone full screen de l'overlay
                }

            }
        });
    }

    // Ouverture de la lightbox
    function displayLightbox() {
        var $this = $(this);
        var imgSrc = $this.closest('li').find('img').attr('src');
        var title = $this.closest('li').find('#overlayTitle').text();
        var category = $this.closest('li').find('#overlayCategory').text();

        $('.lightbox-image').attr('src', imgSrc);
        $('.lightbox-title').text(title);
        $('.lightbox-category').text(category);

        $('#lightbox').fadeIn().css('display', 'flex');
    };

    // Fermeture de la lightbox
    function closeLightbox() {
        $('#lightbox').fadeOut();
    }

    // Lightbox : Navigation avec les fleches précédente et suivante
    function lightboxNextPrevious() {
        var currentImg = $('.lightbox-image').attr('src');
        var currentLi = $('img[src="' + currentImg + '"]').closest('li');
        var newLi;

        if ($(this).hasClass('lightbox-prev')) {
            newLi = currentLi.prev('li');
            if (newLi.length === 0) newLi = $('.gallery li').last();
        } else {
            newLi = currentLi.next('li');
            if (newLi.length === 0) newLi = $('.gallery li').first();
        }

        var newImgSrc = newLi.find('img').attr('src');
        var newTitle = newLi.find('#overlayTitle').text();
        var newCategory = newLi.find('#overlayCategory').text();

        $('.lightbox-image').attr('src', newImgSrc);
        $('.lightbox-title').text(newTitle);
        $('.lightbox-category').text(newCategory);
    }


    // Event handlers 
    $('#buttonLoadMore').on('click', loadMorePhotos);  // Sur le bouton Charger plus
    $('#categorie-select, #format-select, #order-select').on('change', filterPhotos);  // Sur les filtres de la page d'accueil
    $('.trigger-full-screen').on('click', displayLightbox); // Sur l'icone full screen de l'overlay au chargement des pages possédant une galerie
    $('.lightbox-prev, .lightbox-next').on('click', lightboxNextPrevious); // Sur les fleches de navigation de la lightbox 
    $('.lightbox-close').on('click', closeLightbox); // Sur le croix de le lightbox

})