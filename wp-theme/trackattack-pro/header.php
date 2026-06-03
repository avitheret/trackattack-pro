<!DOCTYPE html>
<html class="dark" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open();

// Read global settings from the front page
$front_page_id = get_option('page_on_front');
$logo_url    = '';
$cta_text    = 'צרו קשר';
$version     = 'v4.5';
if ( $front_page_id && function_exists('get_field') ) {
    $raw_logo = get_field( 'opt_header_logo', $front_page_id );
    $logo_url = $raw_logo ? ( is_array($raw_logo) ? ($raw_logo['url'] ?? '') : $raw_logo ) : '';
    $cta_text = get_field( 'opt_cta_text', $front_page_id ) ?: 'צרו קשר';
    $version  = get_field( 'opt_version',  $front_page_id ) ?: 'v4.5';
}
if ( ! $logo_url ) {
    $logo_url = get_template_directory_uri() . '/assets/images/TAP-Logo_white.png';
}
?>

<header id="header">
  <a href="<?php echo esc_url( home_url('/') ); ?>" class="logo">
    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo('name'); ?>" style="height:40px;width:auto;">
  </a>
  <a href="#contact" class="cta-btn"><?php echo esc_html( $cta_text ); ?></a>
  <div class="header-right">
    <div class="version-badge"><?php echo esc_html( $version ); ?></div>
    <div class="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </div>
  </div>
</header>
