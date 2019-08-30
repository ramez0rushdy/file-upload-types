<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Main File_Upload_Types Class.
 *
 * @since  1.0.0
 *
 * @class   File_Upload_Types
 */
final class File_Upload_Types {

	/**
	 * File Upload Types version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @var object File_Upload_Types
	 */
	protected static $_instance = null;

	/**
	 * Main File_Upload_Types Instance.
	 *
	 * @return File_Upload_Types Main Instance.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * File_Upload_Types Constructor.
	 */
	public function __construct() {

		// Load plugin text domain.
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_filter( 'plugin_action_links_'. plugin_basename( FILE_UPLOAD_TYPES_PLUGIN_FILE ), array( $this, 'plugin_action_links' ) );

		$this->define_constants();
		$this->includes();
	}

	/**
	 * Load Localisation files.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'file-upload-types', false, plugin_basename( dirname( FILE_UPLOAD_TYPES_PLUGIN_FILE ) ) . '/languages' );
	}

	/**
	 * Add plugin settings page link.
	 *
	 * @param  array $actions Plugin Action links.
	 *
	 * @return array
	 */
	public function plugin_action_links( $actions ) {
		$new_actions = array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=file-upload-types' ) . '" aria-label="' . esc_attr__( 'File Upload Types Settings', 'file-upload-types' ) . '">' . esc_html__( 'Settings', 'file-upload-types' ) . '</a>',
		);

		return array_merge( $new_actions, $actions );
	}

	/**
	 * Define Constants.
	 */
	private function define_constants() {
		$this->define( 'FUT_ABSPATH', dirname( FILE_UPLOAD_TYPES_PLUGIN_FILE ) . '/' );
		$this->define( 'FUT_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name
	 * @param string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Includes.
	 */
	private function includes() {
		if ( is_admin() ) {
			include_once dirname( __FILE__ ) . '/class-file-upload-types-settings.php';
			include_once dirname( __FILE__ ) . '/file-upload-types-functions.php';
		}
	}
}
