<?php

// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans l'en-tête du site .
// Par défaut WordPress va afficher à la suite les valeurs Titre du site et Slogan définies dans Réglages > Général. 
add_theme_support('title-tag');

//Chargement des styles 
function nmota_register_styles()
{
    // Déclarer le fichier style.css à la racine du thème
    wp_enqueue_style('nmota-style', get_stylesheet_uri(), array(), '1.0');
    // Déclarer le fichier css issu du sass 
    wp_enqueue_style('nmota-sass', get_template_directory_uri() . '/sass/main.css', array(), '1.0');

}
add_action('wp_enqueue_scripts', 'nmota_register_styles');

//Chargement des scripts
function nmota_scripts()
{
    wp_enqueue_script('burgerMenu', get_template_directory_uri() . '/js/header.js', array(), '1.0', true);
    wp_enqueue_script('contactModal', get_template_directory_uri() . '/js/contact-modal.js', array(), '1.0', true);
    if (is_singular('photo')) {
        wp_enqueue_script('adjustHeight', get_template_directory_uri() . '/js/single-photo.js', array(), '1.0', true);
    }
    if(is_front_page()) {
    wp_enqueue_script('FrontPageHero', get_template_directory_uri() . '/js/front-page-hero.js', array(), '1.0', true);
        wp_enqueue_script('Ajax-Load-More', get_template_directory_uri() . '/js/ajax-load-more.js', ['jquery'], '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'nmota_scripts');



// Déclaration des emplacements de menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
        'footer' => 'Bas de page',
    )
);

// Ajout du bouton de contact dans le menu du header
function add_contact_btn_to_menu($items, $args)
{
    if ($args->theme_location == 'main') {
        $items .= '<li class="menu-item"><a href="#" class="contact-button" id="contactButton">Contact</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_contact_btn_to_menu', 10, 2);


// Ajout de la mention "Tous droits réservés" dans le menu du footer
function add_mention_to_menu($items, $args)
{
    if ($args->theme_location == 'footer') {
        $items .= '<li class="menu-item">Tous droits réservés</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_mention_to_menu', 10, 2);

// Fonction load-more
function nathaliemota_load_more()
{
    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $_POST['paged'],
    ]);

    $response = '';
    $max_pages = $ajaxposts->max_num_pages;

    if ($ajaxposts->have_posts()) {
        ob_start();  // déclaration du buffer de sortie PHP (output buffer)
        while ($ajaxposts->have_posts()):
            $ajaxposts->the_post(); 
            $response .= get_template_part('parts/photo_block');
        endwhile;
       
        $output = ob_get_contents();  // On vide le buffer de sorie dans la variable $output
    ob_end_clean(); // Fermeture du buffer de sortie
    } else {
        $response = '';
      }
    
      $result = [
        'max' => $max_pages,
        'html' => $output,
      ];
    
      echo json_encode($result);
      exit;
    }
    add_action('wp_ajax_nathaliemota_load_more', 'nathaliemota_load_more');
    add_action('wp_ajax_nopriv_nathaliemota_load_more', 'nathaliemota_load_more');