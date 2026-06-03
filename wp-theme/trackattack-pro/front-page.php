<?php
/**
 * Front page.
 * If the homepage was built with Elementor, render its content.
 * Otherwise render the full static design (inc/static-front.php),
 * editable via Appearance → Customize.
 */

$use_elementor = false;
if ( did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' ) && have_posts() ) {
    $pid = get_queried_object_id();
    $doc = \Elementor\Plugin::$instance->documents->get( $pid );
    if ( $doc && $doc->is_built_with_elementor() ) {
        $data = $doc->get_elements_data();
        if ( ! empty( $data ) ) {
            $use_elementor = true;
        }
    }
}

get_header();

if ( $use_elementor ) {
    echo '<main id="content">';
    while ( have_posts() ) { the_post(); the_content(); }
    echo '</main>';
} else {
    include get_template_directory() . '/inc/static-front.php';
}

get_footer();
