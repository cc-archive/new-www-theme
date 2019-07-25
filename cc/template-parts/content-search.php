<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ): ?>
	<div class="teaser-post-image">
        <?php print the_post_thumbnail('thumbnail'); ?>
    </div>
    <?php endif; ?>

	<div class="entry-content" >
    <?php print the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
		<?php print the_excerpt(); ?>
    <?php
      $categories = get_the_category();
        if ( ! empty( $categories ) ) {
          $category_link  ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
        }
    ?>
    <div class="category"><?php print $category_link; ?></div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->