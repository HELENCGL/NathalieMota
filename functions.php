<?php

// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans l'en-tête du site .
// Par défaut WordPress va afficher à la suite les valeurs Titre du site et Slogan définies dans Réglages > Général. 
add_theme_support('title-tag');

//Chargement des styles et scripts
function nmota_register_styles()
{
    // Déclarer le fichier style.css à la racine du thème
    wp_enqueue_style('nmota-style', get_stylesheet_uri(), array(), '1.0' );
    // Déclarer le fichier css issu du sass 
    wp_enqueue_style('nmota-sass', get_template_directory_uri() . '/sass/main.css', array(), '1.0');
    // Charger le javascript
    wp_enqueue_script('burgerMenu', get_template_directory_uri()  . '/js/header.js', array(), '1.0', true); 
}
add_action('wp_enqueue_scripts', 'nmota_register_styles');

// Déclaration des emplacements de menus
register_nav_menus( array(
	'main' => 'Menu Principal',
	'footer' => 'Bas de page',
    ) );