<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @package tater
 */
get_header(); ?>
<main>
    <div id="content_left">
        <?php
        while ( have_posts() ) : the_post();
            //output title, content, etc here
            //the_post_thumbnail('full');

            /*
             * output sample content data when first installed
             */
            $wp_content = get_the_content();

            if (empty($wp_content)) { ?>
                <h1>Vivamus scelerisque nisi mi</h1>
                <p><img src="<?php echo get_template_directory_uri(); ?>/images/sample_twothirtythree.png" alt="<?php echo get_bloginfo( 'name' ); ?> - Home" class="alignleft" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue placerat diam quis bibendum. Suspendisse mattis, neque sit amet commodo tempor, ipsum metus placerat enim, quis vestibulum neque diam eget urna. Curabitur et urna non nunc vulputate maximus. Nunc at euismod libero, id posuere nisl. Curabitur sit amet ex fringilla, ultricies mi quis, rhoncus orci. <a href="">Vivamus scelerisque nisi mi</a>, gravida pharetra nunc posuere et. Suspendisse a tortor iaculis, tincidunt dui quis, egestas velit. Mauris at nulla eu dolor mattis fermentum at non neque. Morbi hendrerit ante quis sagittis laoreet. Sed at nibh a arcu viverra feugiat. Nulla bibendum ipsum sit amet nunc vulputate sollicitudin.</p>

                <h2>Phasellus a enim porta, hendrerit ex sit amet, euismod massa</h2>
                <p><img src="<?php echo get_template_directory_uri(); ?>/images/sample_twothirtythree.png" alt="<?php echo get_bloginfo( 'name' ); ?> - Home" class="alignright" />In tempus tortor in nulla tincidunt vehicula. Ut vel rutrum nulla, ut sagittis ligula. Donec ut consectetur elit. Integer vel velit egestas, egestas sapien vel, luctus augue. Nulla eu est neque. Fusce viverra a metus at ornare. Mauris urna enim, fringilla tincidunt posuere nec, ultricies vitae arcu. Proin maximus commodo ultricies. Etiam sollicitudin tortor ut dignissim <a href="">vehicula</a>. Nullam vel libero id augue mattis hendrerit eget sodales neque. Nullam bibendum diam in velit aliquam, sed luctus erat maximus.</p>

                <h3>Maecenas blandit mauris ante, ut ornare elit vulputate vel</h3>
                <p><img src="<?php echo get_template_directory_uri(); ?>/images/sample_twothirtythree.png" alt="<?php echo get_bloginfo( 'name' ); ?> - Home"  />Sed nec lectus quis augue molestie sollicitudin sit amet a est. Pellentesque semper purus nec arcu blandit, varius malesuada sapien imperdiet. Mauris laoreet vulputate cursus. Donec non tortor a nisi tincidunt mattis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla a mi vel diam gravida consectetur. Praesent porta et <a href="">mauris in convallis</a>. Quisque porttitor arcu lacinia, aliquet lectus eu, dapibus quam. Quisque ut est ultricies, pretium ante eget, bibendum urna. Etiam scelerisque lacus eu enim aliquet, vel posuere metus fermentum.</p>

                <p>Sed eget leo scelerisque, ullamcorper metus laoreet, cursus purus. Mauris ornare mattis dui quis vulputate. Curabitur mollis lacus et dui pharetra, vitae pellentesque quam fermentum. Donec ornare vel libero vitae convallis. Vivamus a mauris mauris. Donec posuere facilisis bibendum. Nulla efficitur, nibh id porta posuere, quam urna pulvinar risus, nec suscipit ante lacus ut felis. Duis tincidunt nec velit faucibus egestas.</p>

                <h1>Maecenas ex diam, vestibulum a nisi at</h1>
                <p>Luctus elementum odio. Cras erat nibh, pulvinar eu quam eget, ullamcorper maximus risus. Nullam commodo consequat lorem sed blandit. Nam diam ante, mollis non convallis quis, maximus eu risus. Proin eget nibh sapien. Fusce ac risus venenatis, pharetra neque ut, condimentum nulla. Donec sit amet eros commodo, ultricies orci ut, porta arcu. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

                <h1>Maecenas ex diam, vestibulum a nisi at</h1>
                <p>Luctus elementum odio. Cras erat nibh, pulvinar eu quam eget, ullamcorper maximus risus. Nullam commodo consequat lorem sed blandit. <blockquote>This is a block quote. Nam diam ante, mollis non convallis quis, maximus eu risus. Proin eget nibh sapien. Fusce ac risus venenatis, pharetra neque ut, condimentum nulla. Donec sit amet eros commodo, ultricies orci ut, porta arcu.</blockquote> Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

                <p>Sed at elit lectus. Integer magna magna, feugiat in leo sit amet, volutpat dapibus felis. Etiam malesuada tortor venenatis sapien maximus, dictum mollis mauris semper. Morbi porta libero sed tellus ornare, vel mattis elit tempor. <blockquote>Morbi ut magna scelerisque, faucibus mi vitae, tincidunt lectus. Phasellus ut commodo nulla. Morbi ut feugiat nibh. Integer rhoncus vestibulum nulla. Etiam id justo quis nisl vestibulum volutpat sit amet ut orci.</blockquote> Donec eget semper metus. Pellentesque varius arcu eu odio auctor, ac dignissim mi vehicula. Nullam eget eros rhoncus, commodo urna eu, luctus nisi. In id orci ac ante tincidunt porttitor. Etiam lacinia sem felis, sit amet vehicula augue sodales eu. Vestibulum convallis odio at elit porttitor laoreet. Nunc quis mauris non dolor iaculis vulputate. Pellentesque vestibulum nec elit ut placerat. Mauris congue libero ante, et commodo metus cursus id.</p>

                <h3>The Last Paragraph</h3>
                <p>Quisque ligula urna, fringilla id dolor sed, semper finibus ante. Suspendisse sollicitudin gravida massa, id interdum purus rhoncus ac. Mauris turpis lacus, laoreet eget semper nec, tristique ut enim. Donec luctus eleifend arcu. Nunc in ultrices augue. Sed lacus metus, posuere vel dictum eget, lacinia at dolor. In nec rhoncus felis. Integer in ligula et justo dictum sollicitudin vitae sed quam. Nulla eu sollicitudin nisi. Nulla eleifend felis ac pellentesque rhoncus. Etiam quis tortor pharetra, iaculis justo vel, pretium velit. Duis ut lacus nunc. Sed tempus urna ac ultrices auctor. Curabitur tempor diam a dolor feugiat, <a href="">non varius nibh condimentum</a>. Aliquam finibus mauris vel varius dictum. Sed sapien magna, imperdiet sed elementum porttitor, fermentum eu sapien.</p>
            <?php }
            else {
                the_content();
            }
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
