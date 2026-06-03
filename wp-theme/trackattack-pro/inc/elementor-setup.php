<?php
/**
 * Elementor auto-setup for TrackAttack Pro.
 * Runs once on theme activation — creates the homepage page and
 * populates it with a full Elementor layout matching the design.
 */

add_action( 'after_switch_theme', 'tap_elementor_auto_setup' );

function tap_elementor_auto_setup(): void {
    // Only run once
    if ( get_option( 'tap_elementor_setup_done' ) ) return;

    $img = get_template_directory_uri() . '/assets/images/';

    /* ── Helper closures ── */
    $uid = fn() => substr( md5( uniqid( '', true ) ), 0, 7 );

    $section = function ( string $id, array $settings, array $columns ) {
        return [ 'id' => $id, 'elType' => 'section', 'settings' => $settings, 'elements' => $columns, 'isInner' => false ];
    };

    $col = function ( string $id, int $size, array $widgets, array $extra = [] ) {
        return [ 'id' => $id, 'elType' => 'column', 'settings' => array_merge( [ '_column_size' => $size ], $extra ), 'elements' => $widgets, 'isInner' => false ];
    };

    $h = function ( string $id, string $text, string $tag = 'h2', int $size = 48, string $color = '#e5e2e1' ) {
        return [ 'id' => $id, 'elType' => 'widget', 'widgetType' => 'heading', 'elements' => [], 'settings' => [
            'title' => $text, 'header_size' => $tag, 'title_color' => $color,
            'typography_typography' => 'custom', 'typography_font_family' => 'Anton',
            'typography_font_size' => [ 'unit' => 'px', 'size' => $size ],
            'typography_font_style' => 'italic', 'typography_font_weight' => '400',
            'typography_line_height' => [ 'unit' => 'em', 'size' => 1 ],
            'align' => 'left',
        ] ];
    };

    $p = function ( string $id, string $html, string $color = '#e6bdbb' ) {
        return [ 'id' => $id, 'elType' => 'widget', 'widgetType' => 'text-editor', 'elements' => [], 'settings' => [
            'editor' => $html, 'text_color' => $color,
            'typography_typography' => 'custom', 'typography_font_family' => 'Hanken Grotesk',
            'typography_font_size' => [ 'unit' => 'px', 'size' => 17 ],
            'typography_line_height' => [ 'unit' => 'em', 'size' => 1.7 ],
        ] ];
    };

    $imgw = function ( string $id, string $url, string $align = 'center', string $size = '100' ) {
        return [ 'id' => $id, 'elType' => 'widget', 'widgetType' => 'image', 'elements' => [], 'settings' => [
            'image' => [ 'url' => $url, 'id' => '' ],
            'image_size' => 'full', 'align' => $align,
            'width' => [ 'unit' => '%', 'size' => $size ],
        ] ];
    };

    $html = function ( string $id, string $content ) {
        return [ 'id' => $id, 'elType' => 'widget', 'widgetType' => 'html', 'elements' => [], 'settings' => [ 'html' => $content ] ];
    };

    $sec_bg = fn( string $bg_color = '#131313', array $extra = [] ) => array_merge( [
        'background_background' => 'classic',
        'background_color'      => $bg_color,
        'gap' => 'no',
        'layout' => 'full_width',
    ], $extra );

    $sec_img = fn( string $url, string $bg_color = '#0e0e0e', array $extra = [] ) => array_merge( [
        'background_background' => 'classic',
        'background_color'      => $bg_color,
        'background_image'      => [ 'url' => $url, 'id' => '' ],
        'background_size'       => 'cover',
        'background_position'   => 'center center',
        'gap' => 'no',
        'layout' => 'full_width',
    ], $extra );

    $pad = fn( int $t, int $r, int $b, int $l ) => [ 'padding' => [ 'unit' => 'px', 'top' => "$t", 'right' => "$r", 'bottom' => "$b", 'left' => "$l", 'isLinked' => false ] ];

    $u = $uid; // shorthand

    /* ────────────────────────────────────────────
       BUILD SECTIONS
    ──────────────────────────────────────────── */

    $uid_hero = $u();
    $sections = [];

    /* 1. HERO */
    $overlay_css = '<style>.tap-hero-overlay{position:absolute;inset:0;background:linear-gradient(to right,rgba(0,0,0,.88) 0%,rgba(0,0,0,.35) 55%,transparent 100%);pointer-events:none;z-index:0}</style><div class="tap-hero-overlay"></div>';
    $sections[] = $section( $u(), array_merge(
        $sec_img( $img . 'racetrack_camera_03.jpg', '#0e0e0e', [
            'height' => 'min-height',
            'custom_height' => [ 'unit' => 'vh', 'size' => 100 ],
            'content_position' => 'bottom',
            'css_classes' => 'tap-hero-section',
        ] ),
        $pad( 0, 64, 80, 64 )
    ), [
        $col( $u(), 100, [
            $html( $u(), $overlay_css ),
            $h( $u(), 'Conquer. Every. Drive.', 'h1', 72, '#e5e2e1' ),
            $p( $u(), '<p style="border-left:4px solid #e31837;padding-left:24px;font-style:normal;letter-spacing:.1em;text-transform:uppercase;font-family:\'JetBrains Mono\',monospace;font-size:14px;">Ultimate Track Day Weapon</p>', '#e6bdbb' ),
        ] ),
    ] );

    /* 2. PRESENTED BY */
    $sections[] = $section( $u(), array_merge( $sec_bg( '#201f1f' ), $pad( 40, 64, 40, 64 ), [ 'border_border' => 'solid', 'border_color' => '#5d3f3e', 'border_width' => [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '2', 'left' => '0' ] ] ), [
        $col( $u(), 100, [
            $h( $u(), 'Presented By', 'p', 12, '#adc6ff' ),
        ], [ 'align' => 'center' ] ),
    ] );

    /* 3. FEATURES */
    $features_items = [
        '<strong>UTQG 200</strong> rated <strong>Extreme Performance Summer</strong> tire',
        'Engineered for <strong>track dominance</strong> and <strong>street performance</strong> with <strong>Hoosier Racing DNA</strong>',
        'Addictive levels of <strong>responsiveness</strong> and <strong>handling</strong>',
        '<strong>Unrivaled grip</strong> derived from motorsports-proven compounds',
        '<strong>Adrenaline fueled acceleration</strong> fused with <strong>dynamic braking</strong>',
    ];
    $feat_html = '<ul style="list-style:none;display:flex;flex-direction:column;gap:20px;">';
    foreach ( $features_items as $f ) {
        $feat_html .= '<li style="display:flex;align-items:flex-start;gap:14px;font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;line-height:1.6;color:#e6bdbb;">'
            . '<span style="flex-shrink:0;width:22px;height:22px;background:#e31837;display:flex;align-items:center;justify-content:center;margin-top:2px;">'
            . '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="2.5" stroke-linecap="square"><polyline points="20 6 9 17 4 12"/></svg>'
            . '</span><div>' . $f . '</div></li>';
    }
    $feat_html .= '</ul>';
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 80, 64, 80, 64 ) ), [
        $col( $u(), 50, [ $imgw( $u(), $img . 'Tire-angle-lrg.png', 'center', '90' ) ] ),
        $col( $u(), 50, [ $html( $u(), $feat_html ) ] ),
    ] );

    /* 4. VIDEO */
    $play_html = '<div style="display:flex;flex-direction:column;align-items:center;position:relative;z-index:1;">'
        . '<button onclick="window.open(\'https://www.youtube.com/watch?v=REPLACE_VIDEO_ID\',\'_blank\')" style="width:80px;height:80px;background:#e31837;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 0 30px rgba(227,24,55,.4);">'
        . '<svg width="28" height="28" viewBox="0 0 24 24" fill="#fffaf9" style="margin-left:4px;"><polygon points="5,3 19,12 5,21"/></svg></button>'
        . '<p style="margin-top:16px;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#ffb3b1;">Play Video</p>'
        . '</div>';
    $sections[] = $section( $u(), array_merge(
        $sec_img( $img . 'Tire-angle-lrg-web-no-text.jpg', '#0e0e0e', [
            'height' => 'min-height', 'custom_height' => [ 'unit' => 'px', 'size' => 500 ],
            'content_position' => 'middle',
        ] ),
        $pad( 0, 64, 0, 64 )
    ), [
        $col( $u(), 100, [ $html( $u(), '<div style="position:absolute;inset:0;background:rgba(19,19,19,.7);pointer-events:none;"></div>' . $play_html ) ], [ 'align' => 'center' ] ),
    ] );

    /* 5. TECH CALLOUTS */
    $callouts = [
        [ 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="1.5" stroke-linecap="square"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>', 'text' => '<strong>Extra-wide shoulder ribs</strong> maximize cornering performance' ],
        [ 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="1.5" stroke-linecap="square"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="3"/></svg>', 'text' => '<strong>Featherlight construction</strong> provides peak responsiveness' ],
        [ 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="1.5" stroke-linecap="square"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>', 'text' => '<strong>H-DNA technology:</strong> 65+ years of Hoosier Racing DNA' ],
        [ 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="1.5" stroke-linecap="square"><rect x="3" y="3" width="18" height="18" rx="0"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>', 'text' => '<strong>Optimized center rib</strong> for increased braking performance' ],
        [ 'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="1.5" stroke-linecap="square"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>', 'text' => '<strong>Motorsports derived compound</strong>' ],
    ];
    $callout_grid = '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:24px;margin-top:48px;">';
    foreach ( $callouts as $c ) {
        $callout_grid .= '<div style="text-align:center;padding:24px;border:1px solid #5d3f3e;background:#201f1f;">'
            . '<div style="width:48px;height:48px;background:#e31837;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fffaf9" stroke-width="1.5" stroke-linecap="square">' . strip_tags( $c['svg'], '<path><rect><circle><line><polyline><polygon>' ) . '</svg></div>'
            . '<p style="font-family:\'Hanken Grotesk\',sans-serif;font-size:15px;line-height:1.6;color:#e6bdbb;">' . $c['text'] . '</p>'
            . '</div>';
    }
    $callout_grid .= '</div>';
    $sections[] = $section( $u(), array_merge( $sec_bg( '#1c1b1b' ), $pad( 80, 64, 80, 64 ) ), [
        $col( $u(), 100, [
            $imgw( $u(), $img . 'Tire-angle-lrg.png', 'center', '30' ),
            $html( $u(), $callout_grid ),
        ] ),
    ] );

    /* 6. GALLERY */
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 80, 64, 80, 64 ), [ 'border_border' => 'solid', 'border_color' => '#5d3f3e', 'border_width' => [ 'unit' => 'px', 'top' => '4', 'bottom' => '0', 'left' => '0', 'right' => '0' ] ] ), [
        $col( $u(), 100, [
            $h( $u(), 'For Drivers', 'h2', 48, '#e31837' ),
            $p( $u(), '<p>...brings track dominance to the street</p>', '#e6bdbb' ),
        ] ),
    ] );
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 0, 64, 80, 64 ) ), [
        $col( $u(), 50, [ $imgw( $u(), $img . 'TAP-2000x1000-master8.jpg', 'center', '100' ) ] ),
        $col( $u(), 50, [ $imgw( $u(), $img . 'TAP-2000x1000-master6.jpg', 'center', '100' ) ] ),
    ] );

    /* 7. ABOUT OVERLAY */
    $sections[] = $section( $u(), array_merge(
        $sec_img( $img . 'TAP-2000x1000-master6.jpg', '#0e0e0e', [
            'height' => 'min-height', 'custom_height' => [ 'unit' => 'px', 'size' => 500 ],
            'content_position' => 'middle',
        ] ),
        $pad( 80, 64, 80, 64 )
    ), [
        $col( $u(), 60, [
            $html( $u(), '<div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(0,0,0,.9),rgba(0,0,0,.6));pointer-events:none;"></div>' ),
            $h( $u(), 'TrackAttack Pro', 'h2', 48, '#e5e2e1' ),
            $p( $u(), '<p>...masters both street and track. Harnessing Hoosier\'s unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance.</p>', '#e6bdbb' ),
        ] ),
    ] );

    /* 8. CTA BANNER */
    $sections[] = $section( $u(), array_merge(
        $sec_img( $img . 'TAP-2000x1000-master-1.jpg', '#0e0e0e', [
            'height' => 'min-height', 'custom_height' => [ 'unit' => 'px', 'size' => 480 ],
            'content_position' => 'middle',
            'border_border' => 'solid', 'border_color' => '#e31837',
            'border_width' => [ 'unit' => 'px', 'top' => '4', 'bottom' => '4', 'left' => '0', 'right' => '0' ],
        ] ),
        $pad( 80, 64, 80, 64 )
    ), [
        $col( $u(), 100, [
            $html( $u(), '<div style="position:absolute;inset:0;background:rgba(19,19,19,.8);pointer-events:none;"></div>' ),
            $h( $u(), 'Revolutionary extreme performance summer tire', 'h2', 48, '#e5e2e1' ),
            $p( $u(), '<p><em>...awakens daily commutes, empowers epic track days – and ignites legendary journeys in between.</em></p>', '#e6bdbb' ),
        ], [ 'align' => 'center' ] ),
    ] );

    /* 9. CINEMATIC TIRE */
    $tire_anim = '<style>@keyframes floatTire{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}.tap-tire-float{animation:floatTire 4s ease-in-out infinite;}</style>'
        . '<div style="position:absolute;inset:0;background:url(\'' . $img . 'Tire-angle-lrg-web-no-text.jpg\') center/cover;opacity:.15;filter:grayscale(100%);pointer-events:none;"></div>'
        . '<div style="position:relative;z-index:1;text-align:center;"><img src="' . $img . 'Tire-angle-lrg.png" class="tap-tire-float" style="max-width:350px;width:80vw;filter:drop-shadow(0 0 60px rgba(227,24,55,.3));" alt="TrackAttack Pro tire"></div>';
    $sections[] = $section( $u(), array_merge( $sec_bg( '#0e0e0e', [ 'height' => 'min-height', 'custom_height' => [ 'unit' => 'px', 'size' => 500 ], 'content_position' => 'middle' ] ), $pad( 0, 0, 0, 0 ) ), [
        $col( $u(), 100, [ $html( $u(), $tire_anim ) ], [ 'align' => 'center' ] ),
    ] );

    /* 10. SPECS */
    $sections[] = $section( $u(), array_merge( $sec_bg( '#0e0e0e' ), $pad( 60, 64, 60, 64 ) ), [
        $col( $u(), 100, [
            $imgw( $u(), $img . 'TAP-Logo@4x.png', 'center', '40' ),
            $imgw( $u(), $img . 'Specs.png', 'center', '80' ),
        ], [ 'align' => 'center' ] ),
    ] );

    /* 11. RADAR CHARTS */
    $radar1 = '<div style="position:relative;overflow:hidden;border:1px solid #5d3f3e;"><div style="position:absolute;inset:0;background:url(\'' . $img . 'IMG_3706.jpg\') center/cover;opacity:.5;"></div><img src="' . $img . 'spider1B@2x.png" style="position:relative;z-index:1;max-width:100%;" alt="vs Extreme Contact Force"></div>';
    $radar2 = '<div style="position:relative;overflow:hidden;border:1px solid #5d3f3e;"><div style="position:absolute;inset:0;background:url(\'' . $img . 'IMG_4130.jpg\') center/cover;opacity:.5;"></div><img src="' . $img . 'spider2B@2x.png" style="position:relative;z-index:1;max-width:100%;" alt="vs Hoosier R7"></div>';
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 80, 64, 80, 64 ) ), [
        $col( $u(), 50, [ $html( $u(), $radar1 ) ] ),
        $col( $u(), 50, [ $html( $u(), $radar2 ) ] ),
    ] );

    /* 12. H-DNA */
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 80, 64, 80, 64 ) ), [
        $col( $u(), 40, [ $imgw( $u(), $img . 'HDNA-white.png', 'center', '80' ) ] ),
        $col( $u(), 60, [
            $h( $u(), 'Hoosier DNA', 'h2', 48, '#e5e2e1' ),
            $p( $u(), '<p>Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.</p>', '#e6bdbb' ),
        ] ),
    ] );

    /* 13. TOTAL DOMINANCE */
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 80, 64, 80, 64 ), [ 'border_border' => 'solid', 'border_color' => '#5d3f3e', 'border_width' => [ 'unit' => 'px', 'top' => '2', 'bottom' => '0', 'left' => '0', 'right' => '0' ] ] ), [
        $col( $u(), 100, [
            $h( $u(), 'Total Dominance Plan', 'h2', 36, '#e5e2e1' ),
            $p( $u(), '<p>Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive.</p>', '#e6bdbb' ),
        ] ),
    ] );

    /* 14. PRODUCT TABLE (HTML widget) */
    ob_start();
    include get_template_directory() . '/inc/product-table.php';
    $table_html = ob_get_clean();
    if ( ! $table_html ) {
        $table_html = '<p style="color:#e6bdbb;text-align:center;padding:40px;">Product table — see theme file inc/product-table.php</p>';
    }
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 0, 0, 0, 0 ) ), [
        $col( $u(), 100, [ $html( $u(), $table_html ) ] ),
    ] );

    /* 15. RESOURCES */
    $sections[] = $section( $u(), array_merge(
        $sec_img( $img . 'racetrack_camera_03.jpg', '#0e0e0e', [ 'border_border' => 'solid', 'border_color' => '#e31837', 'border_width' => [ 'unit' => 'px', 'top' => '4', 'bottom' => '0', 'left' => '0', 'right' => '0' ] ] ),
        $pad( 30, 64, 30, 64 )
    ), [
        $col( $u(), 100, [ $h( $u(), 'TrackAttack Pro Resources', 'h2', 48, '#e5e2e1' ) ], [ 'align' => 'center' ] ),
    ] );
    $sections[] = $section( $u(), array_merge( $sec_bg( '#131313' ), $pad( 60, 64, 60, 64 ) ), [
        $col( $u(), 50, [
            $h( $u(), 'Detailed Product Specifications', 'h3', 22, '#e5e2e1' ),
            $p( $u(), '<p>TrackAttack Pro detailed product specifications can be downloaded here.</p><p><em style="font-size:13px;color:#ad8886;">NOTE: All measurements are subject to change upon official size release.</em></p>', '#e6bdbb' ),
            $html( $u(), '<a href="#" style="display:inline-block;padding:10px 28px;border:2px solid #ad8886;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#e5e2e1;text-decoration:none;">Download</a>' ),
        ] ),
        $col( $u(), 50, [
            $imgw( $u(), $img . 'LC3_2618.jpg', 'center', '100' ),
            $h( $u(), 'Tire Care and Safety Guidelines', 'h3', 22, '#e5e2e1' ),
            $p( $u(), '<p>Trackattack Pro detailed tire care procedures, best practices and safety guidelines.</p>', '#e6bdbb' ),
            $html( $u(), '<a href="#" style="display:inline-block;padding:10px 28px;border:2px solid #ad8886;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#e5e2e1;text-decoration:none;">Download</a>' ),
        ] ),
    ] );

    /* 16. CONTACT FORM */
    $contact_form = '
    <section id="contact" style="direction:rtl;font-family:\'Hanken Grotesk\',sans-serif;">
      <h2 style="font-family:Anton;font-style:italic;font-size:48px;color:#e5e2e1;text-align:center;margin-bottom:40px;">צרו קשר</h2>
      <form id="contactForm" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;">
        <div>
          <p style="font-family:Anton;font-style:italic;font-size:24px;color:#e31837;border-bottom:2px solid #5d3f3e;padding-bottom:12px;margin-bottom:24px;">פרטים אישיים</p>
          ' . tap_form_field('name','שם מלא','text') . tap_form_field('email','אימייל','email') . tap_form_field('phone','טלפון','tel') . '
        </div>
        <div>
          <p style="font-family:Anton;font-style:italic;font-size:24px;color:#e31837;border-bottom:2px solid #5d3f3e;padding-bottom:12px;margin-bottom:24px;">פרטי רכב</p>
          ' . tap_form_field('manufacturer','יצרן','text') . tap_form_field('model','דגם','text') . tap_form_field('year','שנת ייצור','text') . '
          <div style="margin-bottom:20px;">
            <label style="display:block;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#adc6ff;margin-bottom:8px;">אני מעוניין בגדלים...</label>
            <div class="multiselect-wrapper" id="tireSizeSelect">
              <div class="multiselect-trigger" id="tireSizeTrigger" style="width:100%;padding:12px 16px;background:#201f1f;border:none;border-bottom:2px solid #5d3f3e;color:#ad8886;font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;direction:rtl;cursor:pointer;display:flex;align-items:center;justify-content:space-between;"><span class="trigger-text">בחרו גדלים</span><span class="arrow">&#9660;</span></div>
              <div class="multiselect-dropdown" id="tireSizeDropdown"></div>
              <div class="selected-tags" id="tireSizeTags"></div>
              <input type="hidden" name="tire_sizes" id="tireSizesHidden">
            </div>
          </div>
          ' . tap_form_textarea('notes','הערות רשות') . '
        </div>
        <div style="grid-column:1/-1;text-align:center;">
          ' . wp_nonce_field('tap_contact_nonce','tap_nonce',true,false) . '
          <button type="submit" style="width:100%;padding:16px 40px;background:#e31837;color:#fffaf9;border:none;cursor:pointer;font-family:Anton;font-style:italic;font-size:24px;text-transform:uppercase;">שלח</button>
          <div id="formNotice" style="display:none;padding:16px;margin-top:16px;"></div>
        </div>
      </form>
    </section>';
    $sections[] = $section( $u(), array_merge( $sec_bg( '#1c1b1b' ), $pad( 80, 64, 80, 64 ), [ 'border_border' => 'solid', 'border_color' => '#e31837', 'border_width' => [ 'unit' => 'px', 'top' => '4', 'bottom' => '0', 'left' => '0', 'right' => '0' ] ] ), [
        $col( $u(), 100, [ $html( $u(), $contact_form ) ] ),
    ] );

    /* ── Create page & set as front page ── */
    $existing = get_posts( [ 'post_type' => 'page', 'post_status' => 'publish', 'meta_key' => '_tap_homepage', 'meta_value' => '1', 'numberposts' => 1 ] );
    if ( $existing ) {
        $page_id = $existing[0]->ID;
    } else {
        $page_id = wp_insert_post( [
            'post_title'   => 'TrackAttack Pro',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        update_post_meta( $page_id, '_tap_homepage', '1' );
    }

    // Store Elementor data — MUST be wp_slash'd or WP corrupts the JSON quotes
    $json = wp_json_encode( $sections );
    update_post_meta( $page_id, '_elementor_data',          wp_slash( $json ) );
    update_post_meta( $page_id, '_elementor_edit_mode',     'builder' );
    update_post_meta( $page_id, '_elementor_version',       '3.0.0' );
    update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
    update_post_meta( $page_id, '_elementor_css',           '' ); // force CSS regen

    // Set as static front page
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front',  $page_id );

    update_option( 'tap_elementor_setup_done', '1' );
}

/* ── Form field helpers ── */
function tap_form_field( string $name, string $label, string $type = 'text' ): string {
    return '<div style="margin-bottom:20px;">'
        . '<label for="' . esc_attr($name) . '" style="display:block;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#adc6ff;margin-bottom:8px;">' . esc_html($label) . '</label>'
        . '<input type="' . esc_attr($type) . '" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" style="width:100%;padding:12px 16px;background:#201f1f;border:none;border-bottom:2px solid #5d3f3e;color:#e5e2e1;font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;direction:rtl;outline:none;">'
        . '</div>';
}

function tap_form_textarea( string $name, string $label ): string {
    return '<div style="margin-bottom:20px;">'
        . '<label for="' . esc_attr($name) . '" style="display:block;font-family:\'JetBrains Mono\',monospace;font-size:12px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#adc6ff;margin-bottom:8px;">' . esc_html($label) . '</label>'
        . '<textarea id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" style="width:100%;padding:12px 16px;background:#201f1f;border:none;border-bottom:2px solid #5d3f3e;color:#e5e2e1;font-family:\'Hanken Grotesk\',sans-serif;font-size:16px;direction:rtl;outline:none;min-height:80px;resize:vertical;"></textarea>'
        . '</div>';
}
