<?php get_header(); ?>

<?php

// HERO : chargement d'une page aléatoire de la mediathèque
// Requête sur les images
$args = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
    'posts_per_page' => 50, // Limiter le nombre d'images récupérées
);

// Exécuter la requête pour obtenir toutes les images
$images_query = new WP_Query($args);

// Vérifier s'il y a des images disponibles
if ($images_query->have_posts()) {
    $images = $images_query->posts;
    $landscape_images = array();

    // Parcourir les images et ne garder que celles en format paysage
    foreach ($images as $image) {
        $meta = wp_get_attachment_metadata($image->ID);
        if ($meta['width'] > $meta['height']) {
            $landscape_images[] = $image;
        }
    }

    // Vérifier s'il y a des images en format paysage disponibles
    if (!empty($landscape_images)) {
        // Sélectionner une image aléatoire
        $random_image = $landscape_images[array_rand($landscape_images)];

        // Obtenir l'URL de l'image aléatoire
        $random_image_url = wp_get_attachment_url($random_image->ID);
    } else {
        // Aucune image en format paysage trouvée
        $random_image_url = '';
    }
}

?>


<main class="front-page__container">
    <!-- Section Hero   -->
    <!-- Définir une div avec un attribut permettant de passer l'image en paramètre -->
    <div class="hero" data-background-image="<?php echo esc_url($random_image_url); ?>">
        <h1>PHOTOGRAPHE EVENT</h1>
    </div>



    <!-- Section portfolio -->
    <div class="portfolio">

        <!-- Section des filtres -->
        <div class="filters">
            <?php
            // Récupérer les termes des  taxonomies format et categorie
            $formats = get_terms(
                array(
                    'taxonomy' => 'format',
                    'hide_empty' => false,
                )
            );

            $categories = get_terms(
                array(
                    'taxonomy' => 'categorie',
                    'hide_empty' => false,
                )
            );

            ?>
            <!-- Créer les listes déroulantes -->

            <form class="filters--left" id="filter-form--left" method="GET">
                <select data-placeholder="CATEGORIES" class="nm-select2" name="categorie" id="categorie-select">
                    <option></option>
                    <?php foreach ($categories as $categorie) { ?>
                        <option value="<?php echo esc_attr($categorie->slug); ?>">
                            <?php echo esc_html($categorie->name); ?>
                        </option>
                    <?php } ?>
                    <option value="all">Toutes les catégories</option>
                </select>

                <select data-placeholder="FORMATS" class="nm-select2" name="format" id="format-select">
                    <option></option>
                    <?php foreach ($formats as $format) { ?>
                        <option value="<?php echo esc_attr($format->slug); ?>"><?php echo esc_html($format->name); ?>
                        </option>
                    <?php } ?>
                    <option value="all">Tous les formats</option>
                </select>
            </form>


            <form class="filters--right" id="filter-form--right" method="GET">
                <select data-placeholder="TRIER PAR" class="nm-select2" name="order" id="order-select">
                    <option></option>
                    <option value="DESC">Les plus récentes en premier</option>
                    <option value="ASC">Les plus anciennes en premier</option>
                </select>
            </form>


        </div>

        <!-- Afficher la galerie au chargement de la page-->

        <div class="photos-list">

            <?php
            // Construire l'argument de requête au chargement initial de la page
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'paged' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
            );
            // Requête en base de données
            $my_query = new WP_Query($args);

            if ($my_query->have_posts()):
                ?>
                <!-- Créer la liste des photos -->
                <ul class="gallery">
                    <?php
                    //Boucle WordPress
                    while ($my_query->have_posts()):
                        $my_query->the_post();
                        // Appel du template part d'affichage des list items
                        get_template_part('parts/photo_block');

                    endwhile;
                    ?>

                </ul>

            <?php endif;
            wp_reset_postdata(); // On réinitialise les données
            ?>
            <!-- Bouton "Charger plus" et message lorsqu'il n'y a plus rien à charger -->
            <p id="messEndLoad"> Vous avez atteint la fin</p>
            <button id="buttonLoadMore">Charger plus</button>

        </div>

    </div>

</main>

<?php get_footer(); ?>