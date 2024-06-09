<footer class="site__footer">
    <!-- Déclaration du menu  -->
    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer',
            'container' => 'ul'
        )
    ); ?>

    <!-- Appel de la modale de contact -->
    <?php get_template_part('parts/contact-modal'); ?>
    
    <!-- Appel de la lightbox d'affichage plein écran -->
    <?php get_template_part('parts/lightbox'); ?>


</footer>

<!-- Chargement de styles et de scripts en bas de page  -->
<?php wp_footer(); ?>


</body>

</html>