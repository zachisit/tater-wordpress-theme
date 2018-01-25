/**
 * File show_read_more.js
 *
 * Show or hide text inside a div
 *
 * @dependecy jquery
 * @version: 1.0
 * @package: tater
 */

jQuery(document).ready(function($) {
    //the button link that shows dynamically under the text
    var $buttonhtml = $('<a class="morelink">Show More</a>'),
        $moreContent = $('.morecontent');

    $buttonhtml.data( 'state', 'closed' );
    //output the button before the hidden content
    $moreContent.after($buttonhtml);

    //if the .morelink content is clicked
    //then remove the 'display:none' to the .morecontent'
    $buttonhtml.click( function() {
        //show the rest of the content
        $moreContent.slideToggle();
        if ( $(this).data('state') === 'closed' ) {
            $(this).data( 'state', 'open' );
            $(this).text( 'Show Less' );
            $(this).addClass('lessCaret');
        } else {
            $(this).data( 'state', 'closed' );
            $(this).text( 'Show More' );
            $(this).removeClass('lessCaret');
            $('a[href="#main"]').trigger('click');

            //focus user back to start of the hidden content
            $('html, body').animate({ scrollTop: $moreContent.offset().top-100 }, 'slow');
        }
    });
});