<?php
require_once dirname(__FILE__) . '/z-protect.php';
@session_start();

do_action('wputh_functionsphp_start');

/* Globals
 -------------------------- */

define("THEME_URL", get_template_directory_uri());
define("IS_AJAX", isset($_GET['ajax']));

// load-more || numbers || default
define('PAGINATION_KIND', 'numbers');

/* Social links
 -------------------------- */

if (!isset($wpu_social_links) || !is_array($wpu_social_links)) {
    $wpu_social_links = array(
        'twitter' => 'Twitter',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
    );
    $wpu_social_links = apply_filters('wpu_social_links', $wpu_social_links);
}

define('WPU_SOCIAL_LINKS', serialize($wpu_social_links));

/* Post Types
 -------------------------- */

add_filter('wputh_get_posttypes', 'wputh_set_theme_posttypes');
if (!function_exists('wputh_set_theme_posttypes')) {
    function wputh_set_theme_posttypes($post_types) {

        // $post_types['work'] = array(
        //     'menu_icon' => 'dashicons-portfolio',
        //     'name' => __('Work', 'wputh') ,
        //     'plural' => __('Works', 'wputh') ,
        //     'female' => 0
        // );
        return $post_types;
    }
}

/* Taxonomies
 -------------------------- */

add_filter('wputh_get_taxonomies', 'wputh_set_theme_taxonomies');
if (!function_exists('wputh_set_theme_taxonomies')) {
    function wputh_set_theme_taxonomies($taxonomies) {

        // $taxonomies['work-type'] = array(
        //     'name' => __( 'Work type', 'wputh' ),
        //     'post_type' => 'work'
        // );

        return $taxonomies;
    }
}

/* Menus
 -------------------------- */

$default_menus = array(
    'main' => __('Main menu', 'wputh') ,
);
$wputh_menus = apply_filters('wputh_default_menus', $default_menus);
if (!empty($wputh_menus)) {
    register_nav_menus($wputh_menus);
}

/* Sidebars
 -------------------------- */

$default_sidebars = array(
    array(
        'name' => __('Default Sidebar', 'wputh') ,
        'id' => 'wputh-sidebar',
        'description' => __('Default theme sidebar', 'wputh') ,
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    )
);

$wputh_sidebars = apply_filters('wputh_default_sidebars', $default_sidebars);
if (!empty($wputh_sidebars)) {
    foreach ($wputh_sidebars as $wputh_sidebar) {
        register_sidebar($wputh_sidebar);
    }
}

/* Thumbnails
 -------------------------- */

// Default featured image size size
if (function_exists('set_post_thumbnail_size')) {
    set_post_thumbnail_size(1024, 1024);
}

/* ----------------------------------------------------------
  Includes
---------------------------------------------------------- */

/* Theme
 -------------------------- */

require_once get_template_directory() . '/inc/theme/pages.php';
require_once get_template_directory() . '/inc/theme/params.php';
require_once get_template_directory() . '/inc/theme/utilities.php';
require_once get_template_directory() . '/inc/theme/shortcodes.php';
require_once get_template_directory() . '/inc/theme/activation.php';
require_once get_template_directory() . '/inc/theme/customize.php';
require_once get_template_directory() . '/inc/theme/default-items.php';

if (!isset($content_width)) $content_width = 680;

/* Plugins Configuration
 -------------------------- */

require_once get_template_directory() . '/inc/plugins/wpu-options.php';
require_once get_template_directory() . '/inc/plugins/wpu-tinymce.php';

/* Assets
 -------------------------- */

require_once get_template_directory() . '/inc/assets/styles.php';
require_once get_template_directory() . '/inc/assets/scripts.php';

/* Widgets
 -------------------------- */

require_once get_template_directory() . '/tpl/widgets/widget_push.php';
require_once get_template_directory() . '/tpl/widgets/widget_post_categories.php';

/* Langs
 -------------------------- */

add_action('after_setup_theme', 'wputh_setup');
if (!function_exists('wputh_setup')) {
    function wputh_setup() {
        load_theme_textdomain('wputh', get_template_directory() . '/inc/lang');
    }
}

do_action('wputh_functionsphp_end');
