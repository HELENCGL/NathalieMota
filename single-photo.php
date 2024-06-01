<?php get_header(); ?>


<main class="single-photo__container">
  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>


      <div id="divPhoto" class="photo">

        <article class="photo__article">
          <?php $currentPhotoID = get_the_ID(); ?>
          <div id="divPhotoImg" class="photo__article--img">
            <?php the_post_thumbnail('large'); ?>
          </div>

          <div class="photo__article--attributs">

            <h2><?php the_title(); ?></h2>

            <!-- Utilisation de get_field('nom_du_champ') pour récupèrer la valeur des champs personnalisés créés avec ACF -->
            <!-- Échappement des valeurs des champs  avec  esc_html()  -->
            <p> RÉFÉRENCE : <?php echo esc_html(get_field('reference')); ?></p>

            <!-- Utilisation de get_the_terms(get_the_ID(), 'nom_taxonomie') pour récupérer les termes associés à une  taxonomie -->
            <!-- Vérification que les termes ne sont pas vides ou ne contiennent pas d'erreurs avec if ($terms && !is_wp_error($terms)) -->
            <!-- Utilisation de wp_list_pluck($terms, 'name') pour obtenir les noms des termes sous forme de tableau -->
            <!-- Conversion du tableau en chaîne de caractères séparée par des virgules avec implode(', ', $term_list) -->
            <p> CATÉGORIE : <?php
            $categories = get_the_terms(get_the_ID(), 'categorie');
            global $category_list;
            if ($categories && !is_wp_error($categories)) {
              $category_list = wp_list_pluck($categories, 'name');
              echo esc_html(implode(', ', $category_list));
            }
            ?></p>


            <p> FORMAT : <?php
            $formats = get_the_terms(get_the_ID(), 'format');
            if ($formats && !is_wp_error($formats)) {
              $format_list = wp_list_pluck($formats, 'name');
              echo esc_html(implode(', ', $format_list));
            }
            ?></p>

            <p> TYPE : <?php echo esc_html(get_field('type')[0]); ?></p>
            <p> ANNÉE : <?php echo esc_html(get_field('annee')); ?></p>
          </div>


        </article>



        <div class="photo__contact">

          <div class="photo__contact__left">
            <p>Cette photo vous intéresse ?</p>
            <button class="contact-button" data-reference="<?php echo esc_attr(get_field('reference')); ?>">Contact</button>
          </div>

          <div class="photo__contact__right">
            <!-- <div class="photo__contact__right--thumbnail"> -->
              <?php the_post_thumbnail('thumbnail'); ?>
            <!-- </div> -->

            <div class="photo__contact__right--arrow">
              <!-- Ajout des deux images pour les flèches du carroussel -->
              <img id="leftArrow" class="arrow arrow_left"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/left-arrow.svg" alt="fleche gauche">
              <img id="rightArrow" class="arrow arrow_right"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/right-arrow.svg" alt="fleche droite">
            </div>


          </div>

        </div>

      </div>

      <div class="otherPhoto">
        <h3>Vous aimerez AUSSI</h3>


        <?php 
        $args = array(
          'post_type' => 'photo',
          'posts_per_page' => 2,
          'orderby' => 'rand',
          'post__not_in' => [$currentPhotoID],
          'tax_query' => array(
            array(
              'taxonomy' => 'categorie',
              'field' => 'slug',
              'terms' => $category_list
            ),
          ),
        );

        // Passer les arguments au template part
        set_query_var('args', $args);
       
        // Appel du template part
        get_template_part('parts/photo_block');

        ?>

      </div>


    <?php endwhile; endif; ?>
</main>


<?php get_footer(); ?>