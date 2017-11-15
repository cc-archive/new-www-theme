<?php


/*
 * Release serial number - Used to bust the cache. Please update
 *                         any time you change CSS or JS.
 */
define('CC_CSS_RELEASE_SERIAL_NUMBER', '20170810');

function twentysixteen_entry_meta() {

  if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
    twentysixteen_entry_date();
  }

  $format = get_post_format();
  if ( current_theme_supports( 'post-formats', $format ) ) {
    printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
      sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentysixteen' ) ),
      esc_url( get_post_format_link( $format ) ),
      get_post_format_string( $format )
    );
  }

  if ( 'post' === get_post_type() ) {
    twentysixteen_entry_taxonomies();
  }

}


function cc_setup() {
  remove_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'cc_setup', 9999 );

/**
 * Enqueue Scripts / Styles
 */
function cc_enqueue_scripts() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

  wp_enqueue_style(
    'cc-google-fonts',
    '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|Roboto+Condensed'
  );

  wp_enqueue_style(
    'cc-fontello',
    get_stylesheet_directory_uri() . '/fonts/fontello/css/cc-fontello.css'
  );

  wp_enqueue_style(
    'cc-style',
    get_stylesheet_directory_uri() . '/css/app.css',
    array( 'parent-style', 'cc-google-fonts', 'cc-fontello' ),
    CC_CSS_RELEASE_SERIAL_NUMBER
  );

  wp_enqueue_script(
    'cc-breakpoint-body-class',
    get_stylesheet_directory_uri() . '/js/breakpoint-body-class.js',
    array( 'jquery' ),
    CC_CSS_RELEASE_SERIAL_NUMBER,
    true
  );

  wp_enqueue_script(
    'cc-common',
    get_stylesheet_directory_uri() . '/js/cc.js',
    array( 'jquery' ),
    CC_CSS_RELEASE_SERIAL_NUMBER,
    true
  );

  wp_enqueue_script(
    'cc-sticky-nav',
    get_stylesheet_directory_uri() . '/js/sticky-nav.js',
    array( 'cc-common', 'jquery' ),
    CC_CSS_RELEASE_SERIAL_NUMBER,
    true
  );

  wp_enqueue_script(
    'cc-toggle-search',
    get_stylesheet_directory_uri() . '/js/toggle-search.js',
    array( 'jquery' ),
    CC_CSS_RELEASE_SERIAL_NUMBER,
    true
  );

  wp_enqueue_script(
    'cc-donation',
    get_stylesheet_directory_uri() . '/js/donation.js',
    array( 'jquery' ),
    CC_CSS_RELEASE_SERIAL_NUMBER,
    true
  );
}
add_action( 'wp_enqueue_scripts', 'cc_enqueue_scripts' );

/**
 * Dequeue Styles
 */
function cc_dequeue_styles() {
  wp_dequeue_style( 'twentysixteen-fonts');
  wp_deregister_style( 'twentysixteen-fonts');
  wp_dequeue_style( 'genericons');
  wp_deregister_style( 'genericons');
}
add_action( 'wp_enqueue_scripts', 'cc_dequeue_styles', 9999 );
add_action( 'wp_head', 'cc_dequeue_styles', 9999 );

/**
 * Register menus.
 *
 */
function cc_register_menu() {
  register_nav_menus( array(
    'mobile' => __( 'Mobile Menu' ),
    'secondary' => __( 'Secondary Menu' ),
    'footer-links'  => __( 'Footer Links' ),
  ) );
}
add_action('init', 'cc_register_menu');


/**
 * Register custom sidebars and widgetized areas.
 *
 */
function cc_widgets_init() {

  register_sidebar( array(
    'name'          => 'Header Below',
    'id'            => 'header-below',
    'description'   => 'Appears right below the header.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Content Above',
    'id'            => 'content-above',
    'description'   => 'Appears above the content.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Content Above (Mobile)',
    'id'            => 'content-above-mobile',
    'description'   => 'Appears above the content, on mobile.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Content Below Full Top',
    'id'            => 'sidebar-below-content-full',
    'description'   => 'Appears at the bottom of the content on posts and pages.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Content Below Left',
    'id'            => 'sidebar-below-content-left',
    'description'   => 'Appears at the bottom of the content on posts and pages.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Content Below Right',
    'id'            => 'sidebar-below-content-right',
    'description'   => 'Appears at the bottom of the content on posts and pages.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Below Content',
    'id'            => 'content-below',
    'description'   => 'Full width, below the content area.',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="rounded">',
    'after_title'   => '</h2>',
  ) );

  register_sidebar( array(
    'name'          => 'Below Content (Homepage)',
    'id'            => 'home-content-below',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="rounded">',
    'after_title'   => '</h2>',
  ) );
}

function cc_remove_parent_sidebars(){
  unregister_sidebar('sidebar-2');
  unregister_sidebar('sidebar-3');
}

add_action( 'widgets_init', 'cc_widgets_init' );
add_action( 'widgets_init', 'cc_remove_parent_sidebars', 11 );

// stop wp removing span tags
function cc_tinymce_fix($init) {
    $init['extended_valid_elements'] = 'span[*]';
    return $init;
}
add_filter('tiny_mce_before_init', 'cc_tinymce_fix');

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function cc_search_form( $form ) {
    $form  = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '">';
    $form .= '  <label>';
    $form .= '    <span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>';
    $form .= '    <input type="search" class="search-field"';
    $form .= '        placeholder="' . esc_attr_x( 'Search the website', 'placeholder' ) . '"';
    $form .= '        value="' . get_search_query() . '" name="s"';
    $form .= '        title="' . esc_attr_x( 'Search for:', 'label' ) . '" />';
    $form .= '  </label>';
    $form .= '  <button type="submit" class="search-submit" value="' . esc_attr_x( 'Search', 'submit button' ) . '">';
    $form .= '    <span class="screen-reader-text">Search</span>';
    $form .= '  </button>';
    $form .= '</form>';

    return $form;
}
add_filter( 'get_search_form', 'cc_search_form' );

function cc_filter_add_tags_and_category($content) {
  if(is_single()) {
    $new_content = '';
    $categories_list = get_the_category_list(' ', ', ');
    if ($categories_list) {
      $new_content .= '<div class="post-category"><span class="tags-label">Category:</span><span class="categories-links">' . $categories_list . '</span></div>';
    }
    $tag_list = get_the_tag_list('', ', ');
    if ($tag_list) {
      $new_content .= '<div class="post-tags"><span class="tags-label">Tags:</span><span class="tags-links">' . $tag_list . '</span></div>';
    }

    $content .= $new_content;
  }
  return $content;
}
add_filter('the_content', 'cc_filter_add_tags_and_category');

function cc_modify_read_more_link() {
  return sprintf('<a class="more-link" href="' . get_permalink() . '">Read More<span class="screen-reader-text"> "%s"</span></a>', get_the_title( get_the_ID() ));
}
add_filter( 'the_content_more_link', 'cc_modify_read_more_link' );

// Gotta keep the name as twentysixteen or else the base theme will override it.

function twentysixteen_excerpt_more() {
  $link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
    esc_url( get_permalink( get_the_ID() ) ),
    /* translators: %s: Name of current post */
    sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ), get_the_title( get_the_ID() ) )
  );
  return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentysixteen_excerpt_more' );


add_filter ('eat_exclude_types', 'cc_eat_excluded_types', 10, 1);
function cc_eat_excluded_types ( $exclude_types ){
    $exclude_types[] = 'page';
    return $exclude_types;
}

// Allow shortcodes in html widgets.
add_filter('widget_text','do_shortcode');

?>