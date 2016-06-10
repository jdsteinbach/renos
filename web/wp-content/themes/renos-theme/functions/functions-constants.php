<?php

if ( !defined( 'WP_ENV' ) ) {
  // Set environment to the last sub-domain (e.g. foo.staging.site.com => 'staging')
  define( 'WP_ENV', array_pop( array_splice( explode( '.', $_SERVER['HTTP_HOST'] ), 0, -2 ) ) );
}
define( 'WWW_URL',      site_url() );
define( 'TMPL_URI',     get_template_directory_uri() );
define( 'TMPL_DIR',     get_template_directory() );
define( 'SVG_DIR',      TMPL_DIR . '/assets/img/svg/' );
define( 'SITE_NAME',    get_option( 'blogname' ) );
define( 'SITE_TAGLINE', get_option( 'blogdescription' ) );
define( 'AUTHOR',       SITE_NAME . ' - '. WWW_URL );
define( 'SS_URI',       get_stylesheet_directory_uri() );
define( 'SS_DIR',       get_stylesheet_directory() );
define( 'DEFAULT_PHOTO',  SS_URI .'/assets/img/default-photo.gif' );
// define( 'TYPEKIT',    'mje2ygi' );
//define( 'FB_APP_ID',  '' );
//define( 'FB_PAGE',    '' );
//define( 'HCO_ACCT',   '123456' );
//define( 'HCO_PROJECT',  123456 );
//define( 'GOOGLE_FONTS',  123456 );
//define( 'TWITTER_USERNAME',       '' );
//define( 'GOOGLE_PLUS_AUTHOR',     '' );
//define( 'GOOGLE_PLUS_PUBLISHER',  '' );