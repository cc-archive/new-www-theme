<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<!-- header-below -->
<?php get_sidebar( 'header-below' ); ?>
<!-- END header-below -->

<div id="primary" class="content-area">
  <div id="wrapper-main" class="wrapper-main">
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
      <?php if(function_exists('bcn_display')){
        bcn_display();
      }?>
    </div>
  	<main id="main" class="site-main" role="main">
  		<?php
    		// Start the loop.
    		while ( have_posts() ) : the_post();

    			// Include the page content template.
    			get_template_part( 'template-parts/content', 'page' );

    			// If comments are open or we have at least one comment, load up the comment template.
    			if ( comments_open() || get_comments_number() ) {
    				comments_template();
    			}

    			// End of the loop.
    		endwhile;
  		?>
  	</main><!-- .site-main -->
	  <?php get_sidebar( 'content-bottom' ); ?>
  </div>
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <div id="wrapper-sidebar" class="wrapper-sidebar">
      <?php get_sidebar('sidebar-1'); ?>
    </div>
  <?php endif; ?>
</div><!-- .content-area -->
<!-- content-below -->
<?php get_sidebar( 'content-below' ); ?>
<!-- END content-below -->

<?php get_footer(); ?>
