<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'home-content-below' )  ) : ?>
	<div id="home-content-below" class="widget-area">
		<?php dynamic_sidebar( 'home-content-below' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>
