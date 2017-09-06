/**
 * File slick_slider.js
 *
 * Initialize slider related to a css div
 *
 * dependencies:
 * slick slider
 * http://kenwheeler.github.io/slick/
 *
 * version:
 * 1.0.1
 *
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
