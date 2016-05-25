<?php
/**
 * The template for the sidebar containing the strip below the header
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'header-below' )  ) : ?>
	<aside id="header-below" class="widget-area">
		<?php dynamic_sidebar( 'header-below' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
