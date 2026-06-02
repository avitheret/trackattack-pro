<?php
/**
 * Fallback template — redirects all requests to front-page
 */
get_header(); ?>

<main id="content">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
      <div class="entry-content" style="max-width:var(--container-max);margin:80px auto;padding:0 var(--margin-desktop);color:var(--on-surface);">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; endif; ?>
</main>

<?php get_footer();
