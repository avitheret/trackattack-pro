<?php
/**
 * Front page.
 * If the page is built with Elementor (and has content), let Elementor render it.
 * Otherwise render the full static design from inc/static-front.php.
 */

$use_elementor = false;
if ( did_action( 'elementor/loaded' )
     && class_exists( '\Elementor\Plugin' )
     && have_posts() ) {
    $pid = get_queried_object_id();
    $doc = \Elementor\Plugin::$instance->documents->get( $pid );
    if ( $doc && $doc->is_built_with_elementor() ) {
        // Confirm it actually has elements, not an empty canvas
        $data = $doc->get_elements_data();
        if ( ! empty( $data ) ) {
            $use_elementor = true;
        }
    }
}

if ( $use_elementor ) {
    get_header();
    echo '<main id="content">';
    while ( have_posts() ) { the_post(); the_content(); }
    echo '</main>';
    get_footer();
} else {
    // Full static design (guaranteed to render)
    get_header();
    include get_template_directory() . '/inc/static-front.php';
    get_footer();
}
