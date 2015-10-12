<?php

/**
 * All hacks for BBPress Forum Plugin
 * this file is loaded if bbpress plugin is active
 */
/**
 * Remove the 'archive' class from body on forum/topic archive
 *  
 */
add_filter( 'body_class', 'bpmagic_strip_archive_class_on_forums', 20 );

function bpmagic_strip_archive_class_on_forums( $classes ) {

	if ( bbp_is_forum_archive() || bbp_is_topic_archive() ) {
		//search through the arrayand replace 
		$class_count = count( $classes );
		
		for ( $i = 0; $i < $class_count; $i ++  ) {
			if ( $classes[$i] == 'archive' ) {
				unset( $classes[$i] );
			}
		}
	}

	return $classes;
}
