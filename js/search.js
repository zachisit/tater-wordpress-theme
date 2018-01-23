/**
 * File search.js
 *
 * 1. general onBlur and onFocus events
 *
 // * 2. if user hits search button with nothing filled in:
 // * redirect focus to input field
 *
 * @package tater
 * @version 1.0.0
 */
jQuery(document).ready(function($) {
    var $globalSearchBlurClass = $('.searchBlur');

    $globalSearchBlurClass.blur(function() {
        if (this.value === '') {
            this.value = 'Enter a keyword';
        }
    });
    $globalSearchBlurClass.focus(function() {
        if (this.value === 'Enter a keyword') {
            this.value = '';
        }
    });

    // $('.search-submit').click(function(e){
    //     var $searchField = $('.search-field'),
    //         $searchFieldValue = $searchField.val(),
    //         hoverColor = '#ffff66';
    //
    //     console.log($searchField);
    //     console.log($searchFieldValue);
    //
    //     if ($searchFieldValue === '') {
    //         e.preventDefault();
    //         $searchField.css('background', hoverColor);
    //         $searchField.get(0).focus();
    //     }
    // })
});