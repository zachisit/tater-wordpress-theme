/**
 * File search.js
 *
 * if user hits search button with nothing filled in:
 * redirect focus to input field
 *
 * @version: 1.0
 * @package: tater
 */

jQuery(document).ready(function($) {

    $('.search-submit').click(function(e){
        var $searchField = $('.search-field'),
            $searchFieldValue = $searchField.val(),
            hoverColor = '#ffff66';

        console.log($searchField);
        console.log($searchFieldValue);

        if ($searchFieldValue === '') {
            e.preventDefault();
            $searchField.css('background', hoverColor);
            $searchField.get(0).focus();
        }
    })
});