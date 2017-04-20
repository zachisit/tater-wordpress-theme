<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tater
 */
?>
<footer id="main">
    <div id="left">
        <!--content or logo will go here-->
    </div>
    <div id="right">
        <!--menu or logo will go here-->
    </div>
    <div id="bottom">
        <p>&copy; <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>

<!--Google Analytics-->
    <!--remove me and replace with client GA code-->
</body>
</html>