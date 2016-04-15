<?php
/*
Plugin Name: CMB2 Field Type: Google Multiple Location Maps
Plugin URI: 
GitHub Plugin URI: 
Description: Google Maps field type for CMB2.
Version: 1.0.0
Author: Cormac Bracken
Author URI: https://redohtlemon.com/
License: GPLv2+
*/

/**
 * Class CB_CMB2_Field_Google_Multi_Maps
 */
class CB_CMB2_Field_Google_Multi_Maps {

	/**
	 * Current version number
	 */
	const VERSION = '1.0.0';

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public function __construct() {
		add_filter( 'cmb2_render_cb_multimap', array( $this, 'render_cb_multimap' ), 10, 5 );
		add_filter( 'cmb2_sanitize_cb_multimap', array( $this, 'sanitize_cb_multimap' ), 10, 4 );
	}

	/**
	 * Render field
	 */
	public function render_cb_multimap( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		$this->setup_admin_scripts();

		echo $field_type_object->input( array (
			'name'		=>	$field->args( '_name' ) . '_' . $field_type_object->iterator,
			'type'		=>	'text',
			'class'		=>	'large-text cb-multimap-search',
		) );

//		echo '<input type="text" class="large-text cb-multimap-search" id="' . $field->args( 'id' ) . '" />'; //old code

		$field_type_object->_desc( true, true, true );

		echo $field_type_object->input( array(
			//'type'       => 'hidden',
			'name'		=> $field->args('_name') . '_' . $field_type_object->iterator . '[latitude]',
			'id'		=> $field->args('_id') . '_' . $field_type_object->iterator . '[latitude]',
			'value'      => isset( $field_escaped_value['latitude'] ) ? $field_escaped_value['latitude'] : '',
			'class'      => 'cb-multimap-latitude',
			'desc'       => '',
		) );
		echo $field_type_object->input( array(
			//'type'       => 'hidden',
			'name'       => $field->args('_name') . '_' . $field_type_object->iterator . '[longitude]',
			'id'		=> $field->args('_id') . '_' . $field_type_object->iterator . '[longitude]',
			'value'      => isset( $field_escaped_value['longitude'] ) ? $field_escaped_value['longitude'] : '',
			'class'      => 'cb-multimap-longitude',
			'desc'       => '',
		) );

		echo '<pre>Iterator:';
		print_r($field_type_object->iterator);
		echo '<pre>';

	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields
	 */
	public function sanitize_cb_multimap( $override_value, $value, $object_id, $field_args ) {
		if ( isset( $field_args['split_values'] ) && $field_args['split_values'] ) {
			if ( ! empty( $value['latitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_latitude', $value['latitude'] );
			}

			if ( ! empty( $value['longitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_longitude', $value['longitude'] );
			}
		}

		return $value;
	}

	/**
	 * Enqueue scripts and styles
	 */
	public function setup_admin_scripts() {
		wp_register_script( 'pw-google-maps-api', '//maps.googleapis.com/maps/api/js?libraries=places', null, null );
		wp_enqueue_script( 'pw-google-maps', plugins_url( 'js/script.js', __FILE__ ), array( 'pw-google-maps-api' ), self::VERSION );
		wp_enqueue_style( 'pw-google-maps', plugins_url( 'css/style.css', __FILE__ ), array(), self::VERSION );
	}

}
$cb_cmb2_field_google_multimaps = new CB_CMB2_Field_Google_Multi_Maps();
