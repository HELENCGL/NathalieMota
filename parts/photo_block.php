<!-- Définir d'une taille d'image personnalisé -->
<?php add_image_size('custom-size', 564, 495, true); ?>
<!-- Chaque photo de la galerie est un élément de liste -->
<li>
    <!-- Afficher la photo  -->
    <?php the_post_thumbnail('custom-size'); ?>

    <!-- Overlay avec 2 icones 'full-screen' et 'info photo' -->     
    <div class="photo--overlay">
        <a href="<?php the_permalink(); ?>">
            <img id="iconEye" src="<?php echo get_template_directory_uri(); ?>/assets/img/eye.png" alt="View">
        </a>
        <img id="iconFullScreen" class="trigger-full-screen"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/full-screen.png" alt="Full Screen">

           <!-- Titre et la catégorie de la photo -->
        <div class="overlay-content">
            <p id="overlayTitle"><?php the_title(); ?></p>
            <?php
            $categories = get_the_terms(get_the_ID(), 'categorie');
            if ($categories && !is_wp_error($categories)) {
                $category_list = wp_list_pluck($categories, 'name');
                echo '<p id="overlayCategory">' . esc_html(implode(', ', $category_list)) . '</p>';
            }
            ?>
        </div>
    </div>

</li>