<?php

/**
 * Add Post Thumbnails
 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50, true );
add_image_size( 'facebook', 600, 315, true );

/*
 *  ADD SUPPORT FOR VARIOUS THUMBNAIL SIZES
 *  http://codex.wordpress.org/Function_Reference/add_image_size
 */
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'post-thumb', 250, 140, true ); //(cropped)
}

/**
 * Post Thumbnail Linking to the Post Permalink
 * http://codex.wordpress.org/Function_Reference/the_post_thumbnail#Post_Thumbnail_Linking_to_the_Post_Permalink
*/
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
function my_post_image_html( $html, $post_id, $post_image_id ) {
  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '" class="post-thumb">' . $html . '</a>';
  return $html;
}

/*
 * Link Images Set to "None" by Default
 * Source: http://www.wpbeginner.com/wp-tutorials/automatically-remove-default-image-links-wordpress/
*/
function wpb_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );
  if ($image_set !== 'none') {
    update_option( 'image_default_link_type', 'none' );
  }
}
add_action( 'admin_init', 'wpb_imagelink_setup', 10 );

/**
 * Retrieve the post thumbnail SRC
 */
function display_post_thumbnail_src( $id = 0, $size = 'thumbnail' ) {
  $post     = get_post( $id );
  $post_id  = isset( $post->ID ) ? $post->ID : 0;
  $attsrc         = '';
  $atturl         = '';
  $featured_src   = '';
  $featured_url   = '';
  $images         = '';
  $images = get_children( array(
    'numberposts'    => 1,
    'post_mime_type' => 'image',
    'post_parent'    => $post_id,
    'post_status'    => null,
    'post_type'      => 'attachment',
  ));
  if ( has_post_thumbnail( $post_id ) ) {  // author set a specific Featured Image
    $featured_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    $featured_url = wp_get_attachment_url( get_post_thumbnail_id( $post_id ), $size );
    if ( isset( $featured_src ) ) {
      return $featured_src[0];
    }
  } elseif ( $images ) { // author has uploaded various image attachments, and may or may not have put them in the content
    foreach( $images as $image ) {
      $attsrc = wp_get_attachment_image_src( $image->ID, $size ); // Get attachment image src
      $atturl = wp_get_attachment_url( $image->ID );
      if ( isset( $attsrc ) ) {
        return $attsrc[0];
      }
    }
  } else { // no images uploaded to this post, so a default image is what we need
    return DEFAULT_PHOTO;
  }
}

/**
 * Display the post thumbnail
 */
function display_post_thumbnail( $id = 0, $size = 'thumbnail' ) {
  $post     = get_post( $id );
  $post_id  = isset( $post->ID ) ? $post->ID : 0;
  $link     = get_permalink( $post_id );
  $src      = display_post_thumbnail_src( $post_id, $size );
  if ( $src ) {
    if ( $src == DEFAULT_PHOTO ) {
      $class    = 'post-thumb default-photo';
      $img_src  = DEFAULT_PHOTO;
    } else {
      $class    = 'post-thumb';
      $img_src  = $src;
    }
    echo '<a href="' . $link . '" title="Permanent Link to ' . esc_attr( get_the_title( $post_id ) ) . '" class="' . $class . '"><img src="' . $img_src . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="attachment-post-thumbnail wp-post-image" itemprop="image"></a>';
  }
}

/*
 * WordPress SEO Plugin was setting every image in the post to og:image, causing
 * wrong image to show in Facebook share. Manipulating WordPress SEO’s choice of
 * Open Graph image Source: http://webgilde.com/en/wordpress-seo-facebook-image-open-graph/
 */
function mysite_opengraph_image_size( $val ) {
  return 'facebook';
}
add_filter( 'wpseo_opengraph_image_size', 'mysite_opengraph_image_size' );

function mysite_opengraph_single_image_filter( $val ) {
  if ( preg_match( '/-600x/', $val ) ) {
    return $val;
  }
}
add_filter( 'wpseo_opengraph_image', 'mysite_opengraph_single_image_filter' );
