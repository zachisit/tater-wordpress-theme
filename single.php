<?php
/**
 * The template for displaying all single posts
 *
 * @package tater
 */
get_header(); ?>
<main>
    <div id="content_left">
        <?php
        while ( have_posts() ) : the_post();
            //output title, content, etc here

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        endwhile; // End of the loop.
        ?>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</main>
<?php
get_footer();
?>
