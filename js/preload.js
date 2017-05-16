/**
 * File preload.js
 *
 * ajax that preloads list of images
 * timeout of 1000ms set to prevent hanging
 *
 * dependencies: jquery
 *
 */
window.onload = function() {
    setTimeout(function() {
        // XHR to request a JS and a CSS
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://domain.tld/preload.js');
        xhr.send('');
        xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://domain.tld/preload.css');
        xhr.send('');
        // preload image
        new Image().src = "http://domain.tld/preload.png";
    }, 1000);
};
