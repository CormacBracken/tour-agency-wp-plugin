<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://redhotlemon.com
 * @since      1.0.0
 *
 * @package    Tour_Agency
 * @subpackage Tour_Agency/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tour_Agency
 * @subpackage Tour_Agency/admin
 * @author     Cormac Bracken <cormac@redhotlemon.com>
 */
class Tour_Agency_Admin {

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
		 * defined in Tour_Agency_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tour_Agency_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tour-agency-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'at-meta-box', plugin_dir_url( __FILE__ ) . 'css/meta-box.css', array(), $this->version, 'all' );
		wp_enqueue_style('at-multiselect-select2-css', plugin_dir_url( __FILE__ ) . 'css/select2/select2.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Tour_Agency_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tour_Agency_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tour-agency-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'at-meta-box', plugin_dir_url( __FILE__ ) . 'js/meta-box.js', array( 'jquery' ), $this->version, false );
    	wp_enqueue_script('at-multiselect-select2-js', plugin_dir_url( __FILE__ ) . 'js/select2/select2.js', array('jquery'), $this->version, false);

	}

/*	public function new_cpt() {

	$name = 'blah';
	$opts['x'] = 3;
	
	register_post_type () ;

	}*/

	public function register_cpt_tour() {

		$labels = array(
			'name' => __( 'Tours', 'tour' ),
			'singular_name' => __( 'Tour', 'tour' ),
			'add_new' => __( 'Add New', 'tour' ),
			'add_new_item' => __( 'Add New Tour', 'tour' ),
			'edit_item' => __( 'Edit Tour', 'tour' ),
			'new_item' => __( 'New Tour', 'tour' ),
			'view_item' => __( 'View Tour', 'tour' ),
			'search_items' => __( 'Search Tours', 'tour' ),
			'not_found' => __( 'No tours found', 'tour' ),
			'not_found_in_trash' => __( 'No tours found in Trash', 'tour' ),
			'parent_item_colon' => __( 'Parent Tour:', 'tour' ),
			'menu_name' => __( 'Tours', 'tour' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Holds various details about tours.',
			'supports' => array( 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
			'taxonomies' => array( 'tour_categories', 'tour_tags' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => plugin_dir_url( __FILE__ ) . "images/tour-icon.png",
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post'
		);

		register_post_type( 'tour', $args );
	}


	// Register Custom Taxonomy
	public function register_tax_tour_category() {

		$labels = array(
			'name'                       => _x( 'Tour Categories', 'Taxonomy General Name', 'tour-category' ),
			'singular_name'              => _x( 'Tour Category', 'Taxonomy Singular Name', 'tour-category' ),
			'menu_name'                  => __( 'Tour Category', 'tour-category' ),
			'all_items'                  => __( 'All Tour Categories', 'tour-category' ),
			'parent_item'                => __( 'Parent Item', 'tour-category' ),
			'parent_item_colon'          => __( 'Parent Item:', 'tour-category' ),
			'new_item_name'              => __( 'New tour category', 'tour-category' ),
			'add_new_item'               => __( 'Add New Tour Category', 'tour-category' ),
			'edit_item'                  => __( 'Edit Tour Category', 'tour-category' ),
			'update_item'                => __( 'Update Tour Category', 'tour-category' ),
			'view_item'                  => __( 'View Tour Category', 'tour-category' ),
			'separate_items_with_commas' => __( 'Separate tour categories with commas', 'tour-category' ),
			'add_or_remove_items'        => __( 'Add or remove tour categories', 'tour-category' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'tour-category' ),
			'popular_items'              => __( 'Popular Tour Categories', 'tour-category' ),
			'search_items'               => __( 'Search Tour Categories', 'tour-category' ),
			'not_found'                  => __( 'Not Found', 'tour-category' ),
			'no_terms'                   => __( 'No tour categories', 'tour-category' ),
			'items_list'                 => __( 'Tour Categories list', 'tour-category' ),
			'items_list_navigation'      => __( 'Tour Categories list navigation', 'tour-category' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'tour-category', array( 'tour' ), $args );

	}

	// Custom tour descriptions metabox
	public function create_tour_desc_metabox() {

		$prefix = 'tour_desc_';
		$config = array(
			'id'             => 'tour_desc_metabox',
			'title'          => 'Tour Descriptions',
			'pages'          => array('tour'),
			'context'        => 'normal',     // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high',            // order of meta box: high (default), low; optional
			'fields'         => array(),            // list of meta fields (can be added by field arrays)
			'local_images'   => true,          // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => false
		);

		$tour_desc_meta =  new AT_Meta_Box($config);

		// Summary text field
		$tour_desc_meta->addText( $prefix . 'summary', array( 'name' => 'Tour summary', 'style' => 'width: 50em;' ) );
		// Short description - no field, use main content
		// Long description wysiwyg field
		$tour_desc_meta->addWysiwyg( $prefix . 'long', array( 'name' => 'Tour long description' ) );

		// Highlights text area field
		$tour_desc_meta->addTextarea( $prefix . 'highlights', array( 'name' => 'Tour highlights' ) );
		
		// Itinerary repeater text, text area fields
		$itinerary_repeater[] = $tour_desc_meta->addText( $prefix . 'itinerary_title', array( 'name' => 'Itinerary item title e.g. Day 1', 'style' => 'width: 12em;' ), true );
		$itinerary_repeater[] = $tour_desc_meta->addTextarea( $prefix . 'itinerary_desc', array( 'name'=> 'Itinerary item description', 'style' => 'width: 40em; height: 8em;' ), true );
		$tour_desc_meta->addRepeaterBlock($prefix.'it_',array(
			'inline'   => true, 
			'name'     => 'Itinerary',
			'fields'   => $itinerary_repeater, 
			'sortable' => true
		));

		// Locations repeater.... lat/long or map?

		// Essential info repeater text field
		$essential_repeater[] = $tour_desc_meta->addText( $prefix . 'essential', array( 'name' => 'Essential item', 'style' => 'width: 50em;' ), true );
		$tour_desc_meta->addRepeaterBlock($prefix.'ess_',array(
			'inline'   => false, 
			'name'     => 'Essential info',
			'fields'   => $essential_repeater, 
			'sortable' => true
		));	

		// Included repeater text field
		$included_repeater[] = $tour_desc_meta->addText( $prefix . 'included', array( 'name' => 'Included item', 'style' => 'width: 50em;' ), true );
		$tour_desc_meta->addRepeaterBlock($prefix.'inc_',array(
			'inline'   => false, 
			'name'     => 'Included in tour price',
			'fields'   => $included_repeater, 
			'sortable' => true
		));	
		// Excluded repeater text field
		$excluded_repeater[] = $tour_desc_meta->addText( $prefix . 'excluded', array( 'name' => 'Excluded item', 'style' => 'width: 50em;' ), true );
		$tour_desc_meta->addRepeaterBlock($prefix.'exc_',array(
			'inline'   => false, 
			'name'     => 'Excluded from tour price',
			'fields'   => $excluded_repeater, 
			'sortable' => true
		));	

		// Optional extras repeater text field
		$optional_repeater[] = $tour_desc_meta->addText( $prefix . 'optional', array( 'name' => 'Optional item', 'style' => 'width: 50em;' ), true );
		$tour_desc_meta->addRepeaterBlock($prefix.'opt_',array(
			'inline'   => false, 
			'name'     => 'Optional extras',
			'fields'   => $optional_repeater, 
			'sortable' => true
		));	

		// Restrictions  repeater text field
		$restrictions_repeater[] = $tour_desc_meta->addText( $prefix . 'optional', array( 'name' => 'Restriction', 'style' => 'width: 50em;' ), true );
		$tour_desc_meta->addRepeaterBlock($prefix.'res_',array(
			'inline'   => false, 
			'name'     => 'Restrictions',
			'fields'   => $restrictions_repeater, 
			'sortable' => true
		));			

		//Finish Meta Box Declaration 
		$tour_desc_meta->Finish();

	}

	// Custom tour details metabox
	public function create_tour_details_metabox() {

		$prefix = 'tour_details_';
		$config = array(
			'id'             => 'tour_details_metabox',
			'title'          => 'Tour Details',
			'pages'          => array('tour'),
			'context'        => 'side',     // where the meta box appear: normal (default), advanced, side; optional
			'priority'       => 'high',            // order of meta box: high (default), low; optional
			'fields'         => array(),            // list of meta fields (can be added by field arrays)
			'local_images'   => true,          // Use local or hosted images (meta box images for add/remove)
			'use_with_theme' => false
		);

		$tour_details_meta =  new AT_Meta_Box($config);

		// From price text field
		$tour_details_meta->addText( $prefix . 'from_price', array( 'name' => 'From price', 'style' => 'width: 16em' ) );
		// Duration text field
		$tour_details_meta->addText( $prefix . 'duration', array( 'name' => 'Duration', 'style' => 'width: 16em' ) );
		// Availability text field
		$tour_details_meta->addText( $prefix . 'availability', array( 'name' => 'Availability', 'style' => 'width: 16em' ) );
		// Primary location text field
		$tour_details_meta->addText( $prefix . 'location', array( 'name' => 'Primary location', 'style' => 'width: 16em' ) );
		// Meals text field
		$tour_details_meta->addText( $prefix . 'meals', array( 'name' => 'Meals', 'style' => 'width: 16em' ) );
		// Hotel pickup text field
		$tour_details_meta->addText( $prefix . 'pickup', array( 'name' => 'Hotel pickup', 'style' => 'width: 16em' ) );
		// Booking t&c text field
		$tour_details_meta->addText( $prefix . 'tandc', array( 'name' => 'Terms & conditions', 'style' => 'width: 16em' ) );
		// Brochure file field
		$tour_details_meta->addFile( $prefix . 'location', array( 'name' => 'Brochure' ) );

		//Finish Meta Box Declaration 
		$tour_details_meta->Finish();

	}


}
