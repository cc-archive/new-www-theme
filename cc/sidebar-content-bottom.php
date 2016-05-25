<?php
/**
 * The template for the content bottom widget areas on posts and pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

if ( ! is_active_sidebar( 'sidebar-below-content-full' ) || is_active_sidebar( 'sidebar-below-content-left' ) && ! is_active_sidebar( 'sidebar-below-content-right' ) ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<aside id="content-bottom-widgets" class="content-bottom-widgets" role="complementary">
  <?php if ( is_active_sidebar( 'sidebar-below-content-full' ) ) : ?>
    <div class="widget-area-full">
      <?php dynamic_sidebar( 'sidebar-below-content-full' ); ?>
    </div><!-- .widget-area -->
  <?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-below-content-left' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-below-content-left' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-below-content-right' ) ) : ?>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-below-content-right' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</aside><!-- .content-bottom-widgets -->
