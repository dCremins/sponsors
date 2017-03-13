<?php
 /*
 Template Name: Single Sponsor
 Template Post Type: sponsors
 */
while (have_posts()) :
            the_post();
        ?>
       <article <?php post_class(); ?>>
         <header>
          <h1 class="entry-title"> <?php the_title(); ?></h1>
          <h2><?php the_field('contributor_level'); ?></h2>
        </header>
        <div class="row">
          <div class="entry-content col">
            <?php
            if (get_field('type') == 'Logo' && get_field('logo')) {
                $image = get_field('logo');
                if (get_field('custom_width')) {
                    echo '<div style="width: '. get_field('custom_width') . 'px;">';
                }
                echo '<img style="width: 100%;"src="' . $image['url'] . '" alt="' . $image['alt'] . '"';
                if (get_field('suctom_width')) {
                    echo '</div>';
                }
            }
            ?>
          </div>
        </div>

        <footer>
          <nav class="post-nav row">
            <div class="previous col"><?php previous_post_link('%link', '<i class="fa fa-arrow-left" aria-hidden="true"></i> Previous'); ?></div>
            <div class="next col"><?php next_post_link('%link', 'Next <i class="fa fa-arrow-right" aria-hidden="true"></i>'); ?></div>
          </nav>
        </footer>
       </article>
        <?php endwhile; ?>
