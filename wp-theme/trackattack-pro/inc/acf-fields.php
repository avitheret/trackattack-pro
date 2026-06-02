<?php
/**
 * ACF Local Field Group Registration
 * Fields appear when editing the static front page in WP Admin → Pages
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

// Show on any Page being edited
$front_page_location = [[
    [ 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ],
]];

/* ─────────────────────────────────────────────
   1. HERO
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'      => 'group_tap_hero',
    'title'    => '🏁 Hero Section',
    'fields'   => [
        [
            'key'           => 'field_tap_hero_heading',
            'label'         => 'Heading',
            'name'          => 'hero_heading',
            'type'          => 'text',
            'default_value' => 'Conquer. Every. Drive.',
            'instructions'  => 'Main headline shown over the hero image.',
        ],
        [
            'key'           => 'field_tap_hero_subtitle',
            'label'         => 'Subtitle',
            'name'          => 'hero_subtitle',
            'type'          => 'text',
            'default_value' => 'Ultimate Track Day Weapon',
        ],
        [
            'key'           => 'field_tap_hero_image',
            'label'         => 'Background Image',
            'name'          => 'hero_image',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
            'instructions'  => 'Full-width background. Min 1920×1080px.',
        ],
        [
            'key'           => 'field_tap_presented_by',
            'label'         => '"Presented By" Text',
            'name'          => 'presented_by_text',
            'type'          => 'text',
            'default_value' => 'Presented By',
        ],
    ],
    'location' => $front_page_location,
    'menu_order' => 10,
]);

/* ─────────────────────────────────────────────
   2. FEATURES
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_features',
    'title'  => '✅ Features Section',
    'fields' => [
        [
            'key'           => 'field_tap_features_image',
            'label'         => 'Tire Product Image',
            'name'          => 'features_tire_image',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
        ],
        [
            'key'          => 'field_tap_features_list',
            'label'        => 'Feature Items',
            'name'         => 'features_list',
            'type'         => 'repeater',
            'min'          => 1,
            'max'          => 8,
            'button_label' => 'Add Feature',
            'sub_fields'   => [
                [
                    'key'           => 'field_tap_feature_text',
                    'label'         => 'Feature Text (supports <strong>bold</strong>)',
                    'name'          => 'feature_text',
                    'type'          => 'textarea',
                    'rows'          => 2,
                    'default_value' => '',
                    'instructions'  => 'Wrap words in <strong></strong> to bold them.',
                ],
            ],
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 20,
]);

/* ─────────────────────────────────────────────
   3. VIDEO
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_video',
    'title'  => '▶️ Video Section',
    'fields' => [
        [
            'key'           => 'field_tap_video_url',
            'label'         => 'Video URL',
            'name'          => 'video_url',
            'type'          => 'url',
            'default_value' => '',
            'instructions'  => 'YouTube or Vimeo link. Opens in a lightbox on click.',
        ],
        [
            'key'           => 'field_tap_video_bg',
            'label'         => 'Background Image',
            'name'          => 'video_background',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 30,
]);

/* ─────────────────────────────────────────────
   4. TECHNOLOGY CALLOUTS
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_callouts',
    'title'  => '⚙️ Technology Callouts',
    'fields' => [
        [
            'key'          => 'field_tap_callouts',
            'label'        => 'Callout Items',
            'name'         => 'tech_callouts',
            'type'         => 'repeater',
            'min'          => 1,
            'max'          => 6,
            'button_label' => 'Add Callout',
            'sub_fields'   => [
                [
                    'key'   => 'field_tap_callout_text',
                    'label' => 'Callout Text (supports <strong>bold</strong>)',
                    'name'  => 'callout_text',
                    'type'  => 'textarea',
                    'rows'  => 2,
                ],
            ],
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 40,
]);

/* ─────────────────────────────────────────────
   5. GALLERY — FOR DRIVERS
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_gallery',
    'title'  => '🚗 Gallery — For Drivers',
    'fields' => [
        [
            'key'           => 'field_tap_gallery_title',
            'label'         => 'Section Title',
            'name'          => 'gallery_title',
            'type'          => 'text',
            'default_value' => 'For Drivers',
        ],
        [
            'key'           => 'field_tap_gallery_subtitle',
            'label'         => 'Subtitle',
            'name'          => 'gallery_subtitle',
            'type'          => 'text',
            'default_value' => '...brings track dominance to the street',
        ],
        [
            'key'           => 'field_tap_gallery_img1',
            'label'         => 'Gallery Image 1',
            'name'          => 'gallery_image_1',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ],
        [
            'key'           => 'field_tap_gallery_img2',
            'label'         => 'Gallery Image 2',
            'name'          => 'gallery_image_2',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 50,
]);

/* ─────────────────────────────────────────────
   6. ABOUT OVERLAY
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_about',
    'title'  => '📖 About Section',
    'fields' => [
        [
            'key'           => 'field_tap_about_title',
            'label'         => 'Title',
            'name'          => 'about_title',
            'type'          => 'text',
            'default_value' => 'TrackAttack Pro',
        ],
        [
            'key'           => 'field_tap_about_text',
            'label'         => 'Body Text',
            'name'          => 'about_text',
            'type'          => 'textarea',
            'rows'          => 4,
            'default_value' => '...masters both street and track. Harnessing Hoosier\'s unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance.',
        ],
        [
            'key'           => 'field_tap_about_bg',
            'label'         => 'Background Image',
            'name'          => 'about_background',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 60,
]);

/* ─────────────────────────────────────────────
   7. CTA BANNER
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_cta',
    'title'  => '📣 CTA Banner',
    'fields' => [
        [
            'key'           => 'field_tap_cta_heading',
            'label'         => 'Heading',
            'name'          => 'cta_heading',
            'type'          => 'text',
            'default_value' => 'Revolutionary extreme performance summer tire',
        ],
        [
            'key'           => 'field_tap_cta_text',
            'label'         => 'Body Text',
            'name'          => 'cta_text',
            'type'          => 'textarea',
            'rows'          => 3,
            'default_value' => '...awakens daily commutes, empowers epic track days – and ignites legendary journeys in between.',
        ],
        [
            'key'           => 'field_tap_cta_bg',
            'label'         => 'Background Image',
            'name'          => 'cta_background',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 70,
]);

/* ─────────────────────────────────────────────
   8. H-DNA
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_hdna',
    'title'  => '🧬 Hoosier DNA',
    'fields' => [
        [
            'key'           => 'field_tap_hdna_title',
            'label'         => 'Title',
            'name'          => 'hdna_title',
            'type'          => 'text',
            'default_value' => 'Hoosier DNA',
        ],
        [
            'key'           => 'field_tap_hdna_text',
            'label'         => 'Body Text',
            'name'          => 'hdna_text',
            'type'          => 'textarea',
            'rows'          => 5,
            'default_value' => 'Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.',
        ],
        [
            'key'           => 'field_tap_hdna_image',
            'label'         => 'H-DNA Image / Logo',
            'name'          => 'hdna_image',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'medium',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 80,
]);

/* ─────────────────────────────────────────────
   9. TOTAL DOMINANCE
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_dominance',
    'title'  => '🏆 Total Dominance',
    'fields' => [
        [
            'key'           => 'field_tap_dom_title',
            'label'         => 'Title',
            'name'          => 'dominance_title',
            'type'          => 'text',
            'default_value' => 'Total Dominance Plan',
        ],
        [
            'key'           => 'field_tap_dom_text',
            'label'         => 'Body Text',
            'name'          => 'dominance_text',
            'type'          => 'textarea',
            'rows'          => 5,
            'default_value' => 'Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive. Choose the Total Dominance Plan and elevate your driving experience to the next level.',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 90,
]);

/* ─────────────────────────────────────────────
   10. RESOURCES
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_resources',
    'title'  => '📥 Resources Section',
    'fields' => [
        [
            'key'           => 'field_tap_res_banner_title',
            'label'         => 'Banner Title',
            'name'          => 'resources_title',
            'type'          => 'text',
            'default_value' => 'TrackAttack Pro Resources',
        ],
        // Card 1
        [
            'key'           => 'field_tap_res1_title',
            'label'         => 'Resource 1 — Title',
            'name'          => 'resource_1_title',
            'type'          => 'text',
            'default_value' => 'Detailed Product Specifications',
        ],
        [
            'key'           => 'field_tap_res1_text',
            'label'         => 'Resource 1 — Description',
            'name'          => 'resource_1_text',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => 'TrackAttack Pro detailed product specifications can be downloaded here.',
        ],
        [
            'key'           => 'field_tap_res1_note',
            'label'         => 'Resource 1 — Note (italic)',
            'name'          => 'resource_1_note',
            'type'          => 'text',
            'default_value' => 'NOTE: All measurements are subject to change upon official size release.',
        ],
        [
            'key'           => 'field_tap_res1_file',
            'label'         => 'Resource 1 — PDF File',
            'name'          => 'resource_1_file',
            'type'          => 'file',
            'return_format' => 'url',
            'mime_types'    => 'pdf',
        ],
        [
            'key'           => 'field_tap_res1_img',
            'label'         => 'Resource 1 — Image',
            'name'          => 'resource_1_image',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'thumbnail',
        ],
        // Card 2
        [
            'key'           => 'field_tap_res2_title',
            'label'         => 'Resource 2 — Title',
            'name'          => 'resource_2_title',
            'type'          => 'text',
            'default_value' => 'Tire Care and Safety Guidelines',
        ],
        [
            'key'           => 'field_tap_res2_text',
            'label'         => 'Resource 2 — Description',
            'name'          => 'resource_2_text',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => 'Trackattack Pro detailed tire care procedures, best practices and safety guidelines.',
        ],
        [
            'key'           => 'field_tap_res2_file',
            'label'         => 'Resource 2 — PDF File',
            'name'          => 'resource_2_file',
            'type'          => 'file',
            'return_format' => 'url',
            'mime_types'    => 'pdf',
        ],
        [
            'key'           => 'field_tap_res2_img',
            'label'         => 'Resource 2 — Image',
            'name'          => 'resource_2_image',
            'type'          => 'image',
            'return_format' => 'url',
            'preview_size'  => 'thumbnail',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 100,
]);

/* ─────────────────────────────────────────────
   11. CONTACT FORM
───────────────────────────────────────────── */
acf_add_local_field_group([
    'key'    => 'group_tap_contact',
    'title'  => '✉️ Contact Form',
    'fields' => [
        [
            'key'           => 'field_tap_contact_title',
            'label'         => 'Section Title',
            'name'          => 'contact_title',
            'type'          => 'text',
            'default_value' => 'צרו קשר',
        ],
        [
            'key'           => 'field_tap_contact_email',
            'label'         => 'Recipient Email',
            'name'          => 'contact_email',
            'type'          => 'email',
            'default_value' => 'avi.theret@gmail.com',
            'instructions'  => 'All contact form submissions will be sent here.',
        ],
        [
            'key'           => 'field_tap_contact_subject',
            'label'         => 'Email Subject Line',
            'name'          => 'contact_subject',
            'type'          => 'text',
            'default_value' => 'TrackAttack Pro — טופס יצירת קשר',
        ],
        [
            'key'           => 'field_tap_contact_success',
            'label'         => 'Success Message (Hebrew)',
            'name'          => 'contact_success_msg',
            'type'          => 'text',
            'default_value' => 'הטופס נשלח בהצלחה! נחזור אליך בהקדם.',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 110,
]);

/* ─────────────────────────────────────────────
   12. THEME OPTIONS PAGE
───────────────────────────────────────────── */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page([
        'page_title'  => 'TrackAttack Pro — Theme Options',
        'menu_title'  => 'TAP Options',
        'menu_slug'   => 'tap-theme-options',
        'capability'  => 'manage_options',
        'icon_url'    => 'dashicons-car',
        'position'    => 25,
        'redirect'    => false,
    ]);

    acf_add_local_field_group([
        'key'    => 'group_tap_options',
        'title'  => 'Global Theme Options',
        'fields' => [
            // Header
            [
                'key'   => 'field_tap_opt_tab_header',
                'label' => 'Header',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_tap_opt_cta_text',
                'label'         => 'CTA Button Text',
                'name'          => 'opt_cta_text',
                'type'          => 'text',
                'default_value' => 'צרו קשר',
            ],
            [
                'key'           => 'field_tap_opt_version',
                'label'         => 'Version Badge',
                'name'          => 'opt_version',
                'type'          => 'text',
                'default_value' => 'v4.0',
            ],
            [
                'key'           => 'field_tap_opt_logo',
                'label'         => 'Header Logo',
                'name'          => 'opt_header_logo',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'thumbnail',
            ],
            // Footer
            [
                'key'   => 'field_tap_opt_tab_footer',
                'label' => 'Footer',
                'name'  => '',
                'type'  => 'tab',
            ],
            [
                'key'           => 'field_tap_opt_footer_logo',
                'label'         => 'Footer Logo',
                'name'          => 'opt_footer_logo',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'thumbnail',
            ],
            [
                'key'           => 'field_tap_opt_copyright',
                'label'         => 'Copyright Text',
                'name'          => 'opt_copyright',
                'type'          => 'text',
                'default_value' => '© Copyright Hoosier Racing Tire ' . date('Y'),
            ],
            [
                'key'           => 'field_tap_opt_fb',
                'label'         => 'Facebook URL',
                'name'          => 'opt_social_facebook',
                'type'          => 'url',
                'default_value' => 'https://www.facebook.com/hoosiertire/',
            ],
            [
                'key'           => 'field_tap_opt_ig',
                'label'         => 'Instagram URL',
                'name'          => 'opt_social_instagram',
                'type'          => 'url',
                'default_value' => 'https://www.instagram.com/HoosierTire/',
            ],
            [
                'key'           => 'field_tap_opt_yt',
                'label'         => 'YouTube URL',
                'name'          => 'opt_social_youtube',
                'type'          => 'url',
                'default_value' => 'https://www.youtube.com/c/HoosierTire',
            ],
        ],
        'location' => [[
            [ 'param' => 'options_page', 'operator' => '==', 'value' => 'tap-theme-options' ],
        ]],
        'menu_order' => 0,
    ]);
}
