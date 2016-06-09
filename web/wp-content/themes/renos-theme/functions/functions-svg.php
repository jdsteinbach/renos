<?php
/*
 * Returns contents of an SVG to the DOM
 */
function get_svg( $name, $class = false ) {

  $file_path = SVG_DIR . $name . '.svg';

  if ( file_exists( $file_path ) ) {

    $file_contents = file_get_contents( $file_path );
    $file_contents = str_replace( '<svg', '<svg aria-hidden="true" ', $file_contents );

    if ( $class ) {
      $file_contents = str_replace( '<svg', '<svg class="' . $class . '" ', $file_contents );
    }
    return $file_contents;
  }
}

/*
 * Allow SVG Uploads in Dashboard
 */
function svg_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'svg_mime_types' );

/*
 * Fix Dashboard display of SVGs
 */
function admin_svg_size() {
  echo '<style>
    svg, img[src*=".svg"] {
      max-width: 150px !important;
      max-height: 150px !important;
    }
  </style>';
}
add_action( 'admin_head', 'admin_svg_size' );
