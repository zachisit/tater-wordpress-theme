<?php
/**
 * The template for displaying all pages
 *
 * @package tater
 */
get_header() ?>
    <main>
        <div class="wrapper">
            <div id="content_left">
                <?php while ( have_posts() ) : the_post();
                    echo the_title();
                    echo the_content();
                endwhile; ?>
            </div>
            <?php get_sidebar() ?>
        </div>
    </main>
<?php get_footer() ?>