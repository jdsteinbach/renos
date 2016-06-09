<?php

/**
 * Remove junk from <head>
 * Source: http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions
 * https://wordpress.org/support/topic/removing-emoji-code-from-header?replies=7#post-6864480
 */
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds

// Remove Emoji code from header
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/**
 * Remove Query Strings from Static Resources
 */
function dequeue_jquery_migrate( &$scripts){
  if(!is_admin()){
    $scripts->remove( 'jquery');
    $scripts->add( 'jquery', false, array( 'jquery-core' ) );
  }
}
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

/**
 * Remove Query Strings from Static Resources
 * Source: http://forwpblogger.com/tutorial/remove-query-strings-from-static-resources/
 */
function _remove_script_version( $src ){
  $parts = explode( '?ver=', $src );
  $parts = explode( '&ver=', $parts[0] );
  return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

/**
 * Remove Yoast SEO Canonical URLs + WP SEO Title
 * http://yoast.com/wordpress/seo/api/#highlighter_245949
 */
function wpseo_disable_rel_next_home( $link ) {
  if ( is_front_page() || is_home() ) {
    return false;
  }
}
add_filter( 'wpseo_next_rel_link', 'wpseo_disable_rel_next_home' );

/**
 * Disable WordPress Comments
 * http://www.dfactory.eu/wordpress-how-to/turn-off-disable-comments/
 */
/**
 * Disable support for comments and trackbacks in post types
 */
function df_disable_comments_post_types_support() {
  $post_types = get_post_types();
  foreach ($post_types as $post_type) {
    if(post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
}
add_action('admin_init', 'df_disable_comments_post_types_support');
/**
  * Close comments on the front-end
 */
function df_disable_comments_status() {
  return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
/**
 * Hide existing comments
 */
function df_disable_comments_hide_existing_comments($comments) {
  $comments = array();
  return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
/**
 * Remove comments page in menu
 */
function df_disable_comments_admin_menu() {
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
/**
 * Redirect any user trying to access comments page
 */
function df_disable_comments_admin_menu_redirect() {
  global $pagenow;
  if ($pagenow === 'edit-comments.php') {
    wp_redirect(admin_url()); exit;
  }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
/**
 * Remove comments metabox from dashboard
 */
function df_disable_comments_dashboard() {
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');
/**
 * Remove comments links from admin bar
 */
function df_disable_comments_admin_bar() {
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}
add_action('init', 'df_disable_comments_admin_bar');


/**
 * Add category nicenames in body and post class
 */
function category_id_class( $classes ) {
  global $post;
  foreach ( get_the_category( $post->ID) as $category ) {
    $classes[] = $category->category_nicename;
    }
  return $classes;
}
add_filter( 'post_class', 'category_id_class' );
add_filter( 'body_class', 'category_id_class' );


/**
 * Add new classes to the $classes array
 * http://codex.wordpress.org/Function_Reference/body_class#Add_Classes_By_Filters
 */
add_filter( 'body_class','my_class_names' );
function my_class_names( $classes ) {
  global $post;
  if ( is_front_page() ) :
    $classes[] = 'home';
  elseif ( is_page() ) :
    $classes[] = $post->post_name;
  elseif( is_archive() ) :
    $classes[] = 'archive';
  elseif( is_404() ) :
    $classes[] = 'error';
  elseif( is_search() ) :
    $classes[] = 'search';
  endif;
  return $classes;
}

/**
 * Remove Recent Comments CSS from head
 */
function my_remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'  ) );
}
add_action( 'widgets_init', 'my_remove_recent_comments_style' );
