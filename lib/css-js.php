<?php

class BPMagic_Asset_Helper {

	private static $instance;

	private function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'load_js' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_css' ) );
		//load google font
		add_action( 'wp_head', array( $this, 'load_google_font' ) );
	}

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}

	/**
	 * Include Javascript
	 */
	public function load_js() {
		$template_uri = get_template_directory_uri();
		
		//yu read it right, bp-default theme js
		wp_enqueue_script( 'dtheme-uniform-js',  $template_uri . '/_inc/js/jquery.uniform.min.js', array( 'jquery' ), bp_get_version() );
		wp_enqueue_script( 'enhance-js', $template_uri . '/_inc/js/enhance.js', array( 'jquery', 'dtheme-uniform-js' ), bp_get_version() );

		// Enqueue the global JS - Ajax will not work without it
		wp_enqueue_script( 'dtheme-ajax-js', $template_uri . '/_inc/js/global.js', array( 'jquery' ), bp_get_version() );
		// Add words that we need to use in JS to the end of the page so they can be translated and still used.
		
		$params = array(
			'my_favs'			=> __( 'My Favorites', 'bp-magic' ),
			'accepted'			=> __( 'Accepted', 'bp-magic' ),
			'rejected'			=> __( 'Rejected', 'bp-magic' ),
			'show_all_comments' => __( 'Show all comments for this thread', 'bp-magic' ),
			'show_all'			=> __( 'Show all', 'bp-magic' ),
			'comments'			=> __( 'comments', 'bp-magic' ),
			'close'				=> __( 'Close', 'bp-magic' ),
			'view'				=> __( 'View', 'bp-magic' ),
			'mark_as_fav'		=> __( 'Favorite', 'bp-magic' ),
			'remove_fav'		=> __( 'Remove Favorite', 'bp-magic' )
		);
		
		wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );


		// Maybe enqueue comment reply JS
		if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
	}

	public function load_css() {

		// Register our main stylesheet
		$theme_uri = get_template_directory_uri();
		$stylesheet_uri = get_stylesheet_uri();
		
		wp_register_style( 'bpmagic-css', $stylesheet_uri, array(), bp_get_version() );
		wp_register_style( 'bpmagic-uniform-css', $theme_uri . '/_inc/css/uniform.default.css', array(), bp_get_version() );

		wp_enqueue_style( 'bpmagic-css' );
		wp_enqueue_style( 'bpmagic-uniform-css' );
	}

	public function load_google_font() {
		?>
		<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />     
		<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,600,700,400italic,600italic' rel='stylesheet' type='text/css' />

		<?php
	}

}

BPMagic_Asset_Helper::get_instance();

