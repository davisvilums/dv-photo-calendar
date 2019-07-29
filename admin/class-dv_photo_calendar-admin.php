<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       davis.vilums.me
 * @since      1.0.0
 *
 * @package    Dv_photo_calendar
 * @subpackage Dv_photo_calendar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dv_photo_calendar
 * @subpackage Dv_photo_calendar/admin
 * @author     Davis <davis@vilums.me>
 */
class Dv_photo_calendar_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dv_photo_calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dv_photo_calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dv_photo_calendar-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dv_photo_calendar_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dv_photo_calendar_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dv_photo_calendar-admin.js', array( 'jquery' ), $this->version, false );

	}

  public function dv_photo_calendar_admin_menu() {
    add_submenu_page("edit.php?post_type=day", "Displays Calendar", "Display Calendar", "manage_options", "display-calendar", array($this, "dv_menu_item"));
  }

  public function dv_menu_item() {
    include_once DV_PLUGIN_DIR . '/admin/partials/dv_photo_calendar-admin-calendar.php';
  }

}
