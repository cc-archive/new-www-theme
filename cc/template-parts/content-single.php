<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
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
	    echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
	    ?>
		</div>
	  <div class="author-info-group">
	  	<div class="author-name"><h4><?php echo get_the_author(); ?></h4></div>
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
