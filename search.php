<?php
/**
 * Template Name: Search Results
 *
 * The search page showing all results
 *
 * @package tater
 */
get_header();

/**
 * search results logic
 */
global $query_string;
$query_args = explode("&", $query_string);
$search_query = [];

foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$the_query = new WP_Query($search_query);
?>
    <main>
    <div class="wrapper">
        <div id="content_left">
            <?php if ( have_posts() ) : ?>
                <h1><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                <ul>
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No results found. Please <a href="<?= get_home_url(); ?>/search" title="search page">search again</a>.</p>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>