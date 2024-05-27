<footer class="site__footer">
    <!-- Déclaration du menu  -->
    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer',
            'container' => 'ul'
        )); ?>
</footer>

<!-- Chargement de styles et de scripts en bas de page  -->
<?php wp_footer(); ?>
