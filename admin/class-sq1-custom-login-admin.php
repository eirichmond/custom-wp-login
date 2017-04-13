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
 

	public function sq1_custom_login_settings() {
	    $page = add_submenu_page(
	        'options-general.php',
	        'Custom Login',
	        'Custom Login',
	        'manage_options',
	        'custom-login-settings',
	        array($this, 'sq1_custom_login_settings_page_callback')
	    );
	    
	}
	
	public function sq1_custom_login_admin_scripts() {
		
		wp_enqueue_script( $this->sq1_custom_name.'-admin-settings', plugin_dir_url( __FILE__ ) . 'js/sq1-custom-login-admin-settings.js', array( 'jquery' ), $this->version, false );
		
		$login_logo_attachment_post_id = array('login_logo_attachment_post_id' => get_option( 'media_selector_attachment_id', 0 ));
		
		wp_localize_script( $this->sq1_custom_name.'-admin-settings', 'object_name', $login_logo_attachment_post_id );


	}
	
	public function sq1_custom_login_settings_page_callback() {
		
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	 
		 // add error/update messages
		 
		 // check if the user have submitted the settings
		 // wordpress will add the "settings-updated" $_GET parameter to the url
		 if ( isset( $_GET['settings-updated'] ) ) {
			 // add settings saved message with the class of "updated"
			 add_settings_error( 'sq1_custom_login_messages', 'sq1_custom_login_message', __( 'Settings Saved', 'sq1_custom_login' ), 'updated' );
		 }
		 
		 // show error/update messages
		 settings_errors( 'sq1_custom_login_messages' );
		 
		 
		 
		
	    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
	        echo '<h2>Custom Login</h2>';
	        
	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
	endif;

	wp_enqueue_media();

	?><form method='post'>
		<div class='image-preview-wrapper'>
			<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100'>
		</div>
		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
		<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
		<input type="submit" name="submit_image_selector" value="Save" class="button-primary">
	</form><?php
	        
	        
/*
	        echo '<form action="options.php" method="post" enctype="multipart/form-data">';
				 // output security fields for the registered setting "wporg"
				 settings_fields( 'sq1_custom_login' );
				 // output setting sections and their fields
				 // (sections are registered for "wporg", each field is registered to a specific section)
				 do_settings_sections( 'sq1_custom_login' );
				 // output save settings button
				 submit_button( 'Save Settings' );
				 
			echo '</form>';
*/

	    echo '</div>';
	    

	}
	
	
	/**
	 * custom option and settings
	 */
	public function sq1_custom_login_settings_init() {
		// register a new setting for "wporg" page
		register_setting( 'sq1_custom_login', 'sq1_custom_login_options' );
		
		// register a new section in the "wporg" page
		add_settings_section(
			'sq1_custom_login_section_developers',
			__( 'Settings.', 'sq1_custom_login' ),
			array($this, 'sq1_custom_login_section_developers_cb'),
			'sq1_custom_login'
		);
		
/*
		// register a new field in the "sq1_custom_login_section_developers" section, inside the "wporg" page
		add_settings_field(
			'sq1_custom_login_field_pill', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Pill', 'sq1_custom_login' ),
			array($this, 'sq1_custom_login_field_pill_cb'),
			'sq1_custom_login',
			'sq1_custom_login_section_developers',
				[
				'label_for' => 'sq1_custom_login_field_pill',
				'class' => 'sq1_custom_login_row',
				'sq1_custom_login_custom_data' => 'custom',
				]
		);
*/
		
		register_setting( 'sq1_custom_login', 'sq1_custom_login_image', array($this, 'sq1_custom_login_upload') );
		
		add_settings_field( 'sq1_custom_login_image', __( 'Image', 'sq1_custom_login' ), array($this, 'sq1_custom_login_field_image'), 'sq1_custom_login', 'sq1_custom_login_section_developers', ['label_for' => 'sq1_custom_login_image']);
	}

	/**
	 * custom option and settings:
	 * callback functions
	 */
	 
	// developers section cb
	 
	// section callbacks can accept an $args parameter, which is an array.
	// $args have the following keys defined: title, id, callback.
	// the values are defined at the add_settings_section() function.
	public function sq1_custom_login_section_developers_cb( $args ) {
		$options = get_option( 'sq1_custom_login_options' );
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Update or change these settings, useful instructions etc.', 'sq1_custom_login' ); ?></p>
		<?php
	}
 
/*
	// pill field cb
	 
	// field callbacks can accept an $args parameter, which is an array.
	// $args is defined at the add_settings_field() function.
	// wordpress has magic interaction with the following keys: label_for, class.
	// the "label_for" key value is used for the "for" attribute of the <label>.
	// the "class" key value is used for the "class" attribute of the <tr> containing the field.
	// you can add custom key value pairs to be used inside your callbacks.
	public function sq1_custom_login_field_pill_cb( $args ) {
		// get the value of the setting we've registered with register_setting()
		$options = get_option( 'sq1_custom_login_options' );
		// output the field
		?>
		<select id="<?php echo esc_attr( $args['label_for'] ); ?>"
		data-custom="<?php echo esc_attr( $args['sq1_custom_login_custom_data'] ); ?>"
		name="sq1_custom_login_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
		>
			<option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
				<?php esc_html_e( 'red pill', 'sq1_custom_login' ); ?>
			</option>
			<option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
				<?php esc_html_e( 'blue pill', 'sq1_custom_login' ); ?>
			</option>
		</select>
		<p class="description">
			<?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'sq1_custom_login' ); ?>
		</p>
		<p class="description">
			<?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'sq1_custom_login' ); ?>
		</p>
	<?php
	}
	
*/
	public function sq1_custom_login_field_image($args) {
		$options = get_option( 'sq1_custom_login_options' );
		if (!empty($options['sq1_custom_login_image'])) {
			$image = '<img src="'.$options['sq1_custom_login_image'].'"/><br>';
		}
		echo $image;
		?>
		    <input type="file" name="sq1_custom_login_options[<?php echo esc_attr( $args['label_for'] ); ?>]" /> 
		    <?php //echo get_option('sq1_custom_login_image'); ?>
		<?php
	}

	public function sq1_custom_login_upload($option) {	
		$options = get_option( 'sq1_custom_login_options' );
			
		if(!empty($_FILES['sq1_custom_login_options'])) {
			if ( ! function_exists( 'wp_handle_upload' ) ) {
			    require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}
	
			$file = $_FILES['sq1_custom_login_options'];
	        $uploadedfile = array(
	            'name'     => $file['name']['sq1_custom_login_image'],
	            'type'     => $file['type']['sq1_custom_login_image'],
	            'tmp_name' => $file['tmp_name']['sq1_custom_login_image'],
	            'error'    => $file['error']['sq1_custom_login_image'],
	            'size'     => $file['size']['sq1_custom_login_image']
	        );
			
			$overrides = array('test_form' => false);
			
			$movefile = wp_handle_upload($uploadedfile,$overrides);
			
			$options['sq1_custom_login_image'] = $movefile['url'];
			
			update_option( 'sq1_custom_login_options', $options );
			
			return $movefile;   
		}
		
		return $option;
	}


}
