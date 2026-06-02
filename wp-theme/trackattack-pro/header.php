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
    <?php
    $logo_url = tap_option_img( 'opt_header_logo', 'TAP-Logo_white.png' );
    ?>
    <img src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>" style="height:40px;width:auto;">
  </a>

  <a href="#contact" class="cta-btn"><?php echo esc_html( tap_option( 'opt_cta_text', 'צרו קשר' ) ); ?></a>

  <div class="header-right">
    <div class="version-badge"><?php echo esc_html( tap_option( 'opt_version', 'v4.0' ) ); ?></div>
    <div class="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </div>
  </div>
</header>
