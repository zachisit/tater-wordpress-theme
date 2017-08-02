/**
 * File videoWrapper.js
 *
 * Wraps any iframe in the videoWrapper class
 * which allows iframe to be fully responsive
 *
 */
jQuery(document).ready(function($){
    $("iframe").wrap("<div class='videoWrapper'/>");
});
