<?php get_header(); ?>

<main class="container">

  <?php if (have_posts()):
    while (have_posts()):
      the_post(); ?>

      <article class="post">
        <div class="post__content">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>

        <div class="post__meta">
          <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
          <p>
            Publié le <?php the_date(); ?>
            par <?php the_author(); ?> </p>
          <p>
            <?php
            // Vérifier si les catégories existent
            $categories = get_the_category();
            if (!empty($categories)) {
              echo ' Dans la catégorie ';
              foreach ($categories as $category) {
                echo '<a href="' . get_category_link($category->term_id) . '">' . esc_html($category->name) . '</a> ';
              }
            }
            ?>
          </p>
          <p> <?php
          // Vérifier si les étiquettes existent
          $tags = get_the_tags();
          if (!empty($tags)) {
            echo ' Avec les étiquettes ';
            foreach ($tags as $tag) {
              echo '<a href="' . get_tag_link($tag->term_id) . '">' . esc_html($tag->name) . '</a> ';
            }
          }
          ?>
          </p>
        </div>


      </article>

    <?php endwhile; endif; ?>



</main>

<?php get_footer(); ?>