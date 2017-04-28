/**
 * File mobile_menu.js
 *
 * mobile menu using jquery
 *
 *
 */
jQuery(function() {
    //show the menu when button is clicked
    jQuery('#menu_btn').click(function() {
        if(jQuery('#menu').is(':visible')) {
            jQuery('#menu').animate({ left: '-100%' }, 'slow', function () {
                jQuery("#menu").css('display', 'none');
                jQuery('#menu_close').css('display', 'none');
            });
        } else {
            jQuery("#menu").css('display', 'block');
            jQuery('#menu').animate({ left: '0' }, 'slow', function(){
                jQuery('#menu_close').css('display', 'block');
            });
        }
    });

    //close menu when X button is clicked
    jQuery('#menu_close').click(function() {
        jQuery('#menu').animate({ left: '-100%' }, 'slow', function () {
            jQuery("#menu").css('display', 'none');
        });
    });

    callOnResize();
});

jQuery(window).resize( function(){
    callOnResize();
});

function callOnResize() {
    var winwidth = jQuery(window).width();
    if (winwidth < 760) {
        jQuery( '#menu' ).css({ display: 'none' });
        jQuery('#menu').animate({ left: '0' }, 'slow');
    } else if (winwidth >= 760) {
        jQuery( '#menu' ).css({ display: 'block' });
    }
}