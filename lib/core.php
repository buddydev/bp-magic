<?php

/**
 * Pagination
 * Credit @Smashing Mag http://wp.smashingmagazine.com/2011/05/10/new-wordpress-power-tips-for-template-developers-and-consultants/
 * @todo deprecate it, use the new wordpress pagination function added in 4.1
 */
function bpmagic_paginate() {
	/// get total number of pages
	global $wp_query;
	
	$total = $wp_query->max_num_pages;
	// only bother with the rest if we have more than 1 page!
	if ( $total > 1 ) {
		// get the current page
		if ( ! $current_page = get_query_var( 'paged' ) ) {
			$current_page = 1;
		}
		// structure of “format” depends on whether we’re using pretty permalinks
		$perma_struct = get_option( 'permalink_structure' );
		$format = empty( $perma_struct ) ? '&page=%#%' : 'page/%#%/';
		//for search page, default back to the numerical pagination
		if ( is_search() ) {
			$format = '&page=%#%'; //always default paged pagination for search page
		}
		
		echo paginate_links( array(
			'base'		=> get_pagenum_link( 1 ) . '%_%',
			'format'	=> $format,
			'current'	=> $current_page,
			'total'		=> $total,
			'mid_size'	=> 4,
			'type'		=> 'list'
		) );
	}
}

/**
 * A slightly modified version of Jason's time diff function
 * get the time diff as human readable
 * @param type $from integer timestamp
 * @param type $to integer timestamp
 * @return type 
 *
 * @url <http://www.jasonbobich.com/wordpress/a-better-way-to-add-time-ago-to-your-wordpress-theme/>
 */
function bpmagic_time_diff( $from, $to ) {

	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365, __( 'year', 'bp-magic' ), __( 'years', 'bp-magic' ) ),
		array( 60 * 60 * 24 * 30, __( 'month', 'bp-magic' ), __( 'months', 'bp-magic' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'bp-magic' ), __( 'weeks', 'bp-magic' ) ),
		array( 60 * 60 * 24, __( 'day', 'bp-magic' ), __( 'days', 'bp-magic' ) ),
		array( 60 * 60, __( 'hour', 'bp-magic' ), __( 'hours', 'bp-magic' ) ),
		array( 60, __( 'minute', 'bp-magic' ), __( 'minutes', 'bp-magic' ) ),
		array( 1, __( 'second', 'bp-magic' ), __( 'seconds', 'bp-magic' ) )
	);
	
	$current_time = $to;
	$newer_date = $to; // strtotime( $current_time );
	// Difference in seconds
	$since = $newer_date - $from;

	// Something went wrong with date calculation and we ended up with a negative date.
	if ( 0 > $since ) {
		return __( 'sometime', 'bp-magic' );
	}
	
	/**
	 * We only want to output one chunks of time here, eg:
	 * x years
	 * xx months
	 * so there's only one bit of calculation below:
	 */
	//Step one: the first chunk
	for ( $i = 0, $j = count( $chunks ); $i < $j; $i ++ ) {
		$seconds = $chunks[$i][0];

		// Finding the biggest chunk (if the chunk fits, break)
		if ( ( $count = floor( $since / $seconds ) ) != 0 ) {
			break;
		}
	}

	// Set output var
	$output = ( 1 == $count ) ? '1 ' . $chunks[$i][1] : $count . ' ' . $chunks[$i][2];


	if ( ! (int) trim( $output ) ) {
		$output = '0 ' . __( 'seconds', 'bp-magic' );
	}

	$output .= __( ' ago', 'bp-magic' );

	return $output;
}

/**
 * A copy of get_the_category_list to make it validate
 * 
 * The only change is the rel attribute
 * @global type $wp_rewrite
 * @param type $separator
 * @param type $parents
 * @param type $post_id
 * @return type 
 */
function bpmagic_get_the_category_list( $separator = '', $parents = '', $post_id = false ) {
	
	global $wp_rewrite;
	
	if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
		return apply_filters( 'the_category', '', $separator, $parents );
	}

	$categories = get_the_category( $post_id );
	
	if ( empty( $categories ) ) {
		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );
	}
	
	$rel = 'rel="tag"';

	$thelist = '';
	
	if ( '' == $separator ) {
		
		$thelist .= '<ul class="post-categories">';
		
		foreach ( $categories as $category ) {
			$thelist .= "\n\t<li>";
		
			switch ( strtolower( $parents ) ) {
			
				case 'multiple':
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, true, $separator );
					}
					
					$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name . '</a></li>';
					break;
				
					
				case 'single':
					$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, false, $separator );
					}
					
					$thelist .= $category->name . '</a></li>';
					break;
					
				case '':
				default:
					$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name . '</a></li>';
			}
		}
		
		$thelist .= '</ul>';
		
	} else {
		
		$i = 0;
		
		foreach ( $categories as $category ) {
			if ( 0 < $i ) {
				$thelist .= $separator;
			}
			
			switch ( strtolower( $parents ) ) {
				
				case 'multiple':
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, true, $separator );
					}
					
					$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name . '</a>';
					break;
				
				case 'single':
				
					$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					
					if ( $category->parent ) {
						$thelist .= get_category_parents( $category->parent, false, $separator );
					}
					
					$thelist .= "$category->name</a>";
					break;
				
				case '':
				default:
					$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name . '</a>';
			}
			
			++ $i;
		}
	}
	
	return apply_filters( 'the_category', $thelist, $separator, $parents );
}

function bpmagic_the_category( $separator = '', $parents = '', $post_id = false ) {
	echo bpmagic_get_the_category_list( $separator, $parents, $post_id );
}

/**
 * Whether the theme has slideshow or not?
 * 
 * We use it to add a class to body element on home page because we will be moving the sidebar to allow the extra space for slideshow
 * 
 * @return bool true if the theme has slideshow 
 */
function bpmagic_has_slideshow() {

	$has_slideshow = false;

	if ( function_exists( 'show_skitter' ) ) {
		$has_slideshow = true;
	}

	return apply_filters( 'bpmagic_has_slideshow', $has_slideshow );
}
