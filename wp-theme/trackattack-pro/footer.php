<?php
// Read global settings from the front page
$front_page_id = get_option('page_on_front');
$footer_logo = '';
$copyright   = '© Copyright Hoosier Racing Tire ' . date('Y');
$fb = 'https://www.facebook.com/hoosiertire/';
$ig = 'https://www.instagram.com/HoosierTire/';
$yt = 'https://www.youtube.com/c/HoosierTire';
if ( $front_page_id && function_exists('get_field') ) {
    $raw = get_field( 'opt_footer_logo', $front_page_id );
    $footer_logo = $raw ? ( is_array($raw) ? ($raw['url'] ?? '') : $raw ) : '';
    $copyright   = get_field( 'opt_copyright',         $front_page_id ) ?: $copyright;
    $fb          = get_field( 'opt_social_facebook',   $front_page_id ) ?: $fb;
    $ig          = get_field( 'opt_social_instagram',  $front_page_id ) ?: $ig;
    $yt          = get_field( 'opt_social_youtube',    $front_page_id ) ?: $yt;
}
if ( ! $footer_logo ) {
    $footer_logo = get_template_directory_uri() . '/assets/images/Horizontal-logo-3to1-on-white-or-light-gray.png';
}
?>
<footer>
  <div class="footer-inner">
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo">
      <img src="<?php echo esc_url($footer_logo); ?>" alt="Hoosier" style="height:40px;width:auto;opacity:0.7;">
    </a>
    <div class="social-icons">
      <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" aria-label="Facebook">
        <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
      </a>
      <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" aria-label="Instagram">
        <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="0" fill="none" stroke="white" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="white" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.5" fill="white"/></svg>
      </a>
      <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener" aria-label="YouTube">
        <svg viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75,15.02 15.5,11.75 9.75,8.48" fill="white"/></svg>
      </a>
    </div>
  </div>
  <div class="footer-bottom">
    <p><?php echo esc_html( $copyright ); ?></p>
    <div class="footer-links">
      <a href="<?php echo esc_url( home_url('/terms-conditions/') ); ?>">Terms &amp; conditions</a>
      <a href="<?php echo esc_url( home_url('/cookies/') ); ?>">Cookies</a>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
