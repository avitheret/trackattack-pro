<!DOCTYPE html>
<html class="dark" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="header">
  <a href="<?php echo esc_url( home_url('/') ); ?>" class="logo">
    <img src="<?php echo tap_image('tap_header_logo','TAP-Logo_white.png'); ?>" alt="<?php bloginfo('name'); ?>" style="height:40px;width:auto;">
  </a>
  <a href="#contact" class="cta-btn"><?php tap_text('tap_cta_btn','צרו קשר'); ?></a>
  <div class="header-right">
    <div class="version-badge"><?php tap_text('tap_version','v5.0'); ?></div>
    <div class="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </div>
  </div>
</header>
