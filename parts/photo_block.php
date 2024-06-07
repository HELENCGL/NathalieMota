
<?php add_image_size('custom-size', 564, 495, true); ?>
<li>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('custom-size'); ?>
                </a>
            </li>