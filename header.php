<!DOCTYPE html>
<!-- Langue du document:  Cette valeur est basée sur le réglage WordPress dans Réglages > Général > Langue du site. -->
<html <?php language_attributes(); ?>>

<head>
    <!-- Encodage du site. Par défaut c’est UTF-8  -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Obligatoire : par cette fonction, WordPress, le thème et les extensions déclarent le chargement des scripts et des styles    -->
    <?php wp_head(); ?>
</head>
<!-- La fonction body_class() est facultative. Elle permet d’obtenir des noms de classe CSS en fonction de la page visitée, ce qui facilite la création des styles -->

<body <?php body_class(); ?>>
    <!-- Permet à des extensions d’écrire du code au début du body. 
C’est utile notamment pour Yoast qui vient y placer le Google Tag Manager et autres codes de scripts. -->
    <?php wp_body_open(); ?>

    <header class="header">
        <a href="<?php echo home_url('/'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="Logo">
        </a>
    </header>