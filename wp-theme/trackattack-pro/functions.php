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
    add_theme_support( 'elementor' ); // Elementor support
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

/* ─── Elementor auto-setup (runs once on theme activation) ─── */
require_once get_template_directory() . '/inc/elementor-setup.php';

/* ─── Admin: re-run setup button ─── */
add_action( 'admin_notices', function () {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        echo '<div class="notice notice-warning"><p>'
           . '<strong>TrackAttack Pro:</strong> Please install and activate the free <a href="'
           . esc_url( admin_url( 'plugin-install.php?s=elementor&tab=search&type=term' ) )
           . '">Elementor</a> plugin, then <a href="' . esc_url( admin_url( '?tap_reset_setup=1' ) ) . '">click here to rebuild the homepage</a>.'
           . '</p></div>';
    }
} );

// Allow re-running setup via ?tap_reset_setup=1
add_action( 'admin_init', function () {
    if ( isset( $_GET['tap_reset_setup'] ) && current_user_can( 'manage_options' ) ) {
        delete_option( 'tap_elementor_setup_done' );
        tap_elementor_auto_setup();
        wp_redirect( admin_url() );
        exit;
    }
} );
