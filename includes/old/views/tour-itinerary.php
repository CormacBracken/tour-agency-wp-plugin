<?php

global $post;

	echo "<h2>Tour itinerary</h2>";

	if ( get_post_meta( $post->ID, 'tourcms_wp_itinerary', true ) ) {
		echo get_post_meta( $post->ID, 'tourcms_wp_itinerary', true );
	} else {
		echo "Missing itinerary";
	}
