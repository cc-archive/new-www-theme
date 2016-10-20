<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

  if ( class_exists( 'coauthors_plus' ) ) { // Get the Co-Authors for the post
    $co_authors = get_coauthors();
  } else {
    $co_authors = array();
  }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<div class="author-wrapper">
		<div class="author-image">
	  <?php
	    $author_bio_avatar_size = apply_filters( 'twentysixteen_author_bio_avatar_size', 50 );
      if (count($co_authors)){
        foreach ($co_authors as $an_author){
          echo '<a href="' . get_author_posts_url(get_the_author_meta( 'ID', $an_author->ID ), get_the_author_meta( 'user_nicename', $an_author->ID )) . '">' . get_avatar( get_the_author_meta( 'user_email', $an_author->ID ), $author_bio_avatar_size ) . '</a>';
        }
      } else {
  	    echo '<a href="' . get_author_posts_url(get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' )) . '">' . get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size ) . '</a>';
      }
	    ?>
		</div>
	  <div class="author-info-group">
        <div class="author-name"><h4>
        <?php
        if ( function_exists( 'coauthors_posts_links' ) ) {
            coauthors_posts_links();
        } else {
            the_author_posts_link();
        }
        ?>
        </h4></div>
			<div class="author-date"><?php the_date(); ?></div>
		</div>
	</div>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
