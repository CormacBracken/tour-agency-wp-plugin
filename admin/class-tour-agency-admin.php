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

	}


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

	
	/**
	 * Hook in and add a metabox 
	 */

	// Custom tour descriptions metabox
	public function create_tour_desc_metabox() {
		$prefix = 'tour_desc_';

		/**
		 * Metabox to be displayed on Tour editor page
		 */
		$cmb_tour_cpt = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Tour Descriptions', 'tour-agency-admin' ),
			'object_types' => array( 'tour', ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true // Show field names on the left
		) );

		// Summary text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Tour summary', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'summary',
			'type' => 'text'
		) );

		// Short description - no field, use main content
		// Long description wysiwyg field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Tour long description', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'long',
			'type' => 'wysiwyg',
			'options' => array( 'textarea_rows' => 10, )
		) );

		// Highlights text area field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Tour highlights', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'highlights',
			'type' => 'textarea_small'
		) );

		// Itinerary repeater text, text area fields
		$group_field_id = $cmb_tour_cpt->add_field( array(
			'id'          => $prefix . 'itinerary_repeater',
			'type'        => 'group',
			'description' => __( 'Generates reusable form entries', 'tour-agency-admin' ),
			'options'     => array(
				'group_title'   => __( 'Entry {#}', 'tour-agency-admin' ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Another Entry', 'tour-agency-admin' ),
				'remove_button' => __( 'Remove Entry', 'tour-agency-admin' ),
				'sortable'      => true
			),
		) );

		$cmb_tour_cpt->add_group_field( $group_field_id, array(
			'name' => 'Itinerary Title',
			'id'   => 'title',
			'type' => 'text',
		) );

		$cmb_tour_cpt->add_group_field( $group_field_id, array(
			'name' => 'Itinerary Description',
			'id'   => 'description',
			'type' => 'textarea',
		) );
		
		// Locations repeater
		$cmb_tour_cpt->add_field( array(
			'name' => 'Locations Map',
			'desc' => 'Drag the marker to set the exact location',
			'id' => $prefix . 'locations_map',
			'type' => 'cb_multimap',
			'repeatable' => true,
			'before_row'   => '<div class="cmb-type-cb-multimap"><div class="cb-multimap"></div><!-- CODE IN CTA ADMIN -->',
			'after_row' => '</div><!-- CLOSE BEFORE/AFTER IN CTA ADMIN -->',
			'split_values' => true, // Save latitude and longitude as two separate fields
		) );

		// Essential info repeater text field
		$cmb_tour_cpt->add_field( array(
			'name' => 'Essential Info',
			'id'   => 'essential_info',
			'type' => 'text',
			'repeatable' => true
		) );

		// Included repeater text field
		$cmb_tour_cpt->add_field( array(
			'name' => 'Included',
			'id'   => 'included_repeater',
			'type' => 'text',
			'repeatable' => true
		) );

		// Excluded repeater text field
		$cmb_tour_cpt->add_field( array(
			'name' => 'Excluded',
			'id'   => 'excluded_repeater',
			'type' => 'text',
			'repeatable' => true
		) );

		// Optional extras repeater text field
		$cmb_tour_cpt->add_field( array(
			'name' => 'Optional extras',
			'id'   => 'optional_repeater',
			'type' => 'text',
			'repeatable' => true
		) );		

		// Restrictions  repeater text field
		$cmb_tour_cpt->add_field( array(
			'name' => 'Restrictions',
			'id'   => 'restrictions_repeater',
			'type' => 'text',
			'repeatable' => true
		) );		

	}

	// Custom tour details metabox
	public function create_tour_details_metabox() {

		$prefix = 'tour_details_';

		/**
		 * Metabox to be displayed on Tour editor page
		 */
		$cmb_tour_cpt = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Tour Details', 'tour-agency-admin' ),
			'object_types' => array( 'tour' ),
			'context'      => 'side',
			'priority'     => 'high',
			'show_names'   => true
		) );

		// From price text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'From Price', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'from_price',
			'type' => 'text'
		) );

		// Duration text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Duration', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'duration',
			'type' => 'text'
		) );

		// Availability text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Availability', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'availability',
			'type' => 'text'
		) );

		// Primary location text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Primary location', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'primary_location',
			'type' => 'text'
		) );

		// Meals text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Meals', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'meals',
			'type' => 'text'
		) );

		// Hotel pickup text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Hotel pickup', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'hotel_pickup',
			'type' => 'text'
		) );

		// Booking t&c text field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Booking Terms & Conditions', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'booking_tc',
			'type' => 'text'
		) );

		// Brochure file field
		$cmb_tour_cpt->add_field( array(
			'name' => __( 'Brochure', 'tour-agency-admin' ),
			'desc' => __( 'field description (optional)', 'tour-agency-admin' ),
			'id'   => $prefix . 'brochure',
			'type' => 'file'
		) );

	}	

}
