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
    register_nav_menus( [
        'main' => 'Main Menu',
    ] );
} );

/* ─── Elementor Pro Theme Builder: register header/footer/etc. locations ─── */
add_action( 'elementor/theme/register_locations', function ( $manager ) {
    $manager->register_all_core_location();
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
        'https://fonts.googleapis.com/css2?family=Anton&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Heebo:wght@400;500;700;800;900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap',
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

/* ─── Auto-reply to Elementor Pro form submitter (with early-bird prices) ─── */
add_action( 'elementor_pro/forms/new_record', function ( $record, $handler ) {
    // Only our contact form
    $form_name = $record->get_form_settings( 'form_name' );
    if ( $form_name !== 'TrackAttack Pro — צור קשר' ) return;

    $fields = $record->get( 'fields' );
    $name   = trim( $fields['name']['value']  ?? '' );
    $email  = trim( $fields['email']['value'] ?? '' );
    $sizes  = $fields['tire_sizes']['value']  ?? '';   // checkbox: comma/newline separated
    if ( ! is_email( $email ) ) return;

    $prices = require get_template_directory() . '/inc/launch-prices.php'; // size => early-bird price (ex-VAT)

    $selected = preg_split( '/\s*[,\n]\s*/', (string) $sizes, -1, PREG_SPLIT_NO_EMPTY );
    $price_rows = '';
    foreach ( $selected as $s ) {
        $s = trim( $s );
        if ( $s === '' ) continue;
        $p = $prices[ $s ] ?? null;
        if ( $p !== null ) {
            $ex_vat  = number_format( $p );
            $inc_vat = number_format( $p * 1.18 );
            $price_rows .= "
            <tr>
                <td style='padding:8px 0;border-bottom:1px solid #333;'>מידת הצמיג: <strong>{$s}</strong></td>
            </tr>
            <tr>
                <td style='padding:4px 0 16px;border-bottom:1px solid #222;color:#c084fc;'>
                    מחיר מכירה מוקדמת: <strong>&#x20AA;{$ex_vat}</strong> לצמיג ללא מע&quot;מ
                    &nbsp;(<strong>&#x20AA;{$inc_vat}</strong> לצמיג כולל מע&quot;מ)
                </td>
            </tr>";
        } else {
            $price_rows .= "
            <tr><td style='padding:8px 0;'>מידת הצמיג: <strong>{$s}</strong> — מחיר: TBC</td></tr>";
        }
    }

    $name_esc = esc_html( $name );
    $body = <<<HTML
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#0e0e0e;font-family:Arial,Helvetica,sans-serif;direction:rtl;text-align:right;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#0e0e0e;">
<tr><td align="center" style="padding:32px 16px;">
<table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#131313;border-radius:12px;overflow:hidden;border:1px solid #5d3f3e;">

  <!-- Header bar -->
  <tr><td style="background:linear-gradient(135deg,#8B3FD4,#6A1FB0);padding:20px 32px;">
    <p style="margin:0;color:#fff;font-size:22px;font-weight:bold;letter-spacing:1px;">TrackAttack Pro</p>
    <p style="margin:4px 0 0;color:rgba(255,255,255,.75);font-size:13px;">מחיר מוקדם — הראשונים על המסלול</p>
  </td></tr>

  <!-- Body -->
  <tr><td style="padding:32px;color:#e5e2e1;font-size:16px;line-height:1.8;">

    <p style="margin:0 0 20px;">שלום <strong>{$name_esc}</strong>,</p>

    <p style="margin:0 0 20px;">כיף לראות שגם אתה מחכה ל-TrackAttack Pro כמונו.</p>

    <p style="margin:0 0 20px;">השקענו המון כדי להביא צמיג שמספק את השילוב המושלם בין פידבק מטורף מההגה לבין אחיזה קשוחה ופנומנלית בפניות ובכלל – בדיוק מה שצריך כדי לגרד לפחות עוד כמה עשיריות שנייה מהלפ-טיים שלך.</p>

    <p style="margin:0 0 24px;">כמי שנרשם בדף הנחיתה, מגיע לך ליהנות ממחיר של &#x201C;הראשונים על המסלול&#x201D;. הנה ההצעה שלך:</p>

    <!-- Price table -->
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#1c1b1b;border-radius:8px;border:1px solid #3a3939;margin-bottom:28px;">
    <tr><td style="padding:16px 20px;">
      <table width="100%" cellpadding="0" cellspacing="0" style="direction:rtl;text-align:right;">
        {$price_rows}
      </table>
    </td></tr>
    </table>

    <p style="margin:0 0 20px;font-size:13px;color:#9e9e9e;border-right:3px solid #8B3FD4;padding-right:12px;">
      <strong>האותיות הקטנות (והטובות):</strong> ההטבה הזו ניתנת אך ורק למזמינים מראש לפני הגעת המשלוח הרשמי והמלאי להטבה הזו מוגבל בהחלט.
    </p>

    <p style="margin:0 0 28px;">ממש חבל לפספס את המחיר הזה ואז לרכוש במחיר מלא....</p>

    <p style="margin:0 0 8px;font-weight:bold;">רוצה לשריין את הסט שלך?</p>
    <p style="margin:0 0 32px;">השב למייל זה עם המילה &#x201C;מעוניין&#x201D; או שלח לנו הודעה ישירה לוואטסאפ כאן: <a href="[קישור לוואטסאפ]" style="color:#c084fc;">[וואטסאפ]</a></p>

    <p style="margin:0 0 4px;">נתראה על האספלט,</p>
    <p style="margin:0;color:#c084fc;font-weight:bold;">צוות PitStop / TrackAttack Pro</p>

  </td></tr>

  <!-- Footer -->
  <tr><td style="padding:16px 32px;background:#0e0e0e;text-align:center;font-size:11px;color:#555;">
    TrackAttack Pro &nbsp;|&nbsp; USDOT Street Legal
  </td></tr>

</table>
</td></tr>
</table>
</body>
</html>
HTML;

    wp_mail(
        $email,
        'TrackAttack Pro — מחיר מוקדם עבורך',
        $body,
        [ 'Content-Type: text/html; charset=UTF-8' ]
    );
}, 10, 2 );

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
