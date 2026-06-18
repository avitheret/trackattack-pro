<?php
/**
 * Plugin Name: TAP Auto-Reply
 * Description: Early-bird price auto-reply for TrackAttack Pro contact form.
 * This file lives in mu-plugins — never overwritten by WP, theme, or plugin updates.
 * Edit the email HTML in: wp-content/mu-plugins/tap-autoreply-email.php
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'elementor_pro/forms/new_record', function ( $record, $handler ) {
    if ( $record->get_form_settings( 'form_name' ) !== 'TrackAttack Pro — צור קשר' ) return;

    $fields = $record->get( 'fields' );
    $name   = trim( $fields['name']['value']  ?? '' );
    $email  = trim( $fields['email']['value'] ?? '' );
    $sizes  = $fields['tire_sizes']['value']  ?? '';
    if ( ! is_email( $email ) ) return;

    // Prices (ex-VAT) — stored in theme inc/launch-prices.php
    $prices_file = get_template_directory() . '/inc/launch-prices.php';
    $prices = file_exists( $prices_file ) ? require $prices_file : [];

    $selected   = preg_split( '/\s*[,\n]\s*/', (string) $sizes, -1, PREG_SPLIT_NO_EMPTY );
    $price_rows = '';
    foreach ( $selected as $s ) {
        $s = trim( $s );
        if ( $s === '' ) continue;

        // Display format: "265/35 ZR18" → "265/35ZR18 TA PRO" (matches Excel col B)
        $display = preg_replace( '/\s+ZR/', 'ZR', $s ) . ' TA PRO';
        // Wrap in dir=ltr so RTL layout doesn't reverse the alphanumeric string
        $size_html = '<span dir="ltr" style="unicode-bidi:isolate;font-family:monospace;">' . esc_html( $display ) . '</span>';

        $p = $prices[ $s ] ?? null;
        if ( is_array( $p ) ) {
            // New format: [ex_vat, inc_vat] from Excel F & G
            [ $ex_vat, $inc_vat ] = $p;
            $ex_fmt  = number_format( $ex_vat );
            $inc_fmt = number_format( $inc_vat );
        } elseif ( is_numeric( $p ) ) {
            // Legacy single-value format
            $ex_fmt  = number_format( $p );
            $inc_fmt = number_format( $p * 1.18 );
        } else {
            $price_rows .= "<tr><td style='padding:8px 0;'>מידת הצמיג: <strong>{$size_html}</strong> — מחיר: TBC</td></tr>";
            continue;
        }
        $price_rows .=
            "<tr><td style='padding:8px 0;border-bottom:1px solid #333;'>מידת הצמיג: <strong>{$size_html}</strong></td></tr>" .
            "<tr><td style='padding:4px 0 16px;border-bottom:1px solid #222;color:#c084fc;'>" .
            "מחיר מכירה מוקדמת: <strong>&#x20AA;{$ex_fmt}</strong> לצמיג ללא מע&quot;מ" .
            " &nbsp;(<strong>&#x20AA;{$inc_fmt}</strong> לצמיג כולל מע&quot;מ)</td></tr>";
    }

    $name_esc = esc_html( $name );
    $body     = require __DIR__ . '/tap-autoreply-email.php';

    wp_mail(
        $email,
        'TrackAttack Pro — מחיר מוקדם עבורך',
        $body,
        [ 'Content-Type: text/html; charset=UTF-8' ]
    );
}, 10, 2 );
