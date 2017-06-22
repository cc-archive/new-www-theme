<?php
/**
 * The template for displaying all single posts and attachments
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
      <?php get_sidebar( 'content-above-mobile' ); ?>
      <?php get_sidebar( 'content-above' ); ?>

  		<?php
  		// Start the loop.
  		while ( have_posts() ) : the_post();

  			// Include the single post content template.
  			get_template_part( 'template-parts/content', 'single' );

  			// If comments are open or we have at least one comment, load up the comment template.
  			if ( comments_open() || get_comments_number() ) {
  				comments_template();
  			}

  			if ( is_singular( 'attachment' ) ) {
  				// Parent post navigation.
  				the_post_navigation( array(
  					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
  				) );
  			}

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

<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us13.list-manage.com","uuid":"4051250396fe81f55034e2d49","lid":"5b82643372"}) })</script>

<?php get_footer(); ?>
