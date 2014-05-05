<?php

class Tour_Booking extends WP_Widget {

    protected $widget_slug = 'tour-booking';

    /*--------------------------------------------------*/
    /* Constructor
    /*--------------------------------------------------*/

    public function __construct() {

        // load plugin text domain
        add_action( 'init', array( $this, 'widget_textdomain' ) );

        // Hooks fired when the Widget is activated and deactivated
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        parent::__construct(
            $this->get_widget_slug(),
            __( 'Tour Booking', $this->get_widget_slug() ),
            array(
                'classname'  => $this->get_widget_slug().'-class',
                'description' => __( 'Displays booking info, e.g. price, availability, etc. for a single tour.', $this->get_widget_slug() )
            )
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

        // Register site styles and scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

        // Refreshing the widget's cached output with each new post
        add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
        add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
        add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

    } // end constructor


    public function get_widget_slug() {
        return $this->widget_slug;
    }

    /*--------------------------------------------------*/
    /* Widget API Functions
    /*--------------------------------------------------*/

    /**
     * Outputs the content of the widget.
     *
     * @param array args  The array of form elements
     * @param array instance The current instance of the widget
     */
    public function widget( $args, $instance ) {

        
        // Check if there is a cached output
        $cache = wp_cache_get( $this->get_widget_slug(), 'widget' );

        if ( !is_array( $cache ) )
            $cache = array();

        if ( ! isset ( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset ( $cache[ $args['widget_id'] ] ) )
            return print $cache[ $args['widget_id'] ];
        
        // go on with your widget logic, put everything into a string and …


        extract( $args, EXTR_SKIP );

        $widget_string = $before_widget;

        ob_start();
        include( plugin_dir_path( __FILE__ ) . 'views/tour-booking.php' );
        $widget_string .= ob_get_clean();
        $widget_string .= $after_widget;


        $cache[ $args['widget_id'] ] = $widget_string;

        wp_cache_set( $this->get_widget_slug(), $cache, 'widget' );

        print $widget_string;

    } // end widget
    
    
    public function flush_widget_cache() 
    {
        wp_cache_delete( $this->get_widget_slug(), 'widget' );
    }
    /**
     * Processes the widget's options to be saved.
     *
     * @param array new_instance The new instance of values to be generated via the update.
     * @param array old_instance The previous instance of values before the update.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        // TODO: Here is where you update your widget's old values with the new, incoming values

        return $instance;

    } // end widget

    /**
     * Generates the administration form for the widget.
     *
     * @param array instance The array of keys and values for the widget.
     */
    public function form( $instance ) {

        // TODO: Define default values for your variables
        $instance = wp_parse_args(
            (array) $instance
        );

        // TODO: Store the values of the widget in their own variable

        // Display the admin form
        include( plugin_dir_path(__FILE__) . 'views/admin.php' );

    } // end form

    /*--------------------------------------------------*/
    /* Public Functions
    /*--------------------------------------------------*/

    public function widget_textdomain() {

        load_plugin_textdomain( $this->get_widget_slug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );

    } // end widget_textdomain

} // end class
