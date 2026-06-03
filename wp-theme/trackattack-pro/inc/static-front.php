<?php
/**
 * Static front-page markup. Text & images pull from the Customizer
 * via tap_text() / tap_image() with built-in defaults.
 */
$img = get_template_directory_uri() . '/assets/images/';
?>

<main id="content">

<!-- HERO -->
<section class="hero">
  <div class="hero-bg" style="background-image:url('<?php echo tap_image('tap_hero_image','racetrack_camera_03.jpg'); ?>')"></div>
  <div class="hero-content">
    <h1><?php tap_text('tap_hero_heading','Conquer. Every. Drive.'); ?></h1>
    <p class="subtitle"><?php tap_text('tap_hero_subtitle','Ultimate Track Day Weapon'); ?></p>
  </div>
</section>

<!-- PRESENTED BY -->
<div class="presented-by"><p><?php tap_text('tap_presented_by','Presented By'); ?></p></div>

<!-- FEATURES -->
<section class="features reveal">
  <div class="features-image"><div class="tire-render" style="background-image:url('<?php echo tap_image('tap_feat_img','Tire-angle-lrg.png'); ?>')"></div></div>
  <ul class="features-list">
    <?php
    $feat_defaults = [
      '<strong>UTQG 200</strong> rated <strong>Extreme Performance Summer</strong> tire',
      'Engineered for <strong>track dominance</strong> and <strong>street performance</strong> with <strong>Hoosier Racing DNA</strong>',
      'Addictive levels of <strong>responsiveness</strong> and <strong>handling</strong>',
      '<strong>Unrivaled grip</strong> derived from motorsports-proven compounds',
      '<strong>Adrenaline fueled acceleration</strong> fused with <strong>dynamic braking</strong>',
    ];
    for ( $i = 1; $i <= 5; $i++ ) :
      $txt = trim( tap_text_raw( "tap_feature_{$i}", $feat_defaults[$i-1] ) );
      if ( $txt === '' ) continue; ?>
      <li><div class="check-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div><?php echo wp_kses( $txt, ['strong'=>[],'em'=>[]] ); ?></div></li>
    <?php endfor; ?>
  </ul>
</section>

<!-- VIDEO -->
<section class="video-section">
  <div class="video-inner">
    <button class="play-btn" aria-label="Play video"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></button>
    <p class="play-label">Play Video</p>
  </div>
</section>

<!-- TECH CALLOUTS -->
<section class="tech-callouts reveal">
  <div class="tech-inner">
    <div class="tire-center"></div>
    <div class="callout-grid">
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div><p><strong>Extra-wide shoulder ribs</strong> maximize cornering performance</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="3"/></svg></div><p><strong>Featherlight construction</strong> provides peak responsiveness</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M12 6v6l4 2" stroke="white" fill="none"/></svg></div><p><strong>H-DNA technology:</strong> 65+ years of Hoosier Racing DNA</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="0"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></div><p><strong>Optimized center rib</strong> for increased braking performance</p></div>
      <div class="callout"><div class="callout-icon"><svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><p><strong>Motorsports derived compound</strong></p></div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="gallery reveal">
  <div class="gallery-header">
    <h2><?php tap_text('tap_gallery_title','For Drivers'); ?></h2>
    <p><?php tap_text('tap_gallery_subtitle','...brings track dominance to the street'); ?></p>
  </div>
  <div class="gallery-grid">
    <img class="gallery-img" src="<?php echo tap_image('tap_gallery_img1','TAP-2000x1000-master8.jpg'); ?>" alt="C8 Corvette front view">
    <img class="gallery-img" src="<?php echo tap_image('tap_gallery_img2','TAP-2000x1000-master6.jpg'); ?>" alt="C8 Corvette rear view">
  </div>
</section>

<!-- ABOUT -->
<section class="about-overlay" style="background-image:url('<?php echo tap_image('tap_about_bg','TAP-2000x1000-master6.jpg'); ?>')">
  <div class="about-content reveal">
    <h2><?php tap_text('tap_about_title','TrackAttack Pro'); ?></h2>
    <p><?php tap_text('tap_about_text',"...masters both street and track. Harnessing Hoosier's unparalleled racing DNA, taking track dominance to the street, the TrackAttack Pro drives highly addictive performance."); ?></p>
  </div>
</section>

