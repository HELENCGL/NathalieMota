jQuery(document).ready(function ($) {

    // Initialisation des variables 
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

// Mise à jour de la galeie
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
                }
                else {  // Cas des filtres
                    $('.gallery').html(res.html);  // Remplacer l'affichage de la galerie par les nouvelles données
                }

            }
        });
    }
// Event handlers
    $('#buttonLoadMore').on('click', loadMorePhotos);
    $('#categorie-select, #format-select, #order-select').on('change', filterPhotos);

})