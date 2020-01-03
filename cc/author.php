<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

global $wp_query;
$author = get_queried_object();
$group = get_user_meta( $author->ID, 'cc_group', true );
$is_guest = ( empty( $group ) ) ? true : false;
?>

<!-- header-below -->
<?php get_sidebar( 'header-below' ); ?>
<!-- END header-below -->
	<div id="primary" class="content-area">
    <div id="wrapper-main" class="wrapper-main">
      <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
        <?php if(function_exists('bcn_display')){
          if ( $is_guest ) {
            echo '<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">';
              echo '<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to Creative Commons." href="'.get_bloginfo( 'url' ).'" class="home"><span property="name">Creative Commons</span></a><meta property="position" content="1"></span>  &gt; ';
              echo '<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to blog." href="'.site_url( 'blog' ).'" class="about"><span property="name">Blog</span></a><meta property="position" content="2"></span>  &gt; ';
              echo '<span property="itemListElement" typeof="ListItem"><span property="name">Articles by: '.$author->display_name.'</span><meta property="position" content="3"></span>';
            echo '</div>';
          } else {
            bcn_display();
          }
        }?>
      </div>

      <main id="main" class="site-main" role="main">

  			<header class="author-page-header">
					<div class="author-info-container">
	          <div class="author-image">
	            <?php print get_avatar($author->ID, '300'); ?>
	          </div>
            <?php if ( !$is_guest ): ?>
              <div class="author-intro">
                <h1><?php print $author->first_name . ' ' . $author->last_name; ?></h1>
                <div class="name"><?php print $author->first_name . ' ' . $author->last_name; ?></div>
                <div class="position"><?php print $author->cc_position; ?></div>
                <div class="description"><?php print $author->description; ?></div>
                <?php
                if ( is_user_logged_in() ) {
                    print '<div class="edit-user-profile"><a href="' . get_edit_user_link($author->ID) .'">Edit profile</a></div>';
                }
                ?>
                <div class="social-links">
                  <?php if ($author->twitter): ?>
                    <a href="https://twitter.com/<?php print $author->twitter; ?>"><span class="genericon genericon-twitter"></span></a>
                  <?php endif; ?>
                  <?php if (filter_var($author->cc_linkedin, FILTER_VALIDATE_URL)): ?>
                    <a href="<?php print $author->cc_linkedin; ?>"><span class="genericon genericon-linkedin"></span></a>
                  <?php endif; ?>
                  <?php if (filter_var($author->facebook, FILTER_VALIDATE_URL)): ?>
                    <a href="<?php print $author->facebook; ?>"><span class="genericon genericon-facebook"></span></a>
                  <?php endif; ?>
                  <?php /* if (filter_var($author->user_email, FILTER_VALIDATE_EMAIL)): ?>
                    <a href="mailto:<?php print $author->user_email; ?>"><span class="genericon genericon-mail"></span></a>
                  <?php endif; */ ?>
                </div>
              </div>
            <?php endif; ?>
					</div>
  			</header><!-- .page-header -->

        <?php get_sidebar( 'content-above-mobile' ); ?>
        <?php get_sidebar( 'content-above' ); ?>

        <div class="bio">
					<span class="author-first-last"><?php print $author->first_name . ' ' . $author->last_name; ?></span>
          <?php print wpautop(htmlspecialchars_decode($author->cc_biography)); ?>
        </div>

        <?php if(!empty($post->post_content)) { ?>
          <h3 class="news-rule"><?php print $author->first_name; ?>'s News</h3>
        <?php } ?>

        <?php
          // Start the Loop.
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

