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
          <h1 class="entry-title accent color"> <?php the_title(); ?></h1>
        </header>
        <div class="row">
          <div class="entry-content col-8">
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
