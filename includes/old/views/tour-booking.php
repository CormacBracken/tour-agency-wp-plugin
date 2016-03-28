<?php

global $post;
$output = ""; 

	/* Pattern:

	if this TourCMS data exists,
		* write some opening css classes
		* add the label (wrapped in a translation function)
		* add a closing css span
		* add the data
		* add a closing css div 

	*/

	if ( get_post_meta( $post->ID, 'tourcms_wp_available', true ) ) {
		$output .= '<div class="tour-agency tour-agency-availability"><span class="tour-agency-availability-label">';
		$output .= __( 'Availability', 'tour-booking' );
		$output .= '</span>';
		$output .= get_post_meta( $post->ID, 'tourcms_wp_available', true );
		$output .= '</div>';
	} 

	if ( get_post_meta( $post->ID, 'tourcms_wp_from_price_display', true )) {
		$output .= '<div class="tour-agency tour-agency-from-price-display"><span class="tour-agency-from-price-display-label">';
		$output .= __( 'From', 'tour-booking' );
		$output .= '</span>';
		$output .= get_post_meta( $post->ID, 'tourcms_wp_from_price_display', true );
		$output .= '</div>';
		} 

	if ( get_post_meta( $post->ID, 'tourcms_wp_document_desc_0', true ) ) {
		$output .= '<div class="tour-agency tour-agency-document_desc_0"><span class="tour-agency-document_desc_0-label">';
		$output .= __( 'Download Documents', 'tour-booking' );
		$output .= '</span>';
		$output .= get_post_meta( $post->ID, 'tourcms_wp_document_desc_0', true );
		$output .= '</div>';
		}


echo $output;