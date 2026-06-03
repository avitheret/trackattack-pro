<?php
/**
 * Fallback template.
 * On the homepage, render the full TrackAttack Pro design so the site
 * works even before a static front page is assigned.
 */
get_header();

if ( is_front_page() || is_home() ) {
    include get_template_directory() . '/inc/static-front.php';
} else {
    echo '<main id="content" style="max-width:var(--container-max);margin:80px auto;padding:0 var(--margin-desktop);color:var(--on-surface);">';
    if ( have_posts() ) {
        while ( have_posts() ) { the_post(); the_content(); }
    }
    echo '</main>';
}

get_footer();
