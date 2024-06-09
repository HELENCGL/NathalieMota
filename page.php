<?php get_header(); ?>

<main class="container">
    <div class="container__page">

        <?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>

                <h1><?php the_title(); ?></h1>

                <?php the_content(); ?>

            <?php endwhile; endif; ?>
    
        </div>

</main>



<?php get_footer(); ?>