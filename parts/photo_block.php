<?php

// Récupérer les arguments passés
$args = get_query_var('args');

// On vérifie si $args est passé, sinon on utilise un tableau vide
$args = isset($args) ? $args : array();

$my_query = new WP_Query($args);

add_image_size('custom-size', 564, 495, true); ?>

<?php
if ($my_query->have_posts()):
    ?>
    <ul class="gallery">

        <?php
        while ($my_query->have_posts()):
            $my_query->the_post();
            ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('custom-size'); ?>
                </a>
            </li>
            <?php
        endwhile;
        ?>

    </ul>

    <?php
endif;
wp_reset_postdata(); // On réinitialise les données
?>