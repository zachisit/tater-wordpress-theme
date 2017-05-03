/**
 * File showmore.js
 *
 * generic show/hide function using jquery
 *
 *
 */
jQuery(document).ready(function($){
    size_li = $("#supporters_ctablocks .row").size();
    console.log(size_li);
    x=2;
    $('#supporters_ctablocks .row:lt('+x+')').show();
    $('#show_more').click(function () {
        x = (x+2 <= size_li) ? x+2 : size_li;
        $('#supporters_ctablocks .row:lt('+x+')').show();
        if(x == size_li){
            $('#show_more').hide();
        }
    });
});
