<?php
/**
 * Page Banner Image Template (Parallax)
 */
?>
<div id="page_header"<?php if ( has_post_thumbnail() ) {?> class="parallax" style="background-image:url(<?php the_post_thumbnail_url( 'full' ); ?>)"<?}?>>
    <h1><?=the_title(); ?></h1>
</div>
