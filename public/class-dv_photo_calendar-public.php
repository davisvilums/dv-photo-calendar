<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       davis.vilums.me
 * @since      1.0.0
 *
 * @package    Dv_photo_calendar
 * @subpackage Dv_photo_calendar/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dv_photo_calendar
 * @subpackage Dv_photo_calendar/public
 * @author     Davis <davis@vilums.me>
 */
class Dv_photo_calendar_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dv_photo_calendar-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dv_photo_calendar-public.js', array( 'jquery' ), $this->version, false );

	}

  /**
   * Create Days shortcode
   */
  public function create_shortcode()
  {
    add_shortcode( 'photo_calendar_print_posts', array($this, 'print_posts_callback'));
  }

  /**
   * Callback to handle 'photo_calendar_print_posts' shortcode
   * @param  $atts Attributes passed to shortcode
   * @return string       Html to rendered
   */
  public function print_posts_callback( $atts ){

    // $atts = shortcode_atts( [
    //   'number_of_posts' => 0
    // ], $atts, 'photo_calendar_print_posts');
    

    // $args = [
    //   'post_type' => 'day',
    //   'posts_per_page' => is_numeric( $atts['number_of_posts']) ? $atts['number_of_posts'] : 10
    // ];

    // $query = new \WP_Query( $args );   

    // echo '<pre>';
    // print_r($query);
    // echo '</pre>';

    // return $this->get_view()->display_posts([
    //   'fetched_posts' => $query
    // ]);

    // return View::render_template('frontend/print-posts-shortcode.php', [
    //   'fetched_posts' => $this->get_model()->fetch_posts( $atts )
    // ]);
  }

}