<!-- CTA BANNER -->
<section class="cta-banner" style="background-image:url('<?php echo tap_image('tap_cta_bg','TAP-2000x1000-master-1.jpg'); ?>')">
  <div class="cta-banner-content reveal">
    <h2><?php tap_text('tap_cta_heading','Revolutionary extreme performance summer tire'); ?></h2>
    <p><?php tap_text('tap_cta_text','...awakens daily commutes, empowers epic track days – and ignites legendary journeys in between.'); ?></p>
  </div>
</section>

<!-- CINEMATIC TIRE + HOTSPOTS -->
<section class="cinematic-tire">
  <div class="night-bg"></div>
  <div class="tire-hotspots">
    <img class="tire-img" src="<?php echo esc_url($img); ?>Tire-angle-lrg.png" alt="TrackAttack Pro tire">
    <?php
    $hotspots = [
      [ 44.6,  7.7, 'Extra-wide shoulder ribs maximize cornering performance' ],
      [ 32.0, 24.1, 'Featherlight construction provides peak responsiveness' ],
      [ 39.7, 36.7, 'H-DNA technology: 65+ years of Hoosier Racing DNA' ],
      [ 27.1, 49.2, 'Optimized center rib for increased braking performance' ],
      [ 40.7, 68.5, 'Motorsports derived compound' ],
    ];
    foreach ( $hotspots as $h ) : ?>
      <div class="hotspot" style="left:<?php echo $h[0]; ?>%;top:<?php echo $h[1]; ?>%;">
        <button class="hotspot__btn" aria-label="<?php echo esc_attr($h[2]); ?>"></button>
        <span class="hotspot__tip"><?php echo esc_html($h[2]); ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- SPECS SUMMARY -->
<section class="specs-summary">
  <div class="specs-header">
    <img src="<?php echo esc_url($img); ?>TAP-Logo@4x.png" alt="TrackAttack Pro" style="max-width:400px;width:100%;margin:0 auto 8px;display:block;">
    <p class="specs-sub">| Product Data</p>
    <p class="specs-sub" style="margin-top:4px;">Extreme Performance Summer &nbsp;|&nbsp; Ultra-High Performance</p>
  </div>
  <div style="position:relative;z-index:1;max-width:var(--container-max);margin:0 auto;text-align:center;">
    <img src="<?php echo esc_url($img); ?>Specs.png" alt="Product Specifications" style="max-width:100%;height:auto;">
  </div>
</section>

<!-- RADAR CHARTS -->
<section class="radar-section" style="background:var(--surface);position:relative;overflow:hidden;">
  <div class="radar-grid" style="position:relative;z-index:1;display:grid;grid-template-columns:1fr 1fr;gap:var(--gutter);max-width:var(--container-max);margin:0 auto;">
    <div class="radar-card reveal" style="position:relative;overflow:hidden;border:1px solid var(--outline-variant);background:url('<?php echo esc_url($img); ?>IMG_3706.jpg') center/cover no-repeat;">
      <div style="position:absolute;inset:0;background:rgba(19,19,19,0.6);"></div>
      <img src="<?php echo esc_url($img); ?>spider1B@2x.png" alt="TrackAttack vs Extreme Contact Force" style="position:relative;z-index:1;max-width:100%;height:auto;display:block;margin:0 auto;">
    </div>
    <div class="radar-card reveal" style="position:relative;overflow:hidden;border:1px solid var(--outline-variant);background:url('<?php echo esc_url($img); ?>IMG_4130.jpg') center/cover no-repeat;">
      <div style="position:absolute;inset:0;background:rgba(19,19,19,0.6);"></div>
      <img src="<?php echo esc_url($img); ?>spider2B@2x.png" alt="TrackAttack vs Hoosier R7" style="position:relative;z-index:1;max-width:100%;height:auto;display:block;margin:0 auto;">
    </div>
  </div>
</section>

<!-- H-DNA -->
<section class="hdna-section reveal">
  <div class="hdna-image">
    <img src="<?php echo tap_image('tap_hdna_image','HDNA-white.png'); ?>" alt="H-DNA" style="max-width:280px;width:100%;height:auto;position:relative;z-index:1;">
  </div>
  <div class="hdna-content">
    <h2><?php tap_text('tap_hdna_title','Hoosier DNA'); ?></h2>
    <p><?php tap_text('tap_hdna_text','Pushing boundaries and defying limits. H-DNA was forged from a legacy of unrivaled racing excellence and relentless performance. Ignite your passion, empower your pride and drive your success as you conquer life on and off the track.'); ?></p>
  </div>
