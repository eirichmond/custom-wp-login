<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://squareonemd.co.uk
 * @since      1.0.0
 *
 * @package    SQ1_Custom_Login
 * @subpackage SQ1_Custom_Login/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    SQ1_Custom_Login
 * @subpackage SQ1_Custom_Login/admin
 * @author     Your Name <email@example.com>
 */
class SQ1_Custom_Login_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $sq1_custom_name    The ID of this plugin.
	 */
	private $sq1_custom_name;

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
	 * @param      string    $sq1_custom_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sq1_custom_name, $version ) {

		$this->sq1_custom_name = $sq1_custom_name;
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
		 * defined in SQ1_Custom_Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The SQ1_Custom_Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->sq1_custom_name, plugin_dir_url( __FILE__ ) . 'css/sq1-custom-login-admin.css', array(), $this->version, 'all' );

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
		 * defined in SQ1_Custom_Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The SQ1_Custom_Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->sq1_custom_name, plugin_dir_url( __FILE__ ) . 'js/sq1-custom-login-admin.js', array( 'jquery' ), $this->version, false );

	}

}
