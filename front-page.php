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

    <div class="hero" data-background-image="<?php echo esc_url($random_image_url); ?>">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/photographe-event w1000.png' ?>"
            alt="Photographe Event">
    </div>

    <div class="portfolio">

        <div class="photos-list">
            <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'paged' => 1,
            );



            $my_query = new WP_Query($args);

            add_image_size('custom-size', 564, 495, true);


            if ($my_query->have_posts()):
                ?>
                <ul class="gallery">

                    <?php
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

            <button id="buttonLoadMore">Charger plus</button>

        </div>


    </div>



</main>

<?php get_footer(); ?>