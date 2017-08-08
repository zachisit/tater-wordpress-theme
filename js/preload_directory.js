/**
 * File preload_directory.js
 *
 * Dynamically preload any images that is inside the images/preload directory of the theme.
 * Runs each item into a normal preload method with
 * timeout set to 1000 to prevent hanging
 *
 * Be smart:
 * Do not upload images that are not necessary to preload
 * and help user experience
 *
 * Common file examples:
 * site-wide logos
 * homepage large parallax images
 * etc
 *
 * Tied to function ncherm_theme_preload_dir()
 *
 * dependencies: jquery
 *
 */
jQuery(document).ready(function($) {
    $.post(ajax.url, {action:'preload_images_directory'}, function(preloadedImages) {
        //console.info(preloadedImages);

        $.each(preloadedImages, function(i,filename) {
            setTimeout(function() {
                new Image().src = filename;
            }, 1000);
        });
    });
});