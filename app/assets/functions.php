<?php
/**
* functions and definitions
*
* @package DigiCatt Media
*/
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly.
}
setlocale(LC_MONETARY, 'en_US' );
// TINYMCE EDITOR FIX FOR NOT STRIPPING TAGS
function override_mce_options($initArray) {
$opts = '*[*]';
$initArray['valid_elements'] = $opts;
$initArray['extended_valid_elements'] = $opts;
return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');

/**
 * REGISTERS AN EDITOR STYLESHEET FOR THE THEME.
 */
function register_editor_stylesheet() {
    add_editor_style( get_stylesheet_directory_uri() . '/styles/sitio.css');
}
add_action( 'admin_init', 'register_editor_stylesheet' );


// DEREGISTER NATIVE JQUERY ON BACKEND

function my_jquery_enqueueb() {

   wp_register_script('jquery-ccm', get_stylesheet_directory_uri() . '/scripts/vendor/jquery.js', false, null);
   wp_enqueue_script('jquery-ccm');
}
add_action("admin_enqueue_scripts", "my_jquery_enqueueb", 10);


// DEREGISTER NATIVE JQUERY ON FRONTEND

function my_jquery_enqueuef() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', get_stylesheet_directory_uri() . '/scripts/vendor/jquery.js', false, null);
   wp_enqueue_script('jquery');
}
add_action("wp_enqueue_scripts", "my_jquery_enqueuef", 10);


// CSS & JS
function ccm_enqueue_assets() {
wp_enqueue_style('styles-bundle', get_stylesheet_directory_uri() . '/styles/sitio.css');
wp_enqueue_style('vendorstyles-bundle', get_stylesheet_directory_uri() . '/styles/vendor.css');
wp_enqueue_script('vendor-bundle', get_stylesheet_directory_uri() . '/scripts/vendor.js', '', '', true);
wp_enqueue_script('custom-bundle', get_stylesheet_directory_uri() . '/scripts/sitio.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'ccm_enqueue_assets');


// THUMBNAIL-SUPPORT
add_theme_support( 'post-thumbnails' );
add_image_size( 'large-full', 2048, 2048 ); //300 pixels wide (and unlimited height)


// NAVWALKER
require_once get_template_directory() . '/wp-bootstrap-navwalker.php';
register_nav_menus( array(
'primary' => __( 'Primary Menu', 'menu_principal' ),
) );

// Register Theme Features
function titulo()  {

// Add theme support for document Title tag
add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'titulo' );
