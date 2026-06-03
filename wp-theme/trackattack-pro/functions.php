<?php
/**
 * TrackAttack Pro — Theme Functions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ─── Theme Setup ─── */
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'elementor' );
} );

/* ─── Editable-content helpers (read from Customizer) ─── */

/** Echo an editable text value (Customizer → default). Allows <strong>/<em>/<br>. */
function tap_text( string $id, string $default = '' ): void {
    $val = get_theme_mod( $id, $default );
    echo wp_kses( $val, [ 'strong' => [], 'em' => [], 'br' => [] ] );
}

/** Return a raw editable text value (for attributes). */
function tap_text_raw( string $id, string $default = '' ): string {
    return (string) get_theme_mod( $id, $default );
}

/** Return an editable image URL (Customizer → theme asset fallback). */
function tap_image( string $id, string $fallback_file = '' ): string {
    $val = get_theme_mod( $id, '' );
    if ( $val ) return esc_url( $val );
    return $fallback_file
        ? esc_url( get_template_directory_uri() . '/assets/images/' . $fallback_file )
        : '';
}

/* ─── Customizer controls ─── */
require_once get_template_directory() . '/inc/customizer.php';

/* ─── Auto-create & assign the homepage on activation ─── */
add_action( 'after_switch_theme', function () {
    // Find or create the homepage
    $existing = get_posts( [
        'post_type'   => 'page',
        'post_status' => 'publish',
        'meta_key'    => '_tap_homepage',
        'meta_value'  => '1',
        'numberposts' => 1,
    ] );
    if ( $existing ) {
        $page_id = $existing[0]->ID;
    } else {
        $page_id = wp_insert_post( [
            'post_title'  => 'TrackAttack Pro',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_tap_homepage', '1' );
        }
    }
    if ( $page_id && ! is_wp_error( $page_id ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $page_id );
    }
} );

/* ─── Enqueue Styles & Scripts ─── */
add_action( 'wp_enqueue_scripts', function () {
    // Google Fonts
    wp_enqueue_style(
        'tap-fonts',
        'https://fonts.googleapis.com/css2?family=Anton&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap',
        [], null
    );
    // Theme stylesheet (design system tokens + component CSS)
    wp_enqueue_style(
        'tap-style',
        get_stylesheet_uri(),
        [ 'tap-fonts' ],
        wp_get_theme()->get( 'Version' )
    );
    // Main JS (scroll FX + tire sizes multiselect + AJAX contact form)
    wp_enqueue_script(
        'tap-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [], wp_get_theme()->get( 'Version' ), true
    );

    // Tire sizes from JSON → passed to JS
    $tire_sizes = [];
    $json_file  = get_template_directory() . '/db/tire-sizes.json';
    if ( file_exists( $json_file ) ) {
        $decoded    = json_decode( file_get_contents( $json_file ), true );
        $tire_sizes = $decoded['items'] ?? [];
    }

    wp_localize_script( 'tap-main', 'tapTheme', [
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'tap_contact_nonce' ),
        'tireSizes' => $tire_sizes,
        'i18n'      => [
            'selectSizes' => 'בחרו גדלים',
            'selected'    => 'גדלים נבחרו',
            'success'     => 'הטופס נשלח בהצלחה! נחזור אליך בהקדם.',
            'error'       => 'שגיאה בשליחה — נסה שוב.',
        ],
    ] );
} );

/* ─── Contact Form AJAX ─── */
add_action( 'wp_ajax_tap_contact',        'tap_contact_handler' );
add_action( 'wp_ajax_nopriv_tap_contact', 'tap_contact_handler' );

function tap_contact_handler(): void {
    if ( ! wp_verify_nonce( $_POST['nonce'] ?? '', 'tap_contact_nonce' ) ) {
        wp_send_json_error( 'Invalid nonce' );
    }

    $name         = sanitize_text_field(     $_POST['name']         ?? '' );
    $email        = sanitize_email(          $_POST['email']        ?? '' );
    $phone        = sanitize_text_field(     $_POST['phone']        ?? '' );
    $manufacturer = sanitize_text_field(     $_POST['manufacturer'] ?? '' );
    $model        = sanitize_text_field(     $_POST['model']        ?? '' );
    $year         = sanitize_text_field(     $_POST['year']         ?? '' );
    $tire_sizes   = sanitize_text_field(     $_POST['tire_sizes']   ?? '' );
    $notes        = sanitize_textarea_field( $_POST['notes']        ?? '' );

    if ( empty( $name ) || ! is_email( $email ) ) {
        wp_send_json_error( 'שם ואימייל הם שדות חובה.' );
    }

    $to      = 'avi.theret@gmail.com';
    $subject = 'TrackAttack Pro — טופס יצירת קשר';
    $body    = "שם: {$name}\nאימייל: {$email}\nטלפון: {$phone}\n\n"
             . "יצרן: {$manufacturer}\nדגם: {$model}\nשנת ייצור: {$year}\n"
             . "גדלים: {$tire_sizes}\nהערות: {$notes}";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>" ];

    wp_mail( $to, $subject, $body, $headers )
        ? wp_send_json_success( 'הטופס נשלח בהצלחה!' )
        : wp_send_json_error( 'שגיאה בשליחת הטופס.' );
}

/* ─── Admin hint: where to edit ─── */
add_action( 'admin_notices', function () {
    if ( ! current_user_can( 'edit_theme_options' ) ) return;
    $screen = get_current_screen();
    if ( $screen && $screen->id === 'dashboard' ) {
        echo '<div class="notice notice-info"><p>'
           . '<strong>TrackAttack Pro:</strong> Edit all page text and images at '
           . '<a href="' . esc_url( admin_url( 'customize.php' ) ) . '">Appearance → Customize → TrackAttack Pro</a> (live preview).'
           . '</p></div>';
    }
} );
