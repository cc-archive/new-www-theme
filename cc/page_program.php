<?php
/**
 *
 * Template Name: Program Template
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

        $post = get_post();
  			// Include the page content template.
  			get_template_part( 'template-parts/content', 'page' );
        $cc_program_left =  htmlspecialchars_decode(get_post_meta($post->ID, 'cc_program_left', TRUE));
        $cc_program_right =  htmlspecialchars_decode(get_post_meta($post->ID, 'cc_program_right', TRUE));
        $cc_program_get_involved =  htmlspecialchars_decode(get_post_meta($post->ID, 'cc_program_get_involved', TRUE));

      ?>

      <div class="two-column">
        <div class="left-column"><?php print $cc_program_left; ?></div>
        <div class="right-column"><?php print $cc_program_right; ?></div>
      </div>
      <div class="get-involved">
        <div><?php print $cc_program_get_involved; ?></div>
      </div>

      <?php
  			// End of the loop.
  		endwhile;
  		?>

  	</main><!-- .site-main -->
	<?php get_sidebar( 'content-bottom' ); ?>
  </div>
  <div id="wrapper-sidebar" class="wrapper-sidebar">
    <?php get_sidebar(); ?>
  </div>
</div><!-- .content-area -->
<!-- content-below -->
<?php get_sidebar( 'content-below' ); ?>
<!-- END content-below -->

<?php get_footer(); ?>
