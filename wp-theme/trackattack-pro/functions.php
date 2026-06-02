<?php
/**
 * TrackAttack Pro — Theme Functions
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ─────────────────────────────────────────────
   THEME SETUP
───────────────────────────────────────────── */
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo', [ 'width' => 300, 'height' => 80, 'flex-width' => true ] );
    load_theme_textdomain( 'trackattack-pro', get_template_directory() . '/languages' );
} );

/* ─────────────────────────────────────────────
   ENQUEUE
───────────────────────────────────────────── */
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'tap-fonts',
        'https://fonts.googleapis.com/css2?family=Anton&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap',
        [], null
    );
    wp_enqueue_style(
        'tap-style',
        get_stylesheet_uri(),
        [ 'tap-fonts' ],
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_script(
        'tap-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [], wp_get_theme()->get( 'Version' ), true
    );

    // Tire sizes from JSON
    $tire_sizes = [];
    $json_file  = get_template_directory() . '/db/tire-sizes.json';
    if ( file_exists( $json_file ) ) {
        $decoded   = json_decode( file_get_contents( $json_file ), true );
        $tire_sizes = $decoded['items'] ?? [];
    }

    // Contact settings (ACF options if available)
    $contact_email   = tap_option( 'opt_contact_email',   'avi.theret@gmail.com' );
    $contact_subject = tap_field_page( 'contact_subject', 'TrackAttack Pro — טופס יצירת קשר' );
    $success_msg     = tap_field_page( 'contact_success_msg', 'הטופס נשלח בהצלחה! נחזור אליך בהקדם.' );

    wp_localize_script( 'tap-main', 'tapTheme', [
        'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
        'nonce'          => wp_create_nonce( 'tap_contact_nonce' ),
        'tireSizes'      => $tire_sizes,
        'imgUrl'         => get_template_directory_uri() . '/assets/images/',
        'contactEmail'   => $contact_email,
        'contactSubject' => $contact_subject,
        'i18n'           => [
            'selectSizes' => 'בחרו גדלים',
            'selected'    => 'גדלים נבחרו',
            'success'     => $success_msg,
            'error'       => 'שגיאה בשליחה — נסה שוב.',
        ],
    ] );
} );

/* ─────────────────────────────────────────────
   ACF FIELD HELPERS
   Fall back gracefully if ACF is not installed
───────────────────────────────────────────── */

/**
 * Get a field from the current page, with a default fallback.
 */
function tap_field_page( string $name, string $default = '' ): string {
    if ( function_exists( 'get_field' ) ) {
        $val = get_field( $name );
        if ( $val !== false && $val !== null && $val !== '' ) {
            return is_array( $val ) ? ( $val['url'] ?? $default ) : (string) $val;
        }
    }
    return $default;
}

/**
 * Get an image URL from an ACF image field on the current page.
 * Falls back to a theme asset filename.
 */
function tap_img( string $field_name, string $fallback_file = '' ): string {
    if ( function_exists( 'get_field' ) ) {
        $val = get_field( $field_name );
        if ( $val ) {
            if ( is_array( $val ) && ! empty( $val['url'] ) ) return esc_url( $val['url'] );
            if ( is_string( $val ) && $val ) return esc_url( $val );
        }
    }
    return $fallback_file
        ? esc_url( get_template_directory_uri() . '/assets/images/' . $fallback_file )
        : '';
}

/**
 * Get a global option (Theme Options page), with a default.
 */
function tap_option( string $name, string $default = '' ): string {
    if ( function_exists( 'get_field' ) ) {
        $val = get_field( $name, 'option' );
        if ( $val !== false && $val !== null && $val !== '' ) {
            return is_array( $val ) ? ( $val['url'] ?? $default ) : (string) $val;
        }
    }
    return $default;
}

/**
 * Get an image URL from a global option field.
 */
function tap_option_img( string $name, string $fallback_file = '' ): string {
    if ( function_exists( 'get_field' ) ) {
        $val = get_field( $name, 'option' );
        if ( $val ) {
            if ( is_array( $val ) && ! empty( $val['url'] ) ) return esc_url( $val['url'] );
            if ( is_string( $val ) && $val ) return esc_url( $val );
        }
    }
    return $fallback_file
        ? esc_url( get_template_directory_uri() . '/assets/images/' . $fallback_file )
        : '';
}

/**
 * Output a text field, escaped. Safe to use inside HTML attributes.
 */
function tap_e( string $field_name, string $default = '' ): void {
    echo esc_html( tap_field_page( $field_name, $default ) );
}

/**
 * Output a textarea field allowing <strong> tags only.
 */
function tap_html( string $field_name, string $default = '' ): void {
    $val = tap_field_page( $field_name, $default );
    echo wp_kses( $val, [ 'strong' => [], 'em' => [], 'br' => [] ] );
}

/* ─────────────────────────────────────────────
   ACF FIELDS REGISTRATION
───────────────────────────────────────────── */
add_action( 'init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;
    require_once get_template_directory() . '/inc/acf-fields.php';
}, 20 );

/* ACF sync directory */
add_filter( 'acf/settings/save_json', function () {
    return get_template_directory() . '/acf-json';
} );
add_filter( 'acf/settings/load_json', function ( $paths ) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
} );

/* Admin notice if ACF is not installed */
add_action( 'admin_notices', function () {
    if ( function_exists( 'acf' ) ) return;
    echo '<div class="notice notice-warning is-dismissible"><p>';
    echo '<strong>TrackAttack Pro Theme:</strong> Install the free <a href="' . esc_url( admin_url( 'plugin-install.php?s=advanced+custom+fields&tab=search&type=term' ) ) . '">Advanced Custom Fields</a> plugin to enable page editing.';
    echo '</p></div>';
} );

/* ─────────────────────────────────────────────
   CONTACT FORM AJAX
───────────────────────────────────────────── */
add_action( 'wp_ajax_tap_contact',        'tap_contact_handler' );
add_action( 'wp_ajax_nopriv_tap_contact', 'tap_contact_handler' );

function tap_contact_handler(): void {
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

    // Editable recipient + subject via ACF
    $to      = tap_field_page( 'contact_email',   'avi.theret@gmail.com' );
    $subject = tap_field_page( 'contact_subject', 'TrackAttack Pro — טופס יצירת קשר' );

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
    $sent ? wp_send_json_success() : wp_send_json_error( 'שגיאה בשליחת הטופס, נסה שוב.' );
}
