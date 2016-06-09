<?php

/* =BEGIN: Remove Yoast SEO Canonical URLs + WP SEO Title
    Source: http://wordpress.org/support/topic/plugin-wordpress-seo-by-yoast-disbale-on-specific-pages#post-4008241
   ---------------------------------------------------------------------------------------------------- */
  /**
   *  Get Some Posts
   *
   *  @author   Nate Jacobs
   *  @link   https://gist.github.com/1263835
   */
  function get_school_posts() {
    global $post;
    $short_title = get_the_title($post->ID);
    $short_title = str_replace('Online Colleges in ', "", $short_title);
    $short_title = str_replace('Online Schools in ', "", $short_title);
    $args = array(
      'numberposts' => -1,
      'post_type'   => 'school',
      'meta_value'  => $short_title,
      'orderby'     => 'title',
      'order'       => 'ASC',
    );
    $school_list = get_posts($args);
    $school_list_count = round(count($school_list), -1);
    // Creating an array of the 3 items I need to pull out and repeat on the State pages.
    $state_school_array[] = $short_title;
    $state_school_array[] = $school_list;
    $state_school_array[] = $school_list_count;
    // After we return this array, calls to this array can be made like: $school_list_count = get_school_posts()[2];
    // HAHA. You can't do that on anything less than PHP 5.4. It has to be split into 2 calls.
    return $state_school_array;
  }
  add_filter( 'wpseo_canonical', 'wpseo_canonical_exclude' );
  function wpseo_canonical_exclude( $canonical ) {
    global $post;
    if ( is_page('profile') ) {
      $canonical = false;
    }
    return $canonical;
  }
  add_filter( 'wpseo_title', 'wpseo_title_exclude' );
  function wpseo_title_exclude( $title ) {
    global $wpseo_front, $post;
    if ( defined( 'HYDRA_PROFILE_NAME' ) && is_page('profile') ) {
      $title = HYDRA_PROFILE_NAME . ' - ' . get_bloginfo('name');
    }
    // Rewriting single State Page titles. NOTE: This overwrites any on-page SEO and the Custom Post Type Yoast SEO settings within the plugin. REF: https://basecamp.com/1775234/projects/198200-onlinecolleges-net/todos/56519568-count-schools-per
    if ( 'state' == get_post_type() ) {
      $title = 'Accredited Online Colleges in ' . get_the_title($post->ID);
    }
    return $title;
  }
  function my_opengraph_title( $title ) {
    // This function is to work with the OG SEO titles (separate from the meta titles above)
    global $post;
    // http://wordpress.org/support/topic/remove-site-name-from-each-articles-ogtitle#post-4379598
    if ( defined( 'HYDRA_PROFILE_NAME' ) && is_page('profile') ) {
      $title = HYDRA_PROFILE_NAME . ' - ' . get_bloginfo('name');
    }
    return $title;
  }
  add_filter( 'wpseo_opengraph_title', 'my_opengraph_title' );