</section>

<!-- TOTAL DOMINANCE -->
<section class="dominance reveal">
  <h2><?php tap_text('tap_dom_title','Total Dominance Plan'); ?></h2>
  <p><?php tap_text('tap_dom_text','Experience unmatched performance with the Total Dominance Plan, where Hoosier high-performance tires set a new standard in grip, handling, and durability. Engineered with cutting-edge technology and backed by independent testing and expert endorsements, all Hoosier tires promises superior performance on every drive. Choose the Total Dominance Plan and elevate your driving experience to the next level.'); ?></p>
</section>

<!-- PRODUCT TABLE -->
<?php include get_template_directory() . '/inc/product-table.php'; ?>

<!-- RESOURCES -->
<div class="resources-banner"><h2><?php tap_text('tap_res_banner','TrackAttack Pro Resources'); ?></h2></div>
<div class="resources-grid">
  <div class="resource-card">
    <div class="resource-img" style="background-image:url('<?php echo tap_image('tap_res1_img','tire-3-views@2x.png'); ?>')"></div>
    <div class="resource-info">
      <h3><?php tap_text('tap_res1_title','Detailed Product Specifications'); ?></h3>
      <p><?php tap_text('tap_res1_text','TrackAttack Pro detailed product specifications can be downloaded here.'); ?></p>
      <p class="note"><?php tap_text('tap_res1_note','NOTE: All measurements are subject to change upon official size release.'); ?></p>
      <a href="<?php echo esc_url( tap_text_raw('tap_res1_url','#') ?: '#' ); ?>" class="download-btn" target="_blank">Download</a>
    </div>
  </div>
  <div class="resource-card">
    <div class="resource-info">
      <h3><?php tap_text('tap_res2_title','Tire Care and Safety Guidelines'); ?></h3>
      <p><?php tap_text('tap_res2_text','Trackattack Pro detailed tire care procedures, best practices and safety guidelines.'); ?></p>
      <a href="<?php echo esc_url( tap_text_raw('tap_res2_url','#') ?: '#' ); ?>" class="download-btn" target="_blank">Download</a>
    </div>
    <div class="resource-img tech-img" style="background-image:url('<?php echo tap_image('tap_res2_img','LC3_2618.jpg'); ?>')"></div>
  </div>
</div>

<!-- CONTACT FORM -->
<section id="contact" class="contact-section reveal">
  <div class="contact-inner">
    <h2><?php tap_text('tap_contact_title','צרו קשר'); ?></h2>
    <form class="contact-form" id="contactForm">
      <?php wp_nonce_field( 'tap_contact_nonce', 'tap_nonce' ); ?>
      <div class="form-section">
        <div class="form-group-title">פרטים אישיים</div>
        <div class="form-field"><label for="name">שם מלא</label><input type="text" id="name" name="name" required></div>
        <div class="form-field"><label for="email">אימייל</label><input type="email" id="email" name="email" required></div>
        <div class="form-field"><label for="phone">טלפון</label><input type="tel" id="phone" name="phone"></div>
      </div>
      <div class="form-section">
        <div class="form-group-title">פרטי רכב</div>
        <div class="form-field"><label for="manufacturer">יצרן</label><input type="text" id="manufacturer" name="manufacturer"></div>
        <div class="form-field"><label for="car_model">דגם</label><input type="text" id="car_model" name="model"></div>
        <div class="form-field"><label for="year">שנת ייצור</label><input type="text" id="year" name="year"></div>
        <div class="form-field">
          <label>אני מעוניין בגדלים...</label>
          <div class="multiselect-wrapper" id="tireSizeSelect">
            <div class="multiselect-trigger" id="tireSizeTrigger"><span class="trigger-text">בחרו גדלים</span><span class="arrow">&#9660;</span></div>
            <div class="multiselect-dropdown" id="tireSizeDropdown"></div>
            <div class="selected-tags" id="tireSizeTags"></div>
            <input type="hidden" name="tire_sizes" id="tireSizesHidden">
          </div>
        </div>
        <div class="form-field"><label for="notes">הערות רשות</label><textarea id="notes" name="notes"></textarea></div>
      </div>
      <div style="grid-column:1/-1;text-align:center;">
        <button type="submit" class="submit-btn">שלח</button>
        <div class="form-notice" id="formNotice"></div>
      </div>
    </form>
  </div>
</section>

</main>
