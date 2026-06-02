<?php
/**
 * TrackAttack Pro — Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ─── Theme Setup ─── */
add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo', [ 'width' => 300, 'height' => 80, 'flex-width' => true ] );
    load_theme_textdomain( 'trackattack-pro', get_template_directory() . '/languages' );
});

/* ─── Enqueue Scripts & Styles ─── */
add_action( 'wp_enqueue_scripts', function() {
    // Google Fonts
    wp_enqueue_style(
        'tap-fonts',
        'https://fonts.googleapis.com/css2?family=Anton&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap',
        [],
        null
    );

    // Main theme stylesheet
    wp_enqueue_style(
        'tap-style',
        get_stylesheet_uri(),
        [ 'tap-fonts' ],
        wp_get_theme()->get( 'Version' )
    );

    // Main JS
    wp_enqueue_script(
        'tap-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get( 'Version' ),
        true   // load in footer
    );

    // Load tire sizes JSON and pass AJAX data to JS
    $tire_sizes_file = get_template_directory() . '/db/tire-sizes.json';
    $tire_sizes      = [];
    if ( file_exists( $tire_sizes_file ) ) {
        $json        = file_get_contents( $tire_sizes_file );
        $decoded     = json_decode( $json, true );
        $tire_sizes  = $decoded['items'] ?? [];
    }

    wp_localize_script( 'tap-main', 'tapTheme', [
        'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
        'nonce'      => wp_create_nonce( 'tap_contact_nonce' ),
        'tireSizes'  => $tire_sizes,
        'imgUrl'     => get_template_directory_uri() . '/assets/images/',
        'i18n'       => [
            'selectSizes' => 'בחרו גדלים',
            'selected'    => 'גדלים נבחרו',
            'success'     => 'הטופס נשלח בהצלחה! נחזור אליך בהקדם.',
            'error'       => 'שגיאה בשליחה — נסה שוב.',
        ],
    ]);
});

/* ─── Contact Form AJAX Handler ─── */
add_action( 'wp_ajax_tap_contact',        'tap_contact_handler' );
add_action( 'wp_ajax_nopriv_tap_contact', 'tap_contact_handler' );

function tap_contact_handler() {
    if ( ! wp_verify_nonce( $_POST['nonce'] ?? '', 'tap_contact_nonce' ) ) {
        wp_send_json_error( 'Invalid nonce' );
    }

    $name         = sanitize_text_field( $_POST['name']         ?? '' );
    $email        = sanitize_email(      $_POST['email']        ?? '' );
    $phone        = sanitize_text_field( $_POST['phone']        ?? '' );
    $manufacturer = sanitize_text_field( $_POST['manufacturer'] ?? '' );
    $model        = sanitize_text_field( $_POST['model']        ?? '' );
    $year         = sanitize_text_field( $_POST['year']         ?? '' );
    $tire_sizes   = sanitize_text_field( $_POST['tire_sizes']   ?? '' );
    $notes        = sanitize_textarea_field( $_POST['notes']    ?? '' );

    if ( empty( $name ) || ! is_email( $email ) ) {
        wp_send_json_error( 'שם ואימייל הם שדות חובה.' );
    }

    $to      = 'avi.theret@gmail.com';
    $subject = 'TrackAttack Pro — טופס יצירת קשר';

    $body  = "שם מלא: {$name}\n";
    $body .= "אימייל: {$email}\n";
    $body .= "טלפון: {$phone}\n\n";
    $body .= "יצרן: {$manufacturer}\n";
    $body .= "דגם: {$model}\n";
    $body .= "שנת ייצור: {$year}\n";
    $body .= "גדלי צמיגים: {$tire_sizes}\n";
    $body .= "הערות: {$notes}\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( 'הטופס נשלח בהצלחה!' );
    } else {
        wp_send_json_error( 'שגיאה בשליחת הטופס, נסה שוב.' );
    }
}

/* ─── PDF Download Rewrite (optional) ─── */
// Allows /resources/specs and /resources/care-guide to serve the PDFs
add_filter( 'query_vars', function( $vars ) {
    $vars[] = 'tap_download';
    return $vars;
});
