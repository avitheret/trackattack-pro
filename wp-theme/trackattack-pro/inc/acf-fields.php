<?php
/**
 * ACF Local Field Group Registration — Free ACF compatible only.
 * Uses only: text, textarea, image, url, email, file (no Repeater, no Options Pages).
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

// Show fields when editing any Page
$loc = [[[ 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ]]];

/* ─────────────────────────────────────────────
   1. HERO
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_hero',
    'title'      => '🏁 Hero Section',
    'menu_order' => 10,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_hero_heading',   'label' => 'Heading',            'name' => 'hero_heading',   'type' => 'text',  'default_value' => 'Conquer. Every. Drive.' ],
        [ 'key' => 'field_tap_hero_subtitle',  'label' => 'Subtitle',           'name' => 'hero_subtitle',  'type' => 'text',  'default_value' => 'Ultimate Track Day Weapon' ],
        [ 'key' => 'field_tap_hero_image',     'label' => 'Background Image',   'name' => 'hero_image',     'type' => 'image', 'return_format' => 'url', 'instructions' => 'Min 1920×1080px recommended.' ],
        [ 'key' => 'field_tap_presented_by',   'label' => '"Presented By" Text','name' => 'presented_by_text', 'type' => 'text', 'default_value' => 'Presented By' ],
    ],
]);

/* ─────────────────────────────────────────────
   2. FEATURES (5 fixed items — free ACF)
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_features',
    'title'      => '✅ Features Section',
    'menu_order' => 20,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_feat_img',  'label' => 'Tire Image',    'name' => 'features_tire_image', 'type' => 'image', 'return_format' => 'url' ],
        [ 'key' => 'field_tap_feat_1',    'label' => 'Feature 1',     'name' => 'feature_1', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>UTQG 200</strong> rated <strong>Extreme Performance Summer</strong> tire', 'instructions' => 'Supports <strong>bold</strong> tags.' ],
        [ 'key' => 'field_tap_feat_2',    'label' => 'Feature 2',     'name' => 'feature_2', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Engineered for <strong>track dominance</strong> and <strong>street performance</strong> with <strong>Hoosier Racing DNA</strong>' ],
        [ 'key' => 'field_tap_feat_3',    'label' => 'Feature 3',     'name' => 'feature_3', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Addictive levels of <strong>responsiveness</strong> and <strong>handling</strong>' ],
        [ 'key' => 'field_tap_feat_4',    'label' => 'Feature 4',     'name' => 'feature_4', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>Unrivaled grip</strong> derived from motorsports-proven compounds' ],
        [ 'key' => 'field_tap_feat_5',    'label' => 'Feature 5',     'name' => 'feature_5', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>Adrenaline fueled acceleration</strong> fused with <strong>dynamic braking</strong>' ],
    ],
]);

/* ─────────────────────────────────────────────
   3. VIDEO
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_video',
    'title'      => '▶️ Video Section',
    'menu_order' => 30,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_video_url', 'label' => 'Video URL (YouTube / Vimeo)', 'name' => 'video_url', 'type' => 'url' ],
        [ 'key' => 'field_tap_video_bg',  'label' => 'Background Image',            'name' => 'video_background', 'type' => 'image', 'return_format' => 'url' ],
    ],
]);

/* ─────────────────────────────────────────────
   4. TECH CALLOUTS (5 fixed items)
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_callouts',
    'title'      => '⚙️ Technology Callouts',
    'menu_order' => 40,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_callout_1', 'label' => 'Callout 1', 'name' => 'callout_1', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>Extra-wide shoulder ribs</strong> maximize cornering performance' ],
        [ 'key' => 'field_tap_callout_2', 'label' => 'Callout 2', 'name' => 'callout_2', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>Featherlight construction</strong> provides peak responsiveness' ],
        [ 'key' => 'field_tap_callout_3', 'label' => 'Callout 3', 'name' => 'callout_3', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>H-DNA technology:</strong> 65+ years of Hoosier Racing DNA' ],
        [ 'key' => 'field_tap_callout_4', 'label' => 'Callout 4', 'name' => 'callout_4', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>Optimized center rib</strong> for increased braking performance' ],
        [ 'key' => 'field_tap_callout_5', 'label' => 'Callout 5', 'name' => 'callout_5', 'type' => 'textarea', 'rows' => 2, 'default_value' => '<strong>Motorsports derived compound</strong>' ],
    ],
]);

/* ─────────────────────────────────────────────
   5. GALLERY — FOR DRIVERS
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_gallery',
    'title'      => '🚗 Gallery — For Drivers',
    'menu_order' => 50,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_gal_title',    'label' => 'Section Title', 'name' => 'gallery_title',    'type' => 'text',  'default_value' => 'For Drivers' ],
        [ 'key' => 'field_tap_gal_subtitle', 'label' => 'Subtitle',      'name' => 'gallery_subtitle', 'type' => 'text',  'default_value' => '...brings track dominance to the street' ],
        [ 'key' => 'field_tap_gal_img1',     'label' => 'Image 1',       'name' => 'gallery_image_1',  'type' => 'image', 'return_format' => 'array' ],
        [ 'key' => 'field_tap_gal_img2',     'label' => 'Image 2',       'name' => 'gallery_image_2',  'type' => 'image', 'return_format' => 'array' ],
    ],
]);

/* ─────────────────────────────────────────────
   6. ABOUT
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_about',
    'title'      => '📖 About Section',
    'menu_order' => 60,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_about_title', 'label' => 'Title',            'name' => 'about_title',      'type' => 'text',     'default_value' => 'TrackAttack Pro' ],
        [ 'key' => 'field_tap_about_text',  'label' => 'Body Text',        'name' => 'about_text',       'type' => 'textarea', 'rows' => 4, 'default_value' => "...masters both street and track. Harnessing Hoosier's unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance." ],
        [ 'key' => 'field_tap_about_bg',    'label' => 'Background Image', 'name' => 'about_background', 'type' => 'image',    'return_format' => 'url' ],
    ],
]);

/* ─────────────────────────────────────────────
   7. CTA BANNER
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_cta',
    'title'      => '📣 CTA Banner',
    'menu_order' => 70,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_cta_heading', 'label' => 'Heading',         'name' => 'cta_heading',    'type' => 'text',     'default_value' => 'Revolutionary extreme performance summer tire' ],
        [ 'key' => 'field_tap_cta_text',    'label' => 'Body Text',       'name' => 'cta_text',       'type' => 'textarea', 'rows' => 3, 'default_value' => '...awakens daily commutes, empowers epic track days – and ignites legendary journeys in between.' ],
        [ 'key' => 'field_tap_cta_bg',      'label' => 'Background Image','name' => 'cta_background', 'type' => 'image',    'return_format' => 'url' ],
    ],
]);

/* ─────────────────────────────────────────────
   8. H-DNA
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_hdna',
    'title'      => '🧬 Hoosier DNA',
    'menu_order' => 80,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_hdna_title', 'label' => 'Title',     'name' => 'hdna_title', 'type' => 'text',     'default_value' => 'Hoosier DNA' ],
        [ 'key' => 'field_tap_hdna_text',  'label' => 'Body Text', 'name' => 'hdna_text',  'type' => 'textarea', 'rows' => 5, 'default_value' => 'Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.' ],
        [ 'key' => 'field_tap_hdna_image', 'label' => 'H-DNA Image','name' => 'hdna_image', 'type' => 'image',   'return_format' => 'url' ],
    ],
]);

/* ─────────────────────────────────────────────
   9. TOTAL DOMINANCE
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_dominance',
    'title'      => '🏆 Total Dominance',
    'menu_order' => 90,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_dom_title', 'label' => 'Title',     'name' => 'dominance_title', 'type' => 'text',     'default_value' => 'Total Dominance Plan' ],
        [ 'key' => 'field_tap_dom_text',  'label' => 'Body Text', 'name' => 'dominance_text',  'type' => 'textarea', 'rows' => 5, 'default_value' => 'Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive.' ],
    ],
]);

/* ─────────────────────────────────────────────
   10. RESOURCES
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_resources',
    'title'      => '📥 Resources Section',
    'menu_order' => 100,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_res_banner', 'label' => 'Banner Title',       'name' => 'resources_title',   'type' => 'text',     'default_value' => 'TrackAttack Pro Resources' ],
        [ 'key' => 'field_tap_res1_title', 'label' => 'Resource 1 — Title', 'name' => 'resource_1_title',  'type' => 'text',     'default_value' => 'Detailed Product Specifications' ],
        [ 'key' => 'field_tap_res1_text',  'label' => 'Resource 1 — Text',  'name' => 'resource_1_text',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'TrackAttack Pro detailed product specifications can be downloaded here.' ],
        [ 'key' => 'field_tap_res1_note',  'label' => 'Resource 1 — Note',  'name' => 'resource_1_note',   'type' => 'text',     'default_value' => 'NOTE: All measurements are subject to change upon official size release.' ],
        [ 'key' => 'field_tap_res1_file',  'label' => 'Resource 1 — PDF',   'name' => 'resource_1_file',   'type' => 'file',     'return_format' => 'url', 'mime_types' => 'pdf' ],
        [ 'key' => 'field_tap_res1_img',   'label' => 'Resource 1 — Image', 'name' => 'resource_1_image',  'type' => 'image',    'return_format' => 'url' ],
        [ 'key' => 'field_tap_res2_title', 'label' => 'Resource 2 — Title', 'name' => 'resource_2_title',  'type' => 'text',     'default_value' => 'Tire Care and Safety Guidelines' ],
        [ 'key' => 'field_tap_res2_text',  'label' => 'Resource 2 — Text',  'name' => 'resource_2_text',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'Trackattack Pro detailed tire care procedures, best practices and safety guidelines.' ],
        [ 'key' => 'field_tap_res2_file',  'label' => 'Resource 2 — PDF',   'name' => 'resource_2_file',   'type' => 'file',     'return_format' => 'url', 'mime_types' => 'pdf' ],
        [ 'key' => 'field_tap_res2_img',   'label' => 'Resource 2 — Image', 'name' => 'resource_2_image',  'type' => 'image',    'return_format' => 'url' ],
    ],
]);

/* ─────────────────────────────────────────────
   11. CONTACT FORM
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_contact',
    'title'      => '✉️ Contact Form',
    'menu_order' => 110,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_contact_title',   'label' => 'Section Title',    'name' => 'contact_title',       'type' => 'text',  'default_value' => 'צרו קשר' ],
        [ 'key' => 'field_tap_contact_email',   'label' => 'Recipient Email',  'name' => 'contact_email',       'type' => 'email', 'default_value' => 'avi.theret@gmail.com', 'instructions' => 'All form submissions go here.' ],
        [ 'key' => 'field_tap_contact_subject', 'label' => 'Email Subject',    'name' => 'contact_subject',     'type' => 'text',  'default_value' => 'TrackAttack Pro — טופס יצירת קשר' ],
        [ 'key' => 'field_tap_contact_success', 'label' => 'Success Message',  'name' => 'contact_success_msg', 'type' => 'text',  'default_value' => 'הטופס נשלח בהצלחה! נחזור אליך בהקדם.' ],
    ],
]);

/* ─────────────────────────────────────────────
   12. GLOBAL SETTINGS (no Options Pages needed)
   Stored on the homepage page itself
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'        => 'group_tap_global',
    'title'      => '⚙️ Global Settings (Header / Footer)',
    'menu_order' => 120,
    'location'   => $loc,
    'fields'     => [
        [ 'key' => 'field_tap_cta_btn_text',  'label' => 'Header CTA Button Text', 'name' => 'opt_cta_text',           'type' => 'text',  'default_value' => 'צרו קשר' ],
        [ 'key' => 'field_tap_version_badge', 'label' => 'Version Badge',          'name' => 'opt_version',            'type' => 'text',  'default_value' => 'v4.0' ],
        [ 'key' => 'field_tap_header_logo',   'label' => 'Header Logo',            'name' => 'opt_header_logo',        'type' => 'image', 'return_format' => 'url' ],
        [ 'key' => 'field_tap_footer_logo',   'label' => 'Footer Logo',            'name' => 'opt_footer_logo',        'type' => 'image', 'return_format' => 'url' ],
        [ 'key' => 'field_tap_copyright',     'label' => 'Footer Copyright',       'name' => 'opt_copyright',          'type' => 'text',  'default_value' => '© Copyright Hoosier Racing Tire 2024' ],
        [ 'key' => 'field_tap_fb_url',        'label' => 'Facebook URL',           'name' => 'opt_social_facebook',    'type' => 'url',   'default_value' => 'https://www.facebook.com/hoosiertire/' ],
        [ 'key' => 'field_tap_ig_url',        'label' => 'Instagram URL',          'name' => 'opt_social_instagram',   'type' => 'url',   'default_value' => 'https://www.instagram.com/HoosierTire/' ],
        [ 'key' => 'field_tap_yt_url',        'label' => 'YouTube URL',            'name' => 'opt_social_youtube',     'type' => 'url',   'default_value' => 'https://www.youtube.com/c/HoosierTire' ],
    ],
]);
