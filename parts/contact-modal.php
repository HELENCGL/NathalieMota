<!-- Modale de contact -->
<div id="contactModal" class="modal">
    <!-- Contenu de la modale -->
    <div class="modal-content">
        <!-- Image contact -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact.svg" alt="Contact Nathalie Mota">
        <!-- Croix de fermeture -->
        <span class="close-btn">&times;</span>
        <!-- Formulaire Contact Form 7 -->
        <?php echo do_shortcode('[contact-form-7 id="b052468" title="Contact"]');
        ?>
    </div>
</div>