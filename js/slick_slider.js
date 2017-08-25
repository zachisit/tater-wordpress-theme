/**
 * File slick_slider.js
 *
 * Initialize slider related to a css div
 *
 * dependencies:
 * slick slider
 * http://kenwheeler.github.io/slick/
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

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slider-for'
    });

    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-nav',
        dots: true,
        arrows: true,
        centerMode: true,
        focusOnSelect: true
    });
});
