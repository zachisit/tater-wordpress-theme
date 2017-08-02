<?php
if ( ! is_active_sidebar( 'internal-sidebar' ) ) {
    echo "please set up the sidebar in your theme under 'internal-sidebar'";
}
?>

<aside id="main" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'internal-sidebar' ); ?>
</aside><!-- #secondary -->