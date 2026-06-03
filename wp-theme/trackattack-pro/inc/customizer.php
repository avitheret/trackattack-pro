<?php
/**
 * TrackAttack Pro — WordPress Customizer
 * No plugins required. Appearance → Customize to edit everything.
 */

add_action( 'customize_register', 'tap_customizer_register' );

function tap_customizer_register( WP_Customize_Manager $c ): void {

    /* ── helpers ── */
    $txt = function ( $id, $label, $section, $default = '', $type = 'text' ) use ( $c ) {
        $c->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ] );
        $c->add_control( $id, [ 'label' => $label, 'section' => $section, 'type' => $type ] );
    };

    $img = function ( $id, $label, $section ) use ( $c ) {
        $c->add_setting( $id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ] );
        $c->add_control( new WP_Customize_Image_Control( $c, $id, [
            'label'   => $label,
            'section' => $section,
        ] ) );
    };

    /* ── panel ── */
    $c->add_panel( 'tap', [
        'title'    => 'TrackAttack Pro',
        'priority' => 5,
    ] );

    /* ─────────────────────────────────────────
       1. HERO
    ───────────────────────────────────────── */
    $c->add_section( 'tap_hero', [ 'title' => '🏁 Hero', 'panel' => 'tap', 'priority' => 10 ] );
    $txt( 'tap_hero_heading',    'Heading',               'tap_hero', 'Conquer. Every. Drive.' );
    $txt( 'tap_hero_subtitle',   'Subtitle',              'tap_hero', 'Ultimate Track Day Weapon' );
    $img( 'tap_hero_image',      'Background Image',      'tap_hero' );
    $txt( 'tap_presented_by',    '"Presented By" Text',   'tap_hero', 'Presented By' );

    /* ─────────────────────────────────────────
       2. FEATURES
    ───────────────────────────────────────── */
    $c->add_section( 'tap_features', [ 'title' => '✅ Features', 'panel' => 'tap', 'priority' => 20 ] );
    $img( 'tap_feat_img', 'Tire Product Image', 'tap_features' );
    $feat_defaults = [
        1 => '<strong>UTQG 200</strong> rated <strong>Extreme Performance Summer</strong> tire',
        2 => 'Engineered for <strong>track dominance</strong> and <strong>street performance</strong> with <strong>Hoosier Racing DNA</strong>',
        3 => 'Addictive levels of <strong>responsiveness</strong> and <strong>handling</strong>',
        4 => '<strong>Unrivaled grip</strong> derived from motorsports-proven compounds',
        5 => '<strong>Adrenaline fueled acceleration</strong> fused with <strong>dynamic braking</strong>',
    ];
    for ( $i = 1; $i <= 5; $i++ ) {
        $txt( "tap_feature_{$i}", "Feature {$i} (supports <strong>bold</strong>)", 'tap_features', $feat_defaults[$i], 'textarea' );
    }

    /* ─────────────────────────────────────────
       3. VIDEO
    ───────────────────────────────────────── */
    $c->add_section( 'tap_video', [ 'title' => '▶️ Video', 'panel' => 'tap', 'priority' => 30 ] );
    $txt( 'tap_video_url', 'Video URL (YouTube / Vimeo)', 'tap_video', '' );
    $img( 'tap_video_bg',  'Background Image',            'tap_video' );

    /* ─────────────────────────────────────────
       4. TECH CALLOUTS
    ───────────────────────────────────────── */
    $c->add_section( 'tap_callouts', [ 'title' => '⚙️ Tech Callouts', 'panel' => 'tap', 'priority' => 40 ] );
    $callout_defaults = [
        1 => '<strong>Extra-wide shoulder ribs</strong> maximize cornering performance',
        2 => '<strong>Featherlight construction</strong> provides peak responsiveness',
        3 => '<strong>H-DNA technology:</strong> 65+ years of Hoosier Racing DNA',
        4 => '<strong>Optimized center rib</strong> for increased braking performance',
        5 => '<strong>Motorsports derived compound</strong>',
    ];
    for ( $i = 1; $i <= 5; $i++ ) {
        $txt( "tap_callout_{$i}", "Callout {$i}", 'tap_callouts', $callout_defaults[$i], 'textarea' );
    }

    /* ─────────────────────────────────────────
       5. GALLERY
    ───────────────────────────────────────── */
    $c->add_section( 'tap_gallery', [ 'title' => '🚗 Gallery', 'panel' => 'tap', 'priority' => 50 ] );
    $txt( 'tap_gal_title',    'Section Title', 'tap_gallery', 'For Drivers' );
    $txt( 'tap_gal_subtitle', 'Subtitle',      'tap_gallery', '...brings track dominance to the street' );
    $img( 'tap_gal_img1',     'Image 1',       'tap_gallery' );
    $img( 'tap_gal_img2',     'Image 2',       'tap_gallery' );

    /* ─────────────────────────────────────────
       6. ABOUT
    ───────────────────────────────────────── */
    $c->add_section( 'tap_about', [ 'title' => '📖 About', 'panel' => 'tap', 'priority' => 60 ] );
    $txt( 'tap_about_title', 'Title',            'tap_about', 'TrackAttack Pro' );
    $txt( 'tap_about_text',  'Body Text',        'tap_about', "...masters both street and track. Harnessing Hoosier's unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance.", 'textarea' );
    $img( 'tap_about_bg',    'Background Image', 'tap_about' );

    /* ─────────────────────────────────────────
       7. CTA BANNER
    ───────────────────────────────────────── */
    $c->add_section( 'tap_cta', [ 'title' => '📣 CTA Banner', 'panel' => 'tap', 'priority' => 70 ] );
    $txt( 'tap_cta_heading', 'Heading',         'tap_cta', 'Revolutionary extreme performance summer tire' );
    $txt( 'tap_cta_text',    'Body Text',       'tap_cta', '...awakens daily commutes, empowers epic track days – and ignites legendary journeys in between.', 'textarea' );
    $img( 'tap_cta_bg',      'Background Image','tap_cta' );

    /* ─────────────────────────────────────────
       8. H-DNA
    ───────────────────────────────────────── */
    $c->add_section( 'tap_hdna', [ 'title' => '🧬 Hoosier DNA', 'panel' => 'tap', 'priority' => 80 ] );
    $txt( 'tap_hdna_title', 'Title',     'tap_hdna', 'Hoosier DNA' );
    $txt( 'tap_hdna_text',  'Body Text', 'tap_hdna', 'Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.', 'textarea' );
    $img( 'tap_hdna_image', 'H-DNA Image','tap_hdna' );

    /* ─────────────────────────────────────────
       9. TOTAL DOMINANCE
    ───────────────────────────────────────── */
    $c->add_section( 'tap_dominance', [ 'title' => '🏆 Total Dominance', 'panel' => 'tap', 'priority' => 90 ] );
    $txt( 'tap_dom_title', 'Title',     'tap_dominance', 'Total Dominance Plan' );
    $txt( 'tap_dom_text',  'Body Text', 'tap_dominance', 'Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive.', 'textarea' );

    /* ─────────────────────────────────────────
       10. RESOURCES
    ───────────────────────────────────────── */
    $c->add_section( 'tap_resources', [ 'title' => '📥 Resources', 'panel' => 'tap', 'priority' => 100 ] );
    $txt( 'tap_res_title',  'Banner Title',       'tap_resources', 'TrackAttack Pro Resources' );
    $txt( 'tap_res1_title', 'Resource 1 — Title', 'tap_resources', 'Detailed Product Specifications' );
    $txt( 'tap_res1_text',  'Resource 1 — Text',  'tap_resources', 'TrackAttack Pro detailed product specifications can be downloaded here.', 'textarea' );
    $txt( 'tap_res1_note',  'Resource 1 — Note',  'tap_resources', 'NOTE: All measurements are subject to change upon official size release.' );
    $txt( 'tap_res1_url',   'Resource 1 — PDF URL','tap_resources', '' );
    $img( 'tap_res1_img',   'Resource 1 — Image', 'tap_resources' );
    $txt( 'tap_res2_title', 'Resource 2 — Title', 'tap_resources', 'Tire Care and Safety Guidelines' );
    $txt( 'tap_res2_text',  'Resource 2 — Text',  'tap_resources', 'Trackattack Pro detailed tire care procedures, best practices and safety guidelines.', 'textarea' );
    $txt( 'tap_res2_url',   'Resource 2 — PDF URL','tap_resources', '' );
    $img( 'tap_res2_img',   'Resource 2 — Image', 'tap_resources' );

    /* ─────────────────────────────────────────
       11. CONTACT FORM
    ───────────────────────────────────────── */
    $c->add_section( 'tap_contact', [ 'title' => '✉️ Contact Form', 'panel' => 'tap', 'priority' => 110 ] );
    $txt( 'tap_contact_title',   'Section Title',   'tap_contact', 'צרו קשר' );
    $txt( 'tap_contact_email',   'Recipient Email', 'tap_contact', 'avi.theret@gmail.com' );
    $txt( 'tap_contact_subject', 'Email Subject',   'tap_contact', 'TrackAttack Pro — טופס יצירת קשר' );
    $txt( 'tap_contact_success', 'Success Message', 'tap_contact', 'הטופס נשלח בהצלחה! נחזור אליך בהקדם.' );

    /* ─────────────────────────────────────────
       12. GLOBAL — HEADER / FOOTER
    ───────────────────────────────────────── */
    $c->add_section( 'tap_global', [ 'title' => '🌐 Header & Footer', 'panel' => 'tap', 'priority' => 120 ] );
    $txt( 'tap_cta_btn_text', 'Header CTA Button Text', 'tap_global', 'צרו קשר' );
    $txt( 'tap_version',      'Version Badge',          'tap_global', 'v4.0' );
    $img( 'tap_header_logo',  'Header Logo',            'tap_global' );
    $img( 'tap_footer_logo',  'Footer Logo',            'tap_global' );
    $txt( 'tap_copyright',    'Footer Copyright',       'tap_global', '© Copyright Hoosier Racing Tire 2024' );
    $txt( 'tap_fb_url',       'Facebook URL',           'tap_global', 'https://www.facebook.com/hoosiertire/' );
    $txt( 'tap_ig_url',       'Instagram URL',          'tap_global', 'https://www.instagram.com/HoosierTire/' );
    $txt( 'tap_yt_url',       'YouTube URL',            'tap_global', 'https://www.youtube.com/c/HoosierTire' );
}
