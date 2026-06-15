<?php
/**
 * TrackAttack Pro — Customizer
 * Native WordPress. No plugins. Appearance → Customize → TrackAttack Pro.
 * Editable: all headlines, body text, and images. Live preview enabled.
 */

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {

    $panel = 'tap_panel';
    $wp->add_panel( $panel, [
        'title'       => '🏁 TrackAttack Pro',
        'description' => 'Edit page text and images. Changes preview live.',
        'priority'    => 1,
    ] );

    /* text/textarea control */
    $txt = function ( $id, $label, $section, $default = '', $textarea = false ) use ( $wp ) {
        $wp->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ] );
        $wp->add_control( $id, [
            'label'   => $label,
            'section' => $section,
            'type'    => $textarea ? 'textarea' : 'text',
        ] );
    };

    /* image control */
    $img = function ( $id, $label, $section ) use ( $wp ) {
        $wp->add_setting( $id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ] );
        $wp->add_control( new WP_Customize_Image_Control( $wp, $id, [
            'label'   => $label,
            'section' => $section,
        ] ) );
    };

    $sec = function ( $id, $title, $priority ) use ( $wp, $panel ) {
        $wp->add_section( $id, [ 'title' => $title, 'panel' => $panel, 'priority' => $priority ] );
    };

    /* 1. HERO */
    $sec( 'tap_s_hero', '🏁 Hero', 10 );
    $txt( 'tap_hero_heading',  'Heading',          'tap_s_hero', 'Conquer. Every. Drive.' );
    $txt( 'tap_hero_subtitle', 'Subtitle',         'tap_s_hero', 'Ultimate Track Day Weapon' );
    $img( 'tap_hero_image',    'Background Image', 'tap_s_hero' );
    $txt( 'tap_presented_by',  '"Presented By"',   'tap_s_hero', 'Presented By' );

    /* 2. FEATURES */
    $sec( 'tap_s_feat', '✅ Features', 20 );
    $img( 'tap_feat_img', 'Tire Image', 'tap_s_feat' );
    $fd = [
        'UTQG 200 rated Extreme Performance Summer tire',
        'Engineered for track dominance and street performance with Hoosier Racing DNA',
        'Addictive levels of responsiveness and handling',
        'Unrivaled grip derived from motorsports-proven compounds',
        'Adrenaline fueled acceleration fused with dynamic braking',
    ];
    for ( $i = 1; $i <= 5; $i++ ) {
        $txt( "tap_feature_{$i}", "Feature {$i} (use <strong>…</strong> for bold)", 'tap_s_feat', $fd[ $i - 1 ], true );
    }

    /* 3. GALLERY */
    $sec( 'tap_s_gal', '🚗 Gallery', 30 );
    $txt( 'tap_gallery_title',    'Title',    'tap_s_gal', 'For Drivers' );
    $txt( 'tap_gallery_subtitle', 'Subtitle', 'tap_s_gal', '...brings track dominance to the street' );
    $img( 'tap_gallery_img1',     'Image 1',  'tap_s_gal' );
    $img( 'tap_gallery_img2',     'Image 2',  'tap_s_gal' );

    /* 4. ABOUT */
    $sec( 'tap_s_about', '📖 About', 40 );
    $txt( 'tap_about_title', 'Title',            'tap_s_about', 'TrackAttack Pro' );
    $txt( 'tap_about_text',  'Body Text',        'tap_s_about', "...masters both street and track. Harnessing Hoosier's unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance.", true );
    $img( 'tap_about_bg',    'Background Image', 'tap_s_about' );

    /* 5. CTA BANNER */
    $sec( 'tap_s_cta', '📣 CTA Banner', 50 );
    $txt( 'tap_cta_heading', 'Heading',          'tap_s_cta', 'Revolutionary extreme performance summer tire' );
    $txt( 'tap_cta_text',    'Body Text',        'tap_s_cta', '...awakens daily commutes, empowers epic track days – and ignites legendary journeys in between.', true );
    $img( 'tap_cta_bg',      'Background Image', 'tap_s_cta' );

    /* 6. H-DNA */
    $sec( 'tap_s_hdna', '🧬 Hoosier DNA', 60 );
    $txt( 'tap_hdna_title', 'Title',     'tap_s_hdna', 'Hoosier DNA' );
    $txt( 'tap_hdna_text',  'Body Text', 'tap_s_hdna', 'Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.', true );
    $img( 'tap_hdna_image', 'Image',     'tap_s_hdna' );

    /* 7. TOTAL DOMINANCE */
    $sec( 'tap_s_dom', '🏆 Total Dominance', 70 );
    $txt( 'tap_dom_title', 'Title',     'tap_s_dom', 'Total Dominance Plan' );
    $txt( 'tap_dom_text',  'Body Text', 'tap_s_dom', 'Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive. Choose the Total Dominance Plan and elevate your driving experience to the next level.', true );

    /* 8. RESOURCES */
    $sec( 'tap_s_res', '📥 Resources', 80 );
    $txt( 'tap_res_banner', 'Banner Title',        'tap_s_res', 'TrackAttack Pro Resources' );
    $txt( 'tap_res1_title', 'Card 1 — Title',      'tap_s_res', 'Detailed Product Specifications' );
    $txt( 'tap_res1_text',  'Card 1 — Text',       'tap_s_res', 'TrackAttack Pro detailed product specifications can be downloaded here.', true );
    $txt( 'tap_res1_note',  'Card 1 — Note',       'tap_s_res', 'NOTE: All measurements are subject to change upon official size release.' );
    $txt( 'tap_res1_url',   'Card 1 — Download URL','tap_s_res', '' );
    $img( 'tap_res1_img',   'Card 1 — Image',      'tap_s_res' );
    $txt( 'tap_res2_title', 'Card 2 — Title',      'tap_s_res', 'Tire Care and Safety Guidelines' );
    $txt( 'tap_res2_text',  'Card 2 — Text',       'tap_s_res', 'Trackattack Pro detailed tire care procedures, best practices and safety guidelines.', true );
    $txt( 'tap_res2_url',   'Card 2 — Download URL','tap_s_res', '' );
    $img( 'tap_res2_img',   'Card 2 — Image',      'tap_s_res' );

    /* 9. CONTACT */
    $sec( 'tap_s_contact', '✉️ Contact Form', 90 );
    $txt( 'tap_contact_title', 'Section Title (Hebrew)', 'tap_s_contact', 'צרו קשר' );
    $txt( 'tap_contact_email', 'Recipient Email',        'tap_s_contact', 'avi.theret@gmail.com' );

    /* 10. HEADER & FOOTER */
    $sec( 'tap_s_global', '🌐 Header & Footer', 100 );
    $img( 'tap_header_logo', 'Header Logo',    'tap_s_global' );
    $txt( 'tap_cta_btn',     'Header CTA Text','tap_s_global', 'צרו קשר' );
    $txt( 'tap_version',     'Version Badge',  'tap_s_global', 'v5.6' );
    $img( 'tap_footer_logo', 'Footer Logo',    'tap_s_global' );
    $txt( 'tap_copyright',   'Footer Copyright','tap_s_global', '© Copyright Hoosier Racing Tire ' . date('Y') );
    $txt( 'tap_fb',          'Facebook URL',   'tap_s_global', 'https://www.facebook.com/hoosiertire/' );
    $txt( 'tap_ig',          'Instagram URL',  'tap_s_global', 'https://www.instagram.com/HoosierTire/' );
    $txt( 'tap_yt',          'YouTube URL',    'tap_s_global', 'https://www.youtube.com/c/HoosierTire' );
} );
