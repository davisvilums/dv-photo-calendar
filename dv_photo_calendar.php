<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              davis.vilums.me
 * @since             1.0.0
 * @package           Dv_photo_calendar
 *
 * @wordpress-plugin
 * Plugin Name:       DV Photo Calendar
 * Plugin URI:        davis.vilums.me
 * Description:       This is a plugin to create photo calendar where to upload an image for every single day of the year
 * Version:           1.0.0
 * Author:            Davis
 * Author URI:        davis.vilums.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dv_photo_calendar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if(!defined("DV_PLUGIN_DIR")) 
  define("DV_PLUGIN_DIR", plugin_dir_path(__FILE__));
if(!defined("DV_PLUGIN_URL")) 
  define("DV_PLUGIN_URL", plugins_url()."/dv_photo_calendar");

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DV_PHOTO_CALENDAR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dv_photo_calendar-activator.php
 */
function activate_dv_photo_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dv_photo_calendar-activator.php';
	Dv_photo_calendar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dv_photo_calendar-deactivator.php
 */
function deactivate_dv_photo_calendar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dv_photo_calendar-deactivator.php';
	Dv_photo_calendar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dv_photo_calendar' );
register_deactivation_hook( __FILE__, 'deactivate_dv_photo_calendar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dv_photo_calendar.php';

/**
 * Creating Day Post type
 */
function create_day_posttype() {
  register_post_type( 'day',
  // CPT Options
      array(
          'labels' => array(
              'name' => __( 'Days' ),
              'singular_name' => __( 'Day' )
          ),
          'public' => true,
          'has_archive' => true,
          'menu_icon' => 'dashicons-format-image',
          'supports' => array('title','thumbnail'),
          'rewrite' => array('slug' => 'day'),
      )
  );
}
add_action( 'wp_loaded', 'create_day_posttype');

// function dv_load_menus() {
//   add_menu_page("Display Calendar", "Nokalpots Calendar", "manage_options", "calendar-menu","dv_menu_item", "dashicons-admin-plugins", 30);
// }
// add_action("admin_menu", "dv_load_menus");


  // if ( is_post_type_archive('day') ) {
  //   die('234');
  //   $theme_files = array('archive-my_plugin_lesson.php', 'myplugin/archive-lesson.php');
  //   $exists_in_theme = locate_template($theme_files, false);
  //   if ( $exists_in_theme != '' ) {
  //     return $exists_in_theme;
  //   } else {
  //     return plugin_dir_path(__FILE__) . 'archive-lesson.php';
  //   }
  // }

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dv_photo_calendar() {

	$plugin = new Dv_photo_calendar();
	$plugin->run();

}
run_dv_photo_calendar();
