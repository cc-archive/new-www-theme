<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php if ( is_active_sidebar( 'content-below' )  ) : ?>
	<div id="content-below" class="widget-area content-below">
		<?php dynamic_sidebar( 'content-below' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>
