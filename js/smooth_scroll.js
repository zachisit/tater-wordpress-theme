/**
 * File smooth_scroll.js
 *
 * Basic anchor text link smooth scroll script
 *
 * @source: https://paulund.co.uk/smooth-scroll-to-internal-links-with-jquery
 *
 */
jQuery(document).ready(function(){
    jQuery('a[href^="#"]').on('click',function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = jQuery(target);

        jQuery('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
});
