<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://redhotlemon.com
 * @since      1.0.0
 *
 * @package    Tour_Agency
 * @subpackage Tour_Agency/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tour_Agency
 * @subpackage Tour_Agency/includes
 * @author     Cormac Bracken <cormac@redhotlemon.com>
 */
class Tour_Agency {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tour_Agency_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'tour-agency';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_widget_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tour_Agency_Loader. Orchestrates the hooks of the plugin.
	 * - Tour_Agency_i18n. Defines internationalization functionality.
	 * - Tour_Agency_Admin. Defines all hooks for the admin area.
	 * - Tour_Agency_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-tour-agency-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-tour-agency-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'admin/class-tour-agency-admin.php';

		/**
		 * The class responsible for initialising CMB2 custom metaboxes.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'shared/cmb2/init.php';

		/**
		 * The class responsible for initialising CMB2 multimap type (custom made)
		 */
		require_once plugin_dir_path( __DIR__ ) . 'shared/cmb2/cmb-field-multimap.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'public/class-tour-agency-public.php';

		/**
		 * The class responsible for defining all actions that occur in widgets.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'shared/class-tour-agency-widget.php';

		$this->loader = new Tour_Agency_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tour_Agency_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Tour_Agency_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tour_Agency_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_admin, 'register_cpt_tour' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_tax_tour_category' );
		$this->loader->add_action( 'cmb2_admin_init', $plugin_admin, 'create_tour_desc_metabox' );
		$this->loader->add_action( 'cmb2_admin_init', $plugin_admin, 'create_tour_details_metabox' );
		//$this->loader->add_filter( 'cmb2_cb_multimap_attributes', $plugin_admin, 'dostuff');


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Tour_Agency_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tour_Agency_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}


	/**
	 * Register all of the hooks shared between public-facing and admin functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_widget_hooks() {
		$this->loader->add_action( 'widgets_init', $this, 'widgets_init' );
		/*$this->loader->add_action( 'save_post_job', $this, 'flush_widget_cache' );
		$this->loader->add_action( 'deleted_post', $this, 'flush_widget_cache' );
		$this->loader->add_action( 'switch_theme', $this, 'flush_widget_cache' );*/
	}

	/**
	 * Initialize this plugin's widgets.
	 *
	 * @since    1.0.0
	 */
	public function widgets_init() {
		register_widget( 'my_widget' );
	}


	/**
	 * Flushes widget cache
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @param 		int 		$post_id 		The post ID
	 * @return 		void
	 */
	public function flush_widget_cache ( $post_id ) {
		if ( wp_is_post_revision ( $post_id ) ) { return; }

		$post = get_post_id( $post_id );

		if ( $post->post_type == 'MYTHING' ) {
			wp_cache_delete( $this->i18n, 'widget' );
		}

	}


}
