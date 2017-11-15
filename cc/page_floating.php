<?php
/**
 *
 * Template Name: Floating Content Template
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

function cc_new_www_theme_no_title ($title) { return ""; }

function cc_new_www_theme_floating_doctyype( $output, $doctype ) {
	if ( 'html' !== $doctype ) {
		return $output;
	}
	$output .= ' class="no-js html-floating"';
	return $output;
}

?>
<!DOCTYPE html>
<html <?php
    add_filter(
        'language_attributes',
        'cc_new_www_theme_floating_doctyype',
        10,
        2
    );
    language_attributes();
    remove_filter(
        'language_attributes',
        'cc_new_www_theme_floating_doctyype'
    );
?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
    <?php if ( has_post_thumbnail() ) : ?>
    <style type="text/css">
         body {
            background-image:url("<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[ 0 ]; ?>");
            background-repeat: no-repeat;
            background-size:cover;
        }
    </style>
	<?php endif; ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body <?php body_class( 'body-floating' ); ?>>
    <header id="masthead" class="site-header sticky-nav-main site-header-floating"></header>
<div id="primary" class="content-area content-area-floating">
  <div id="wrapper-main" class="wrapper-main wrapper-main-floating">
  	<main id="main" class="site-main site-main-floating" role="main">
  		<?php
            add_filter( 'the_title', 'cc_new_www_theme_no_title' );
    		// Start the loop.
    		while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                   <div class="entry-content" >
                	  <?php the_content(); ?>
                	</div><!-- .entry-content -->
                   </article><!-- #post-## -->
    		<?php endwhile;
            remove_filter( 'the_title', 'cc_new_www_theme_no_title' );
  		?>
  	</main><!-- .site-main -->
  </div><!-- .wrapper-main -->
</div><!-- .content-area -->

<?php wp_footer(); ?>

</body>
</html>
