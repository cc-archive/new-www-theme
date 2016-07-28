<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
    		<?php if ( have_posts() ) : ?>
    			<?php if ( is_home()) : ?>
    				<header>
    					<h1 class="page-title">News</h1>
    				</header>
    			<?php endif; ?>

          <?php
              // We want to suppress hero/featured posts from the main
              // post list.
              $featured_post_ids = array();
              if (function_exists('cc_widgets_get_featured_post_ids')){
                $featured_post_ids = cc_widgets_get_featured_post_ids();
              }
          ?>

    			<?php
    			// Start the loop.
    			while ( have_posts() ) : the_post();

            // Skip display of featured posts.
            if (in_array(get_the_ID(), $featured_post_ids)){
              continue;
            }

    				/*
    				 * Include the Post-Format-specific template for the content.
    				 * If you want to override this in a child theme, then include a file
    				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
    				 */
    				get_template_part( 'template-parts/content', get_post_format() );

    			// End the loop.
    			endwhile;

    			// Previous/next page navigation.
    			the_posts_pagination( array(
    				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
    				'next_text'          => __( 'Next page', 'twentysixteen' ),
    				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
    			) );

    		// If no content, include the "No posts found" template.
    		else :
    			get_template_part( 'template-parts/content', 'none' );

    		endif;
    		?>

      </main><!-- .site-main -->
      <?php get_sidebar( 'content-bottom' ); ?>
    </div>
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
      <div id="wrapper-sidebar" class="wrapper-sidebar">
        <?php get_sidebar(); ?>
      </div>
    <?php endif; ?>
  </div><!-- .content-area -->
<?php get_footer(); ?>
