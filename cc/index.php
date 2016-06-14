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
    			// Start the loop.
    			while ( have_posts() ) : the_post();

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
        <section id="gform_widget-4" class="widget-5 widget-last widget-odd widget gform_widget"><h2 class="widget-title">Connect with Creative Commons</h2><link rel="stylesheet" id="gforms_reset_css-css" href="https://staging.creativecommons.org/wp-content/plugins/gravityforms/css/formreset.css?ver=1.9.19" type="text/css" media="all">
<link rel="stylesheet" id="gforms_formsmain_css-css" href="https://staging.creativecommons.org/wp-content/plugins/gravityforms/css/formsmain.css?ver=1.9.19" type="text/css" media="all">
<link rel="stylesheet" id="gforms_ready_class_css-css" href="https://staging.creativecommons.org/wp-content/plugins/gravityforms/css/readyclass.css?ver=1.9.19" type="text/css" media="all">
<link rel="stylesheet" id="gforms_browsers_css-css" href="https://staging.creativecommons.org/wp-content/plugins/gravityforms/css/browsers.css?ver=1.9.19" type="text/css" media="all">

                <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_7"><form method="post" enctype="multipart/form-data" id="gform_7" action="/news/">
                        <div class="gform_body"><ul id="gform_fields_7" class="gform_fields top_label form_sublabel_below description_below"><li id="field_7_1" class="gfield field_sublabel_below field_description_below"><label class="gfield_label" for="input_7_1">Email</label><div class="ginput_container ginput_container_email">
                            <input name="input_1" id="input_7_1" value="your email" class="medium" tabindex="1" type="text">
                        </div></li><li id="field_7_2" class="gfield gform_validation_container field_sublabel_below field_description_below"><label class="gfield_label" for="input_7_2">Name</label><div class="ginput_container"><input name="input_2" id="input_7_2" value="" type="text"></div><div class="gfield_description">This field is for validation purposes and should be left unchanged.</div></li>
                            </ul></div>
        <div class="gform_footer top_label"> <input id="gform_submit_button_7" class="gform_button button" value="Sign up" tabindex="2" onclick="if(window[&quot;gf_submitting_7&quot;]){return false;}  window[&quot;gf_submitting_7&quot;]=true;  " type="submit">
            <input class="gform_hidden" name="is_submit_7" value="1" type="hidden">
            <input class="gform_hidden" name="gform_submit" value="7" type="hidden">

            <input class="gform_hidden" name="gform_unique_id" value="" type="hidden">
            <input class="gform_hidden" name="state_7" value="WyJbXSIsImZlZjcyZWE3NTkyZTgyYWE0NDVlZTQ4ODgyZGEyMGEzIl0=" type="hidden">
            <input class="gform_hidden" name="gform_target_page_number_7" id="gform_target_page_number_7" value="0" type="hidden">
            <input class="gform_hidden" name="gform_source_page_number_7" id="gform_source_page_number_7" value="1" type="hidden">
            <input name="gform_field_values" value="" type="hidden">

        </div>
                        </form>
                        </div><script type="text/javascript"> jQuery(document).bind('gform_post_render', function(event, formId, currentPage){if(formId == 7) {} } );jQuery(document).bind('gform_post_conditional_logic', function(event, formId, fields, isInit){} );</script><script type="text/javascript"> jQuery(document).ready(function(){jQuery(document).trigger('gform_post_render', [7, 1]) } ); </script></section>
      </div>
    <?php endif; ?>
  </div><!-- .content-area -->
<?php get_footer(); ?>
