<?php
/*
 * Create `programs` custom post type for this theme.
 */

function renos_renos() {
  $args = array(
    'labels'              => create_cpt_labels( 'Reno' ),
    'hierarchical'        => false,
    'description'         => 'description',
    'taxonomies'          => array(),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 7,
    'menu_icon'           => 'dashicons-store',
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => false,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'supports'            => array(
      'title', 'editor', 'author', 'revisions', 'page-attributes'
    )
  );

  register_post_type( 'renos', $args );
}
add_action( 'init', 'renos_renos' );

function renos_rooms() {
  $labels = array(
    'name'                  => _x( 'Rooms', 'Taxonomy plural name', 'renos-theme' ),
    'singular_name'         => _x( 'Room', 'Taxonomy singular name', 'renos-theme' ),
    'search_items'          => __( 'Search Rooms', 'renos-theme' ),
    'popular_items'         => __( 'Popular Rooms', 'renos-theme' ),
    'all_items'             => __( 'All Rooms', 'renos-theme' ),
    'parent_item'           => __( 'Parent Room', 'renos-theme' ),
    'parent_item_colon'     => __( 'Parent Room', 'renos-theme' ),
    'edit_item'             => __( 'Edit Room', 'renos-theme' ),
    'update_item'           => __( 'Update Room', 'renos-theme' ),
    'add_new_item'          => __( 'Add New Room', 'renos-theme' ),
    'new_item_name'         => __( 'New Room Name', 'renos-theme' ),
    'add_or_remove_items'   => __( 'Add or remove Rooms', 'renos-theme' ),
    'choose_from_most_used' => __( 'Choose from most used Rooms', 'renos-theme' ),
    'menu_name'             => __( 'Room', 'renos-theme' ),
  );

  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => true,
    'hierarchical'      => true,
    'show_tagcloud'     => false,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => true,
    'query_var'         => true,
    'capabilities'      => array(),
  );

  register_taxonomy( 'room', array( 'rooms' ), $args );
}
add_action( 'init', 'renos_rooms' );
?>