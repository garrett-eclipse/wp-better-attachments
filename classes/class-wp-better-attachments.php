<?php
/**
* WP Better Attachments Base Class
*/

/**
 * This class should be extended by every other WPBA class.
 * All of the setup logic should be contained here.
 *
 * @version      1.4.0
 *
 * @package      WordPress
 * @subpackage   WPBA
 *
 * @since        1.4.0
 *
 * @author       Dan Holloran          <dholloran@matchboxdesigngroup.com>
 *
 * @copyright    2013 - Present         Dan Holloran
 */
if ( ! class_exists( 'WP_Better_Attachments' ) ) {
	class WP_Better_Attachments {
		/**
		 * WP_Better_Attachments class constructor.
		 *
		 * @since  1.4.0
		 *
		 * @todo   Only add on required pages.
		 *
		 * @param  array  $config  Class configuration.
		 */
		public function __construct( $config = array() ) {
			add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_public_assets' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_assets' ) );
		} // __construct()



		/**
		 * Adds global public JS.
		 *
		 * @since  1.4.0
		 *
		 * @todo   Only add on required pages.
		 *
		 * @return void
		 */
		public function add_global_public_js() {
			// Add Global PHP -> JS
			$mdg_globals = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'isIE'    => ( $ltie9 and $is_IE ),
			);
			$mdg_globals = json_encode( $mdg_globals ); ?>
			<script>var WPBA_PUBLIC_JS = <?php echo wp_kses( $mdg_globals, 'data' ); ?>;</script>
			<?php
		} // add_global_public_js()



		/**
		 * Adds global wp-admin JS.
		 *
		 * @since  1.4.0
		 *
		 * @todo   Only add on required pages.
		 *
		 * @return void
		 */
		public function add_global_admin_js() {
			// Add Global PHP -> JS
			$mdg_globals = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'isIE'    => ( $ltie9 and $is_IE ),
			);
			$mdg_globals = json_encode( $mdg_globals ); ?>
			<script>var WPBA_ADMIN_JS = <?php echo wp_kses( $mdg_globals, 'data' ); ?>;</script>
			<?php
		} // add_global_admin_js()



		/**
		 * Enqueues scripts and styles for use on the public front end.
		 *
		 * <code>add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_public_assets' ) );</code>
		 *
		 * @since  1.4.0
		 *
		 * @todo   Only add on required pages.
		 *
		 * @return  void
		 */
		public function enqueue_public_assets() {
			wp_enqueue_style( 'wpba_public_css', WPBA_URL . '/assets/css/dist/wpba.da39.min.css', array(), null, 'all' );
			wp_register_script( 'wpba_public_js', WPBA_URL . '/assets/js/dist/wpba.min.js', array(), null, true );
			wp_enqueue_script( 'wpba_public_js' );
		} // enqueue_public_assets()



		/**
		 * Enqueues scripts and styles for use in wp-admin.
		 *
		 * <code>add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_assets' ) );</code>
		 *
		 * @since  1.4.0
		 *
		 * @return  void
		 */
		public function enqueue_admin_assets() {
			wp_enqueue_style( 'wpba_admin_css', WPBA_URL . '/assets/css/dist/wpba-admin.170e.min.css', array(), null, 'all' );
			wp_register_script( 'wpba_admin_js', WPBA_URL . '/assets/js/dist/wpba-admin.bd67.min.js', array(), null, true );
			wp_enqueue_script( 'wpba_admin_js' );
		} // enqueue_admin_assets()
	} // WP_Better_Attachments()

	// Instantiate Class
	global $wp_better_attachments;
	$wp_better_attachments = new WP_Better_Attachments();
} // if()