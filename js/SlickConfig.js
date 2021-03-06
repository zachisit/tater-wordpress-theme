/**
 * File slick_config.js
 *
 * Initialize slider related to a css div
 *
 * @dependencies: slick slider
 * http://kenwheeler.github.io/slick/
 * jquery
 * @version: 1.0.1
 * @package: tater
 */

/**
 * Standard Slider Usage
 */
jQuery(document).ready(function($){
    $('.slick_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        dots: true,
        arrows: false,
        autoplaySpeed: 5500
    });
});
