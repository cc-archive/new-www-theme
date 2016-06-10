<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'content-above-mobile' )  ) : ?>
    <aside id="content-above-mobile" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'content-above-mobile' ); ?>
    </aside><!-- .sidebar .widget-area -->
<?php endif; ?>
