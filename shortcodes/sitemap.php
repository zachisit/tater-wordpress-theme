<?php
/**
 * Sitemap Shortcode
 * @return string/
 */
function ncherm_sitemap_page($atts){
    return "<h2>Sitemap</h2><ul>".wp_list_pages('title_li=&echo=0')."</ul>";
}
add_shortcode('sitemap', 'ncherm_sitemap_page');
