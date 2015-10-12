<?php

/**
 * Contains post enhancement functions for BP Magic Theme
 * @package bp-magic
 */

/**
 *
 * @global object $post
 * @return boolean true if comment is allowed elase flase 
 */
function bpmagic_allow_comments_on_page() {
	global $post;
	
	$allow_comments = 0;
	if ( 'open' == $post->comment_status || have_comments() ) {
		$allow_comments = 1;
	}
	
	return apply_filters( 'bpmagic_allow_comments_on_page', $allow_comments ); //true by default
}

/**
 * Whether to allow comments on posts or not
 * 
 * @global object $post
 * @return boolean 
 */
function bpmagic_allow_comments_on_posts() {
	global $post;
	$show = 0;
	
	if ( 'open' == $post->comment_status || have_comments() ) {
		$show = 1;
	}
	
	return apply_filters( 'bpmag_allow_comments_on_posts', $show ); //true by default
}

/**
 * Fix the length of excerpt
 * @param integer $length
 * @return integer 
 */
function bpmagic_custom_excerpt_length( $length ) {
//allow to customize
	return 40;
}

/**
 * Returns a "Continue Reading" link for excerpts
 *
 */
function bpmagic_continue_reading_link() {
	
	return ' <a class="continue-reading" href="' . get_permalink() . '" title= "' . the_title_attribute( array( 'echo' => false ) ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bp-magic' ) . '</a>';
}

function bpmagic_auto_excerpt_more( $more ) {
	return ' &hellip;' . bpmagic_continue_reading_link();
}

function bpmagic_custom_excerpt_more( $output ) {
	
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= bpmagic_continue_reading_link();
	}
	
	return $output;
}

// Thanks very much to Thin & Light (http://thinlight.org/) for this custom function!
function bpmagic_get_excerpt( $text, $excerpt_length = 25 ) {
	
	$text = str_replace( ']]>', ']]&gt;', $text );
	$text = strip_tags( $text );
	$text = preg_replace( "/\[.*?]/", "", $text );
	
	$words = explode( ' ', $text, $excerpt_length + 1 );
	
	if ( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		array_push( $words, '...' );
		$text = implode( ' ', $words );
	}

	return apply_filters( 'the_excerpt', $text );
}

function bpmagic_get_post_excerpt( $post, $length = 25 ) {

	$excerpt = ($post->post_excerpt == '') ? ( bpmagic_get_excerpt( $post->post_content, $length ) ) : ( apply_filters( 'the_excerpt', $post->post_excerpt ) );
	return $excerpt;
}


function bpmagic_previous_post_excerpt( $in_same_cat = false, $excluded_categories = '' ) {
	
	if ( is_attachment() ) {
		$post = get_post( $GLOBALS['post']->post_parent );
	} else {
		$post = get_previous_post( $in_same_cat, $excluded_categories );
	}
	
	if ( ! $post ) {
		return;
	}
	
	$post = get_post( $post->ID );
	
	echo bpmagic_get_post_excerpt( $post );
}

function bpmagic_next_post_excerpt( $in_same_cat = false, $excluded_categories = '' ) {
	
	$post = get_next_post( $in_same_cat, $excluded_categories );

	if ( ! $post ) {
		return;
	}
	$post = get_post( $post->ID );
	echo bpmagic_get_post_excerpt( $post );
}
